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
							<img class="card-img-top" style="height:180px" src="{{$reserva->orden->servicio->url}}">
						@else
							<img class="card-img-top" style="height:180px" src="{{$reserva->orden->url}}">	
						@endif							
						<div class="card-body">
							<h5><i class="fas fa-suitcase"></i> {{$reserva->orden->servicio->service}}</h5>
							<h6 class="margin-arriba"><i class="far fa-calendar-alt"></i> {{$reserva->orden->date}} - <i class="far fa-clock"></i> {{$reserva->orden->tramo->section}}</h6>
							<h6><i class="fas fa-map-marker-alt"></i> {{$reserva->orden->comuna->commune}}</h6>
							@if(!$reserva->orden->cliente->address == null)
								<h6><i class="fab fa-slack-hash"></i> {{$reserva->orden->cliente->address}}</h6>
							@else
								<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
							@endif
							<h5 class="margin-arriba">Empresa</h5>			
							<img class="img-raised rounded-circle" style="height: 30px; width: 30px;" src="{{$reserva->orden->empresa->url}}">
							<h6 class="d-inline">{{$reserva->orden->empresa->usuario->name}}</h6>
							<a class="pull-right" target="_blank" href="https://api.whatsapp.com/send?phone=56{{$reserva->orden->cliente->phone}}"><img src="https://png.icons8.com/color/30/000000/whatsapp.png"><small>Whatsapp</small></a>
							@if(!$reserva->employe_id == null)
								<h5 class="margin-arriba">Trabajador</h5>
								<img class="img-raised rounded-circle" style="height: 30px; width: 30px;" src="{{$reserva->trabajador->url}}">
								<h6 class="d-inline">{{$reserva->trabajador->usuario->name}}</h6>
								<a class="pull-right" target="_blank" href="https://api.whatsapp.com/send?phone=56{{$reserva->trabajador->phone}}"><img src="https://png.icons8.com/color/30/000000/whatsapp.png"><small>Whatsapp</small></a>
								<h6 class="margin-arriba"><a href="{{url('/cliente/calificar/'.$reserva->id.'/calificar')}}"><i class="fas fa-check"></i> Calificar al Trabajador</a></h6>
							@else
								<h6 class="margin-arriba"><i class="fas fa-exclamation-triangle"></i> No hay trabajador asignado</h6>
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