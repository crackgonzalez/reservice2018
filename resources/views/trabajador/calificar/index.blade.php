@extends('layouts.app')
@section('titulo','Calificaciones')
@section('usuario','Trabajador')
@section('barra-navegacion')
	@include('includes.menu-trabajador')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="col-12 col-sm-12 col-md-12">
		<div class="row">
			@foreach($trabajadores as $trabajador)			
				@forelse($trabajador->clientes as $cliente)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="text-center">
							<img src="{{$cliente->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
							<h5>{{$cliente->usuario->name}}</h5>							
							@foreach($reservas as $reserva)
							@if($reserva->id == $cliente->pivot->reservation_id)
								<h6>{{$reserva->orden->servicio->service}} - {{$reserva->orden->date}}</h6>
							@endif
							@endforeach				
							@for ($i = 0; $i < $cliente->pivot->score; $i++)
    							<i class="far fa-star"></i>
							@endfor
						</div>
					</div>
				@empty
					@section('mensaje','Calificaciones')
					@include('includes.mensaje')
				@endforelse
			@endforeach	
		</div>
	</div>
@endsection