@extends('layouts.app')
@section('titulo','Registro')
@section('fondo','fondo-foto')
@section('estilo-footer')
    <link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
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
                            <h4 class="card-title">Registro</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">account_circle</i></span>
                                        <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
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
                                            @foreach($cuentas as $cuenta)
                                            <option value="{{$cuenta->id}}">{{$cuenta->profile}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{url('/')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
                                    <button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Crear cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 col-md-3"></div>
            </div>
        </div>
    </div>
@endsection
