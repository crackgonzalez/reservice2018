<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Commune;
use App\Company;
use App\Category;
use App\Service;
use App\Employe;
use App\Reservation;
use File;
use Auth;
use DB;
use Exception;

class ClientController extends Controller
{
    //
    public function index(){
    	$clientes = Client::all();
    	return view('cliente.perfil.index')->with(compact('clientes'));
    }

    public function edit(Client $cliente){
    	$usuario = User::find($cliente->user_id);
        $comunas = Commune::orderBy('commune','asc')->get();
        return view('cliente.perfil.edit')->with(compact('cliente','usuario','comunas'));
    }

    //
    public function update(Request $requerimiento, Client $cliente){  
        
        $mensajes =[
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'phone.required' =>'El campo telefono es obligatorio',
            'phone.numeric' =>'El telefono no cumple con el formato solicitado (Ej:998773251)',
            'phone.digits_between' => 'El numero de telefono debe estar en el rango de 8 a 11 digitos',
            'address.required' =>'El campo direccion es obligatorio',
            'address.regex' => 'El campo description solo acepta cadenas de texto y valores numericos',            
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',
            'commune_id.exists' =>'Debe seleccionar una comuna',
        ];

        $reglas = [
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'phone' => 'required|numeric|digits_between:8,11',
            'address' => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ#])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ#]*)*)+$/',
            'name' => 'required|string|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50',
            'commune_id' => 'exists:communes,id' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $borrar = $cliente->image;
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/perfil';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$cliente->image;
                $cliente->image = $nombreFoto;
                $exito = $cliente->save();                        
                if($exito){
                    if($borrar != 'fotoperfil.jpg'){
                        File::delete($imagenAnterior);
                    }

                    $modificadaEmpresa = $cliente->update($requerimiento->only('phone','address','commune_id'));
                    $modificadaUsuario = $cliente->usuario->update($requerimiento->only('name','email'));
                    if($modificadaEmpresa && $modificadaUsuario){
                        alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                    }else{
                        alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
                    }
                }
            }
        }else{
            $modificadaEmpresa = $cliente->update($requerimiento->only('phone','address','commune_id'));
            $modificadaUsuario = $cliente->usuario->update($requerimiento->only('name','email'));
            if($modificadaEmpresa && $modificadaUsuario){
                alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
            }else{
                alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }            
        return redirect('cliente/perfil');
    }

    public function buscar(Request $request){
        $servicios = DB::table('company_service')
                        ->join('services','services.id','=','service_id')
                        ->join('companies','companies.id','=','company_id')
                        ->join('users','users.id','=','companies.user_id')
                        ->where('services.service','like','%'.$request->input('search_text').'%')
                        ->where('companies.credit','>','0')
                        ->where('users.state','=','1')                        
                        ->orderBy('price',$request->input('price'))->get();
        return view('cliente.buscar.index')->with(compact('servicios'));
    }

    public function show(Company $empresa){
        $compania = Company::find($empresa->id);
        $id = $empresa->id;
            $notas = DB::table('client_employe')
            ->join('employes','employes.id','=','client_employe.employe_id')
            ->join('companies','companies.id','=','employes.company_id')
            ->join('users','users.id','=','employes.user_id')
            ->where('companies.id','=',$id)
            ->avg('client_employe.score');
        return view('cliente.solicitud.show')->with(compact('compania','notas'));
    }

    public function calificaciones(){
        $clientes = Client::where('user_id','=',Auth::user()->id)->get();
        $reservas = Reservation::all();
        return view('cliente.calificar.index')->with(compact('clientes','reservas'));
    }

    public function calificar($id){
        $reserva = Reservation::find($id);
        return view('cliente.calificar.calificar')->with(compact('reserva'));
    }

    public function guardarCalificacion($id,Request $request){
        
        $mensajes =[
            'score.required' => 'Debe seleccionar una calificacion',
        ];

        $reglas = [
            'score' => 'required'
        ];

        $this->validate($request,$reglas,$mensajes);

        try{
            $nota = $request->input('score');
            $cliente = Auth::user()->cliente;
            $reserva = Reservation::find($id);
            $trabajador = Employe::find($reserva->employe_id);
            $cliente->trabajadores()->attach($trabajador,array('reservation_id'=>$id,'score'=>$nota));
            alert()->success('El trabajador fue calificado de forma exitosa','Trabajador Calificado')->autoclose(3000);
        }catch(Exception $e){
            alert()->error('El trabajador ya fue calificado','Ocurrio un Error')->autoclose(3000);
        }
        return redirect('cliente/reserva');
    }

}
