@extends('layouts.app')
@section('titulo','Calificar al Trabajador')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<div class="row">
			@foreach($clientes as $cliente)				
				@forelse($cliente->trabajadores as $trabajador)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="text-center">
							<img src="{{$trabajador->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
							<h5>{{$trabajador->usuario->name}}</h5>
							<h6>{{$trabajador->empresa->usuario->name}}</h6>
							@foreach($reservas as $reserva)
							@if($reserva->id == $trabajador->pivot->reservation_id)
								<h6>{{$reserva->orden->servicio->service}} - {{$reserva->orden->date}}</h6>
							@endif
							@endforeach				
							@for ($i = 0; $i < $trabajador->pivot->score; $i++)
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
</div>
@endsection