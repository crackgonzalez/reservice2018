@extends('layouts.app')
@section('titulo','Resumen Calificacion')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card margin-arriba margin-abajo card-raised">
                <div class="card-header text-center">
                    <h4 class="card-title">Resumen de Calificaciones</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    @forelse($trabajadores as $trabajador)
                        <div class="col-12 col-sm-4 col-md-3">
                            <div class="text-center separacion-fotos">
                                <img src="{{asset('imagenes/perfil/'.$trabajador->image)}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
                                <h5>{{$trabajador->name}}</h5>
                                <h6>Nota Promedio {{round($trabajador->promedio,1)}} <i class="far fa-star"></i></h6>
                                <a href="{{url('/empresa/detalle-calificacion/'.$trabajador->id)}}" class="btn btn-sm bg-warning link-1">Ver Detalle</a>
                            </div>                            
                        </div>
                    @empty
                        <h1>Vacio</h1>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection

