<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function index(){
    	return view('administrador.regiones.index');
    }

    public function create(){
    	return view('administrador.regiones.create');
    }
}
