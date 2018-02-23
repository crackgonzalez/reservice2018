<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Order;
use App\Section;
use Exception;

class OrderController extends Controller
{

    public function index(){
        $ordenes = Order::orderBy('date','asc')->get();
        return view('cliente.solicitud.index')->with(compact('ordenes'));
    }

    public function inicio(){
        $ordenes = Order::orderBy('date','desc')->get();
        return view('empresa.solicitud.index')->with(compact('ordenes'));
    }

    public function create(Company $empresa){
        $compania = Company::find($empresa->id);
        $tramos = Section::all();
        return view('cliente.solicitud.cotizar')->with(compact('compania','tramos'));
    }

    public function store(Request $requerimiento){
    	$mensajes =[
    		'service_id.exists' =>'Debe seleccionar un servicio',
    		'date.required' => 'El campo fecha es obligatorio',
    		'date.after_or_equal' => 'La fecha debe ser superior o igual a mañana',
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
    	
    	$this->validate($requerimiento,$reglas,$mensajes);
	    try{	
	    	$orden = new Order();
	    	$orden->client_id = $requerimiento->input('client_id');
	    	$orden->company_id = $requerimiento->input('company_id');
	    	$orden->service_id = $requerimiento->input('service_id');
	    	$orden->commune_id = $requerimiento->input('commune_id');
	    	$orden->description = $requerimiento->input('description');
	    	$orden->section_id = $requerimiento->input('section_id');
	    	$orden->date = $requerimiento->input('date');
	    	if($requerimiento->hasFile('image')){
	    		$foto = $requerimiento->file('image');
            	$ruta = public_path().'/imagenes/ordenes';
            	$nombreFoto = uniqid().$foto->getClientOriginalName();
            	$movido = $foto->move($ruta,$nombreFoto);

            	if($movido){
            		$orden->image = $nombreFoto;
            		$exito = $orden->save();
            		if($exito){
	    				alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
	    			}
            	}

	    	}else{
                $orden->save();
                alert()->success('La solicitud se envio correctamente','Solicitud Enviada')->autoclose(3000);
            }	    	
	    }catch(Exception $e){
	    	alert()->warning('Ya ha solicitado este servicio','Advetencia')->autoclose(3000);
	    }    	
	    return redirect('cliente/buscar');
    }

    public function edit($id){
        $orden = Order::find($id);
        return view('empresa.solicitud.edit')->with(compact('orden'));
    }

    public function update(Request $requerimiento, $id){
        
        $mensajes =[  
            'state_company.boolean' =>'Debe seleccionar una opcion',           
            'answer.required' => 'El campo descripcion es obligatorio',
            'answer.min' =>'El campo respuesta debe tener al menos 10 caracteres',
            'answer.max' =>'El campo respuesta debe tener como maximo 200 caracteres',
            'answer.regex' => 'El campo respuesta solo acepta cadenas de texto y valores numericos',
        ];

        $reglas = [
            'answer' => 'required|min:10|max:200|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,]*)*)+$/',
            'state_company' => 'boolean' 
            
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $orden = Order::find($id);
        $orden->state_company = $requerimiento->state_company;
        $orden->answer = $requerimiento->answer;

        $exito = $orden->update();
        if($exito){
            alert()->success('La solicitud se confirmo correctamente','Solicitud Confirmada')->autoclose(3000);
        }else{
            alert()->error('La solicitud no se pudo confirmar','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('empresa/solicitud');
    }

    public function editar($id){
        $orden = Order::find($id);
        return view('cliente.solicitud.edit')->with(compact('orden'));
    }

    public function actualizar(Request $requerimiento, $id){
        
        $mensajes =[  
            'state_client.boolean' =>'Debe seleccionar una opcion', 
        ];          

        $reglas = [
            'state_client' => 'boolean',
            
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $orden = Order::find($id);
        $orden->state_client = $requerimiento->state_client;

        $exito = $orden->update();
        if($exito){
            alert()->success('La solicitud se confirmo correctamente','Solicitud Confirmada')->autoclose(3000);
        }else{
            alert()->error('La solicitud no se pudo confirmar','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('cliente/solicitud');
    }
}
