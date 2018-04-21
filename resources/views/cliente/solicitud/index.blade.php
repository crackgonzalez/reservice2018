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
								<img class="card-img-top" style="height:180px" src="{{$orden->servicio->url}}">
							@else
								<img class="card-img-top" style="height:180px" src="{{$orden->url}}">	
							@endif
							<div class="card-body">
								<h5><i class="fas fa-suitcase"></i> {{$orden->servicio->service}} - <i class="far fa-building"></i> {{$orden->empresa->usuario->name}}</h5>
								<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px; margin-top: -200px; margin-left: 215px;" src="{{$orden->empresa->url}}">
								<h6><i class="far fa-calendar-alt"></i> {{$orden->date}} - <i class="far fa-clock"></i> {{$orden->tramo->section}}</h6>
								<h6><i class="fas fa-map-marker-alt"></i> {{$orden->comuna->commune}}</h6>
								@if(!$orden->cliente->address == null)
									<h6><i class="fab fa-slack-hash"></i> {{$orden->cliente->address}}</h6>
								@else
									<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
								@endif	
								@if($orden->state_company == 1)									
									<h6><i class="far fa-thumbs-up"></i> {{$orden->empresa->usuario->name}} confirmo la solicitud</h6>
								@elseif($orden->state_company == 2)
									<h6><i class="far fa-thumbs-down"></i> {{$orden->empresa->usuario->name}} ha cancelo la solicitud</h6>
								@else									
									<h6><i class="far fa-pause-circle"></i> Confirmacion Pendiente</h6>
									@endif
								@if($orden->answer != null)
									<h6><i class="far fa-comments"></i> {{$orden->answer}}</h6>
								@endif
								@if($orden->state_company == 1 || $orden->state_company == 2)
									<form action="{{url('/cliente/solicitud/'.$orden->id)}}" method="post">
										{{csrf_field()}}
										<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/cliente/solicitud/'.$orden->id.'/edit')}}">Responder Solicitud</a>
									</form>											
								@endif																		
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