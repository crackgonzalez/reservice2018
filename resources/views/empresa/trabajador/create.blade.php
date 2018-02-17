@extends('layouts.app')
@section('titulo','Crear un Trabajador')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('fondo','fondo-foto')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3"></div>
                <div class="col-12 col-sm-6 col-md-6">
                	@if($errors->any())
                        <div class="alert alert-danger margin-arriba">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card margin-arriba margin-abajo card-raised"> 
                    	<div class="card-header text-center">
                            <h4 class="card-title">Registrar un Trabajador</h4>
                        </div>
                        <div class="card-body">
                        	<form class="form-horizontal" method="POST" action="{{url('/empresa/trabajador')}}">
                        		{{ csrf_field() }}
                        		<input name="company_id" type="hidden" value="{{ Auth::user()->empresa->id}}">
                        		<div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">account_circle</i></span>
                                        <input type="text" class="form-control" name="name" placeholder="Nombre Usuario" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">credit_card</i></span>
                                        <input type="text" class="form-control" name="rut" placeholder="Rut" value="{{ old('rut') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">email</i></span>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">lock_open</i></span>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">supervisor_account</i></span>
                                        <select name="account_id" class="form-control">
                                            <option value="0">Seleccione Cuenta</option>
                                            <option value="2">Trabajador</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{url('empresa/trabajador')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
                                    <button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Crear cuenta</button>
                                </div>
                        	</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection