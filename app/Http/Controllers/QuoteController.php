<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\Response;
use App\Company;
use App\Commune;
use App\Section;
use App\Service;
use App\Credit;
use Exception;
use Auth;

class QuoteController extends Controller
{
    //vista presupuesto cliente
    public function presupestoCliente(){        
    	$cliente = Auth::user()->cliente->id;
    	$presupuestos = Quote::where('client_id','=',$cliente)
    					->where('date','=',today())
    					->where('model','=',true)
    					->get();
        return view('cliente.presupuesto.index')->with(compact('presupuestos'));
    }

    //vista solicitud cliente
    public function solicitudCliente(){
    	$cliente = Auth::user()->cliente->id;
    	$solicitudes = Quote::where('client_id','=',$cliente)
    					->where('date','>',today())
                        ->where('state_company','<>',1)
                        ->orWhere('state_client','<>',1)
    					->where('model','=',false)
    					->orderBy('date','asc')
    					->get();
        return view('cliente.solicitud.index')->with(compact('solicitudes'));
    }

    //vista solicitud empresa
    public function solicitudEmpresa(){
        $id = Auth::user()->empresa->id;
        $solicitudes = Quote::where('company_id','=',$id)
                        ->where('date','>',today())
                        ->where('state_company','<>',1)
                        ->orWhere('state_client','<>',1)
                        ->where('model','=',false)
                        ->orderBy('date','asc')
                        ->get();
        return view('empresa.solicitud.index')->with(compact('solicitudes'));
    }

    //vista presupuesto cliente
    public function presupestoEmpresa(){
        $servicios = Auth::user()->empresa->servicios;
        $presupuestos = Quote::where('date','=',today())
                        ->where('model','=',true)                        
                        ->orderBy('date','asc')
                        ->get();
        return view('empresa.presupuesto.index')->with(compact('presupuestos','servicios'));
    }

    //vista cliente para solicitar un servicio
    public function solicitarServicio(Company $empresa){
        $compania = Company::find($empresa->id);
        $comunas = Commune::all();
        $tramos = Section::all();
        return view('cliente.solicitud.cotizar')->with(compact('compania','tramos','comunas'));
    }

    //guardar la solicitud realizada por el cliente
    public function guardarSolicitud(Request $request,Company $empresa){
        $mensajes =[
            'service_id.exists' =>'Debe seleccionar un servicio',
            'date.required' => 'El campo fecha es obligatorio',
            'date.after_or_equal' => 'La fecha debe ser posterior al dia de hoy',
            'commune_id.exists' =>'Debe seleccionar una comuna',
            'description.required' => 'El campo descripcion es obligatorio',
            'description.min' =>'El campo descripcion debe tener al menos 10 caracteres',
            'description.max' =>'El campo descripcion debe tener como maximo 200 caracteres',
            'description.regex' => 'El campo descripcion solo acepta cadenas de texto y valores numericos',
            'section_id.exists' =>'Debe seleccionar un tramo horario',
        ];
        $reglas = [
            'service_id' => 'exists:services,id',
            'date' => 'required|date|after_or_equal:tomorrow',
            'commune_id' => 'exists:communes,id',
            'description' => 'required|min:10|max:200|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,]*)*)+$/',
            'section_id' => 'exists:sections,id',
        ];
        
        $this->validate($request,$reglas,$mensajes);
        try{    
            $solicitud = new Quote();
            $solicitud->client_id = Auth::user()->cliente->id;
            $solicitud->service_id = $request->input('service_id');
            $solicitud->commune_id = $request->input('commune_id');
            $solicitud->section_id = $request->input('section_id');
            $solicitud->company_id = $empresa->id;
            $solicitud->date = $request->input('date');
            $solicitud->description = $request->input('description');
            
            if($request->hasFile('image')){
                $foto = $request->file('image');
                $ruta = public_path().'/imagenes/ordenes';
                $nombreFoto = uniqid().$foto->getClientOriginalName();
                $movido = $foto->move($ruta,$nombreFoto);

                if($movido){
                    $solicitud->image = $nombreFoto;
                    $exito = $solicitud->save();
                    if($exito){
                        alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
                    }
                }

            }else{
                $solicitud->save();
                alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
            }           
        }catch(Exception $e){
            alert()->warning('Ya ha solicitado el servicio con fecha '.$requerimiento->input('date').'','Advetencia')->autoclose(3000);
        }       
        return redirect('cliente/solicitud');
    }

