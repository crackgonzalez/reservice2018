<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Company;

class EmployeController extends Controller
{
    public function index(){
    	$empresas = Company::all();
    	return view('empresa.trabajador.index')->with(compact('empresas'));
    }

    public function inicio(){
    	$trabajadores = Employe::all();
    	return view('trabajador.perfil.index')->with(compact('trabajadores'));
    }
}
