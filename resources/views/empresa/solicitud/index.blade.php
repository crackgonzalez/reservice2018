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
								<img class="card-img-top" style="height:220px" src="{{$orden->servicio->url}}">
							@else
								<img class="card-img-top" style="height:220px" src="{{$orden->url}}">	
							@endif
							<div class="card-body">
								<h5>{{$orden->servicio->service}}</h5>
								<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$orden->cliente->url}}">
								<h6 class="d-inline">{{$orden->cliente->usuario->name}}</h6>
								<h6 class="margin-arriba">Fecha {{$orden->date}} Horario {{$orden->tramo->section}}</h6>
								<h6>{{$orden->comuna->commune}}</h6>										
								@if($orden->state_client)
									<h6>Confirmado por el Cliente</h6>									
								@endif
								<small class="text-justify margin-arriba">{{$orden->description}}</small>
								<br>
								<form action="{{url('/empresa/solicitud/'.$orden->id)}}" method="post">
									{{csrf_field()}}
									<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/empresa/solicitud/'.$orden->id.'/edit')}}">Confirmar Solicitud</a>
								</form>
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