    //vista empresa para responder a la solicitud del cliente
    public function responderSolicitud($id){
        $solicitud = Quote::find($id);
        return view('empresa.solicitud.edit')->with(compact('solicitud'));
    }

    //guardar la respuesta a la solicitud ('update a la tabla quotes')
    public function guardarRespuesta(Request $request, $id){
        
        $mensajes =[  
            'state_company.integer' =>'Debe seleccionar una opcion',           
            'answer.required' => 'El campo descripcion es obligatorio',
            'answer.min' =>'El campo respuesta debe tener al menos 10 caracteres',
            'answer.max' =>'El campo respuesta debe tener como maximo 200 caracteres',
            'answer.regex' => 'El campo respuesta solo acepta cadenas de texto y valores numericos',
        ];

        $reglas = [
            'answer' => 'required|min:10|max:200|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,]*)*)+$/',
            'state_company' => 'integer|between:1,2' ,
            
        ];

        $this->validate($request,$reglas,$mensajes);

        $solicitud = Quote::find($id);
        $solicitud->state_company = $request->state_company;
        $solicitud->answer = $request->answer;

        $exito = $solicitud->update();
        if($exito){
            alert()->success('La solicitud se respondio correctamente','Se ha Respondido a la Solicitud')->autoclose(3000);
        }else{
            alert()->error('La solicitud no se pudo responder','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('empresa/solicitud');
    }

    public function responderOferta($id){
        $solicitud = Quote::find($id);
        return view('cliente.solicitud.edit')->with(compact('solicitud'));
    }

    public function guardarOferta(Request $request, $id){
        
        $mensajes =[  
            'state_client.integer' =>'Debe seleccionar una opcion', 
        ];          

        $reglas = [
            'state_client' => 'integer|between:1,2',            
        ];

        $this->validate($request,$reglas,$mensajes);

        $solicitud = Quote::find($id);
        $solicitud->state_client = $request->state_client;

        $exito = $solicitud->update();
        if($exito){
            alert()->success('La solicitud se respondio correctamente','Se ha Respondido a la Solicitud')->autoclose(3000);
        }else{
            alert()->error('La solicitud no se pudo responder','Ocurrio un Error')->autoclose(3000);
        }
        return redirect('cliente/solicitud');
    }

    public function solicitarHoy(){
        $servicios = Service::orderBy('service','asc')->get();
        $comunas = Commune::orderBy('commune','asc')->get();
        return view('cliente.presupuesto.solicitar')->with(compact('servicios','comunas'));
    }

    public function guardarSolicitudHoy(Request $request){
        $mensajes =[  
            'service_id.exists' =>'Debe seleccionar un servicio',
            'commune_id.exists' =>'Debe seleccionar una comuna',
            'description.required' => 'El campo descripcion es obligatorio',
            'description.min' =>'El campo descripcion debe tener al menos 10 caracteres',
            'description.max' =>'El campo descripcion debe tener como maximo 200 caracteres',
        ];          

        $reglas = [
              'service_id' => 'exists:services,id', 
              'commune_id' => 'exists:communes,id',
              'description' => 'required|min:10|max:200|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,]*)*)+$/',     
        ];

        $this->validate($request,$reglas,$mensajes);

        try{
            $solicitud = new Quote();
            $solicitud->client_id = Auth::user()->cliente->id;
            $solicitud->service_id = $request->input('service_id');
            $solicitud->commune_id = $request->input('commune_id');
            $solicitud->model = 1;
            $solicitud->date = today();
            $solicitud->description = $request->input('description');

            if($request->hasFile('image')){
                $foto = $request->file('image');
                $ruta = public_path().'/imagenes/ordenes';
                $nombreFoto = uniqid().$foto->getClientOriginalName();
                $movido = $foto->move($ruta,$nombreFoto);

                if($movido){
                    $solicitud->image = $nombreFoto;
                    $exito = $solicitud->save();
                    if($exito){
                        alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
                    }
                }

            }else{
                $solicitud->save();
                alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
            }

        }catch(Exception $e){
            alert()->warning('Ya ha solicitado el servicio con fecha '.today().'','Advetencia')->autoclose(3000);
        }

        return redirect('cliente/presupuesto');
    }
}
