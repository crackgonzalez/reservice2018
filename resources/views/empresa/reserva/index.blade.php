@extends('layouts.app')
@section('titulo','Mis Reservas')
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
		<div class="row">
			@foreach($reservas as $reserva)
				@if($reserva->orden->empresa->id == Auth::user()->empresa->id)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="card margin-arriba margin-abajo card-raised">
							@if($reserva->orden->image == null)
								<img class="card-img-top" style="height:200px" src="{{$reserva->orden->servicio->url}}">
							@else
								<img class="card-img-top" style="height:200px" src="{{$reserva->orden->url}}">	
							@endif
							<div class="card-body">
								<h3>{{$reserva->orden->servicio->service}}</h3>
								<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$reserva->orden->cliente->url}}">
								<h5 class="d-inline">{{$reserva->orden->cliente->usuario->name}}</h5>
								<a class="d-inline" href="https://api.whatsapp.com/send?phone=56{{$reserva->orden->cliente->phone}}"><img src="https://png.icons8.com/color/35/000000/whatsapp.png"></a>
								<h6 class="margin-arriba">Fecha {{$reserva->orden->date}} Horario {{$reserva->orden->tramo->section}}</h6>
								<h6>{{$reserva->orden->comuna->commune}}</h6>			
								@if(!$reserva->employe_id == null)
								<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$reserva->orden->trabajador->url}}">
								<h6 class="d-inline">Trabajador {{$reserva->trabajador->usuario->name}}</h6>
								@else
								<h6>No se ha asignado trabajador</h6>
								@endif
								<small class="text-justify margin-arriba">{{$reserva->orden->description}}</small>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
@endsection