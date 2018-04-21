@extends('layouts.app')
@section('titulo','Mis Solicitudes')
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
				@forelse($ordenes as $orden)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="card margin-arriba margin-abajo card-raised">
							@if($orden->image == null)
								<img class="card-img-top" style="height:180px" src="{{$orden->servicio->url}}">
							@else
								<img class="card-img-top" style="height:180px" src="{{$orden->url}}">	
							@endif
							<div class="card-body">
								<h5><i class="fas fa-suitcase"></i> {{$orden->servicio->service}} - <i class="far fa-user"></i> {{$orden->cliente->usuario->name}}</h5>
								<h6 class="margin-arriba"><i class="far fa-calendar-alt"></i> {{$orden->date}} - <i class="far fa-clock"></i> {{$orden->tramo->section}}</h6>
								<h6><i class="fas fa-map-marker-alt"></i> {{$orden->comuna->commune}}</h6>
								<small class="text-justify"><h6><i class="far fa-comments"></i> {{$orden->description}}</h6></small>
								<form action="{{url('/empresa/solicitud/'.$orden->id)}}" method="post">
									{{csrf_field()}}
									<a class="tn btn-warning btn-sm link-1 pull-right margin-top" style="text-decoration:none;"  href="{{url('/empresa/solicitud/'.$orden->id.'/edit')}}">Responder Solicitud</a>
								</form>
								<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px;margin-top: -440px; margin-left: 215px;" src="{{$orden->cliente->url}}">
							</div>
						</div>
					</div>
				@empty
					@section('mensaje','Solicitudes')
					@include('includes.mensaje')				
				@endforelse
			</div>
		</div>
	</div>
@endsection