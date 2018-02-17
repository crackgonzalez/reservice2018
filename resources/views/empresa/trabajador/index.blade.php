@extends('layouts.app')
@section('titulo','Trabajadores')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				@foreach($empresas as $empresa)
					@if($empresa->user_id == Auth::user()->id)
						<div class="card-header text-center">
							<h4 class="card-title">Trabajadores de {{$empresa->usuario->name}}</h4>
							<a href="{{url('/empresa/trabajador/create')}}" class="btn btn-warning btn-sm link-1">Agregar un Trabajador</a>
						</div>
						<div class="card-body">
							<div class="row">
								@foreach($empresa->trabajadores as $trabajadores)
								<div class="col-12 col-sm-4 col-md-3">
									<div class="text-center separacion-fotos">
										<img src="{{$trabajadores->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
										<h5>{{$trabajadores->usuario->name}}</h5>
										<h6>{{$trabajadores->usuario->rut}}</h6>
										<h6>{{$trabajadores->usuario->email}}</h6>
										<h6>{{$trabajadores->phone}}</h6>
										@if($trabajadores->usuario->state === 1)
										<h6>Cuenta Activa</h6>										
										@else
										<h6>Cuenta Desactivada</h6>										
										@endif
									</div>
								</div>
								@endforeach
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
@endsection