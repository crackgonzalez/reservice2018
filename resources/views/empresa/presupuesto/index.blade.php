@extends('layouts.app')
@section('titulo','Mis Presupuestos')
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
				@forelse($presupuestos as $presupuesto)
					@foreach($presupuesto->respuestas as $respuesta)
						@if($respuesta->company_id == Auth::user()->empresa->id)
							<div class="col-12 col-sm-3 col-md-3">
								<div class="card margin-arriba margin-abajo card-raised">
									@if($respuesta->presupuesto->image == null)
										<img class="card-img-top" style="height:180px" src="{{$respuesta->presupuesto->servicio->url}}">
									@else
										<img class="card-img-top" style="height:180px" src="{{$respuesta->presupuesto->url}}">	
									@endif
									<div class="card-body">
										<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px; margin-top: -150px; margin-right: 10px;" src="{{$respuesta->presupuesto->cliente->url}}">
										<h5><i class="far fa-user"></i> {{$respuesta->presupuesto->cliente->usuario->name}}</h5>
										<h5><i class="fas fa-suitcase"></i> {{$respuesta->presupuesto->servicio->service}}</h5>
										<h6><i class="far fa-calendar-alt"></i> {{$respuesta->presupuesto->date}}</h6>
										<h6><i class="fas fa-map-marker-alt"></i> {{$respuesta->presupuesto->comuna->commune}}</h6>
										@if(!$respuesta->presupuesto->cliente->address == null)
											<h6><i class="fab fa-slack-hash"></i> {{$respuesta->presupuesto->cliente->address}}</h6>
										@else
											<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
										@endif
										@if($respuesta->state_company != 2)
											@if($respuesta->state_client == 1)
												<h6><i class="far fa-thumbs-up"></i> {{$respuesta->presupuesto->cliente->usuario->name}} confirmo la solicitud</h6>
											@elseif($respuesta->state_client == 2)
												<h6><i class="far fa-thumbs-down"></i> {{$respuesta->presupuesto->cliente->usuario->name}} ha cancelo la solicitud</h6>
											@else									
												<h6><i class="far fa-pause-circle"></i> Confirmacion del Cliente Pendiente</h6>
											@endif
										@else									
											<h6><i class="far fa-thumbs-down"></i> La solicitud a sido rechazada</h6>
										@endif
										<h6><i class="far fa-comments"></i> Descripcion del Problema</h6>
										<small class="text-justify">{{$reserva->presupuesto->description}}</small>
										@if($respuesta->state_company == 0)
											<form action="" method="post" enctype="multipart/form-data">
												{{csrf_field()}}
												<div class="form-group">
													<a href="{{url('/empresa/presupuesto/'.$respuesta->id.'/edit')}}" class="btn btn-warning btn-sm pull-right link-1">Enviar Presupuesto</a>
												</div>
											</form>										
										@endif
									</div>
								</div>	
							</div>
						@endif
					@endforeach
				@empty
					@section('mensaje','Presupuestos')
					@include('includes.mensaje')
				@endforelse
			</div>
		</div>
	</div>
@endsection


