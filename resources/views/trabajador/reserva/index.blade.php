@extends('layouts.app')
@section('titulo','Perfil del Trabajador')
@section('usuario','Trabajador')
@section('barra-navegacion')
	@include('includes.menu-trabajador')
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
							<img class="card-img-top" style="height:200px;" src="{{$reserva->orden->servicio->url}}">
						@else
							<img class="card-img-top" style="height:200px;" src="{{$reserva->orden->url}}">	
						@endif
						<div class="card-body">
							<h5><i class="fas fa-suitcase"></i> {{$reserva->orden->servicio->service}}</h5>
							<h6 class="margin-arriba"><i class="far fa-calendar-alt"></i> {{$reserva->orden->date}}</h6>
							@isset($reserva->orden->tramo->section)
								<h6><i class="far fa-clock"></i> {{$reserva->orden->tramo->section}}</h6>
							@endisset
							@empty($reserva->orden->tramo->section)
								<h6><i class="far fa-clock"></i> Durante el dia</h6>
							@endempty
							@if(!$reserva->orden->cliente->commune_id ==null)
								<h6><i class="fas fa-map-marker-alt"></i> Comuna {{$reserva->orden->cliente->comuna->commune}}</h6>
							@else
								<h6><i class="fas fa-map-marker-alt"></i> No ha Ingresado su Comuna</h6>
							@endif
							@if(!$reserva->orden->cliente->address == null)
								<h6><i class="fab fa-slack-hash"></i> {{$reserva->orden->cliente->address}}</h6>
							@else
								<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
							@endif
							<h6><i class="far fa-comments"></i> Descripcion del Problema</h6>
							<small class="text-justify margin-arriba">{{$reserva->orden->description}}</small>
							<h5 class="margin-arriba">Cliente</h5>			
							<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$reserva->orden->cliente->url}}">
							<h6 class="d-inline">{{$reserva->orden->cliente->usuario->name}}</h6>							
							<a class="pull-right margin-derecho" target="_blank" href="https://api.whatsapp.com/send?phone=56{{$reserva->orden->cliente->phone}}"><img src="https://png.icons8.com/color/30/000000/whatsapp.png"><small>Whatsapp</small></a>
						</div>
					</div>
				</div>
			@empty
				@section('mensaje','Trabajados Asignados')
				@include('includes.mensaje')
			@endforelse
		</div>
	</div>
</div>
@endsection
