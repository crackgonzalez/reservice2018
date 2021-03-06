<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Company;
use App\Client;
use App\Reservation;
use File;
use Exception;
use Auth;
use Alert;
use DB;

class EmployeController extends Controller
{
    public function index(){
    	$empresas = Company::all();
    	return view('empresa.trabajador.index')->with(compact('empresas'));
    }

    public function inicio(){
        $id = Auth::user()->trabajador->id;
        $trabajador = Employe::where('id','=',$id)->get();
        $contador = DB::table('client_employe')->join('employes','employes.id','=','client_employe.employe_id')
                    ->where('client_employe.employe_id','=',$id)
                    ->avg('client_employe.score');

    	return view('trabajador.perfil.index')->with(compact('trabajador','contador'));
    }

    public function edit(Employe $trabajador){
        $trabajador = Employe::find($trabajador->id);
        return view('trabajador.perfil.edit')->with(compact('trabajador'));
    }

    public function update(Request $requerimiento, Employe $trabajador){
        $mensajes =[
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'phone.required' =>'El campo telefono es obligatorio',
            'phone.numeric' =>'El telefono no cumple con el formato solicitado (Ej:998773251)',
            'phone.digits_between' => 'El numero de telefono debe estar en el rango de 8 a 11 digitos',
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',            
        ];

        $reglas = [
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'phone' => 'required|numeric|digits_between:8,11',
            'name' => 'required|string|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50',            
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $borrar = $trabajador->image;
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/perfil';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$trabajador->image;
                $trabajador->image = $nombreFoto;
                $exito = $trabajador->save();                        
                if($exito){
                    if($borrar != 'fotoperfil.jpg'){
                        File::delete($imagenAnterior);
                    }

                    $modificadaTrabajador = $trabajador->update($requerimiento->only('phone'));
                    $modificadaUsuario = $trabajador->usuario->update($requerimiento->only('name','email'));
                    if($modificadaTrabajador && $modificadaUsuario){
                        alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                    }else{
                        alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
                    }
                }
            }
        }else{
            $modificadaTrabajador = $trabajador->update($requerimiento->only('phone'));
            $modificadaUsuario = $trabajador->usuario->update($requerimiento->only('name','email'));
            if($modificadaTrabajador && $modificadaUsuario){
                alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
            }else{
                alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }    

        return redirect('trabajador/perfil');
    }

    //Elimina un Trabajador
    public function destroy($id){
    	try{
            $trabajador = Employe::find($id);
            $borrar = $trabajador->image;
            $ruta = public_path().'/imagenes/perfil';
            $imagenAnterior = $ruta.'/'.$trabajador->image;           
    		$exito = $trabajador->delete();
    		if($exito){
                if($borrar != 'fotoperfil.jpg'){
                    File::delete($imagenAnterior);
                }
    			alert()->success('La trabajador fue eliminado correctamente','Trabajador Eliminado')->autoclose(3000);
    		}else{
                alert()->error('El trabajador no pudo ser eliminado','Ocurrio un Error')->autoclose(3000);
            }
        }catch(Exception $e){
            alert()->warning('El trabajador se encuentra asociado a un servicio','No se Puede Eliminar')->autoclose(3000);
        }
        return redirect('empresa/trabajador');
        
    }

    public function calificaciones(){
        $trabajadores = Employe::where('id',Auth::user()->trabajador->id)->get();
        $reservas = Reservation::all();
        return view('trabajador.calificar.index')->with(compact('reservas','trabajadores'));
    }

    // public function resumenCalificacion(){
    //     $id = Auth::user()->empresa->id;
    //     $notas = DB::table('client_employe')
    //     ->select(DB::raw('avg(client_employe.score) AS promedio'),'users.name')
    //     ->join('employes','employes.id','=','client_employe.employe_id')
    //     ->join('companies','companies.id','=','employes.company_id')
    //     ->join('users','users.id','=','employes.user_id')
    //     ->where('companies.id','=',$id)
    //     ->groupBy('users.name')->get();
        
    //     return view ('empresa.resumen-calificacion.index')->with(compact('notas'));
    // }

    public function resumenCalificacion(){
        $id = Auth::user()->empresa->id;
        $trabajadores = DB::table('client_employe')
        ->join('employes','employes.id','=','client_employe.employe_id')
        ->join('users','users.id','=','employes.user_id')
        ->select('employes.image','employes.id',DB::raw('avg(client_employe.score) AS promedio'),'users.name')
        ->where('employes.company_id',$id)
        ->groupBy('employes.id','employes.image','users.name')
        ->get();
        return view ('empresa.resumen-calificacion.index')->with(compact('trabajadores'));
    }

    public function detalle($id){
        $idEmpresa = Auth::user()->empresa->id;
        $trabajadores = Employe::where('id',$id)->get();
        $notas = DB::table('client_employe')
        ->join('employes','employes.id','=','client_employe.employe_id')
        ->join('reservations','reservations.id','=','client_employe.reservation_id')
        ->join('quotes','quotes.id','=','reservations.quote_id')
        ->join('services','services.id','=','quotes.service_id')
        ->join('clients','clients.id','=','quotes.client_id')
        ->join('users','users.id','=','clients.user_id')
        ->select('clients.image','services.service','score','comment','users.name','quotes.date')
        ->where('employes.company_id',$idEmpresa)
        ->where('employes.id',$id)
        ->orderBy('quotes.date','desc')
        ->get();

        $promedios = DB::table('client_employe')
        ->join('employes','employes.id','=','client_employe.employe_id')
        ->join('users','users.id','=','employes.user_id')
        ->select('employes.id',DB::raw('avg(client_employe.score) AS promedio'),'users.name')
        ->where('employes.id',$id)
        ->groupBy('employes.id','employes.image','users.name')
        ->get();

        $empresas = DB::table('client_employe')
        ->join('employes','employes.id','=','client_employe.employe_id')
        ->join('companies','companies.id','=','employes.company_id')
        ->join('users','users.id','=','companies.user_id')
        ->select('companies.id','users.name',DB::raw('avg(client_employe.score) AS promedio'))
        ->where('companies.id',$idEmpresa)
        ->groupBy('companies.id','users.name')
        ->get();

        $servicios = DB::table('client_employe')
        ->join('employes','employes.id','=','client_employe.employe_id')
        ->join('reservations','reservations.id','=','client_employe.reservation_id')
        ->join('quotes','quotes.id','=','reservations.quote_id')
        ->join('services','services.id','=','quotes.service_id')
        ->select('services.service',DB::raw('avg(client_employe.score) AS promedio'))
        ->where('employes.company_id',$idEmpresa)
        ->where('employes.id',$id)
        ->groupBy('services.service')
        ->get();

        return view('empresa.detalle-calificacion.index')->with(compact('notas','trabajadores','promedios','empresas','servicios'));
    }
    
}
