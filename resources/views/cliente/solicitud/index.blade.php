@extends('layouts.app')
@section('titulo','Mis Solicitudes')
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
				@forelse($ordenes as $orden)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="card margin-arriba margin-abajo card-raised">
							@if($orden->image == null)
								<img class="card-img-top" style="height:200px" src="{{$orden->servicio->url}}">
							@else
								<img class="card-img-top" style="height:200px" src="{{$orden->url}}">	
							@endif
							<div class="card-body">
								<h5>{{$orden->servicio->service}}</h5>
								<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$orden->empresa->url}}">
								<h6 class="d-inline">{{$orden->empresa->usuario->name}}</h6>
								<h6 class="margin-arriba">Fecha {{$orden->date}} - Horario {{$orden->tramo->section}}</h6>									
								@if($orden->state_company)
									<h6>Confirmado por la {{$orden->empresa->usuario->name}}</h6>
								@else
									<h6>Esperando Confirmacion</h6>								
								@endif
								@if($orden->answer != null)
									<small class="text-justify margin-arriba">{{$orden->answer}}</small>
								@endif
								@if($orden->state_company)
									<form action="{{url('/cliente/solicitud/'.$orden->id)}}" method="post">
										{{csrf_field()}}
										<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/cliente/solicitud/'.$orden->id.'/edit')}}">Confirmar Solicitud</a>
									</form>											
								@endif																		
							</div>
						</div>
					</div>	
				@empty
					<div class="col-12 col-sm-12 col-md-12">
					<div class="card text-white bg-warning text-center margin-arriba margin-abajo">
						<div class="card-header"><h4>Solicitudes</h4></div>
						<div class="card-body">							
    						<h4 class="card-text">No hay solicitudes vigentes</h4>
  						</div>
					</div>
				</div>	
				@endforelse
			</div>	
		</div>
	</div>
@endsection