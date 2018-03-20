@extends('layouts.app')
@section('titulo','Mis Reservas')
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
			@forelse($reservas as $reserva)
				<div class="col-12 col-sm-3 col-md-3">
					<div class="card margin-arriba margin-abajo card-raised">
						@if($reserva->orden->image == null)
							<img class="card-img-top" style="height:200px" src="{{$reserva->orden->servicio->url}}">
						@else
							<img class="card-img-top" style="height:200px" src="{{$reserva->orden->url}}">	
						@endif							
						<div class="card-body">
							<h5>Servicio {{$reserva->orden->servicio->service}}</h5>
							<h6 class="margin-arriba">Fecha {{$reserva->orden->date}} - Horario {{$reserva->orden->tramo->section}}</h6>
							<h6>Comuna {{$reserva->orden->comuna->commune}}</h6>
							@if(!$reserva->orden->cliente->address == null)
								<h6>{{$reserva->orden->cliente->address}}</h6>
							@else
								<h6>Sin Direccion</h6>
							@endif								
							<h5 class="margin-arriba">Empresa</h5>			
							<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$reserva->orden->empresa->url}}">
							<h6 class="d-inline">{{$reserva->orden->empresa->usuario->name}}</h6>
							<a class="pull-right" target="_blank" href="https://api.whatsapp.com/send?phone=56{{$reserva->orden->cliente->phone}}"><img src="https://png.icons8.com/color/30/000000/whatsapp.png"><small>Whatsapp</small></a>
							@if(!$reserva->employe_id == null)
								<h5 class="margin-arriba">Trabajador</h5>
								<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$reserva->trabajador->url}}">
								<h6 class="d-inline">{{$reserva->trabajador->usuario->name}}</h6>
								<a class="pull-right" target="_blank" href="https://api.whatsapp.com/send?phone=56{{$reserva->trabajador->phone}}"><img src="https://png.icons8.com/color/30/000000/whatsapp.png"><small>Whatsapp</small></a>
							@else
								<h5 class="margin-arriba">No hay trabajador asignado</h5>
							@endif
						</div>
					</div>
				</div>
			@empty
				@section('mensaje','Reservas')
					@include('includes.mensaje')
			@endforelse
		</div>
	</div>
</div>
@endsection