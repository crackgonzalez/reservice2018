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
				@forelse($solicitudes as $solicitud)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="card margin-arriba margin-abajo card-raised">
							<img class="card-img-top" style="height:180px" src="{{$solicitud->servicio->url}}"><div class="card-body">
								<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px; margin-top: -150px; margin-right: 10px;" src="{{$solicitud->empresa->url}}">
								<h5><i class="far fa-building"></i> {{$solicitud->empresa->usuario->name}}</h5>
								<h5><i class="fas fa-suitcase"></i> {{$solicitud->servicio->service}}</h5>
								<h6><i class="far fa-calendar-alt"></i> {{$solicitud->date}} - <i class="far fa-clock"></i> {{$solicitud->tramo->section}}</h6>
								<h6><i class="fas fa-map-marker-alt"></i> {{$solicitud->comuna->commune}}</h6>
								@if(!$solicitud->cliente->address == null)
									<h6><i class="fab fa-slack-hash"></i> {{$solicitud->cliente->address}}</h6>
								@else
									<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
								@endif
								
								@if($solicitud->state_client != 2)
									@if($solicitud->state_company == 1)									
										<h6><i class="far fa-thumbs-up"></i> {{$solicitud->empresa->usuario->name}} confirmo la solicitud</h6>
									@elseif($solicitud->state_company == 2)
										<h6><i class="far fa-thumbs-down"></i> {{$solicitud->empresa->usuario->name}} ha cancelado la solicitud</h6>
									@else									
										<h6><i class="far fa-pause-circle"></i> Confirmacion de la Empresa Pendiente</h6>
									@endif
								@else
									<h6><i class="far fa-thumbs-down"></i> La solicitud a sido rechazada</h6>
								@endif
								
								@if($solicitud->answer != null)
									<h6><i class="far fa-comments"></i> {{$solicitud->answer}}</h6>
								@endif

								@if($solicitud->state_company == 1 && $solicitud->state_client != 2 )
									<form class="margin-arriba" action="{{url('/cliente/solicitud/'.$solicitud->id)}}" method="post">
										{{csrf_field()}}
										<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/cliente/solicitud/'.$solicitud->id.'/edit')}}">Responder Solicitud</a>
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