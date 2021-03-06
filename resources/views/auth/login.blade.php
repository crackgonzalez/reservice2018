@extends('layouts.app')
@section('titulo','Iniciar Sesion')
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
                            <h4 class="card-title">Iniciar Sesion</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{csrf_field()}}
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
                                <!-- Funcion recordar cuenta no activa -->
                                <!-- <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar Cuenta
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <!-- Funcion olvido contraseña no activa -->
                                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvido su Contraseña?
                                    </a>
 -->                                <a href="{{url('/')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
                                    <button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Iniciar Sesion</button>
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
