@extends('layouts.app')
@section('titulo','Mis Presupuestos')
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
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-body text-center">
					<h4>Creditos Disponibles <span class="badge badge-secondary">{{$creditos}}</span></h4>
					<a class="btn btn-sm btn-warning link-1" href="{{url('/cliente/creditos/create')}}">Comprar Creditos</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			@forelse($presupuestos as $presupuesto)
				<div class="card margin-arriba margin-abajo card-raised">
					<div class="card-header text-center" style="background-image: url({{$presupuesto->servicio->url}}); background-position: center center; width: 100%;">						
						<h2><span class="badge badge-secondary"><i class="fas fa-suitcase"></i> {{$presupuesto->servicio->service}}</span></h2>
						<h2><span class="badge badge-secondary"><i class="far fa-calendar-alt"></i> {{$presupuesto->date}}</span></h2>
					</div>
					<div class="card-body">
						<div class="row">
							@foreach($presupuesto->respuestas as $respuestas)
								@if($respuestas->empresa->usuario->state)
									@if($respuestas->empresa->credit > 0)
										@if($respuestas->state_company !=0)
											<div class="col-12 col-sm-4 col-md-4">
												<div class="card margin-arriba margin-abajo card-raised">
												<div class="card-body">
													<div class="row">
														<div class="col-12 col-sm-4 col-md-4 text-center">
															<img class="img-raised rounded-circle img-thumbnail" style="height: 100px; width: 100px; margin-bottom: : 10px;" src="{{$respuestas->empresa->url}}">
														</div>
														<div class="col-12 col-sm-8 col-md-8">
															<h5><i class="far fa-building"></i> {{$respuestas->empresa->usuario->name}}</h5>
															<h6>Valoracion Empresa</h6>
															@foreach($respuestas->empresa->servicios as $servicio)
																@if($servicio->service == $presupuesto->servicio->service)
																	<h6>Precio de Referencia <i class="fas fa-dollar-sign"></i> {{$servicio->pivot->price}}</h6>
																@endif
															@endforeach
															<h6>Precio Final Ofrecido <i class="fas fa-dollar-sign"></i> {{$respuestas->price}}</h6>
														</div>
													</div>
													<div class="row">
														<div class="col-12 col-sm-12 col-md-12 margin-arriba">
															<h6 class="text-justify"><i class="far fa-comments"></i> {{$respuestas->description}}</h6>
														</div>
													</div>
													@if($respuestas->presupuesto->cliente->credit>0)
													<form class="margin-arriba" action="{{url('/cliente/presupuesto/'.$respuestas->id)}}" method="post">
														{{csrf_field()}}
														@if($respuestas->state_client ==0)
														<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/cliente/presupuesto/'.$respuestas->id.'/edit')}}">Responder Presupuesto</a>
														@endif
													</form>
													@else
														<h5 class="text-justify">Debe comprar creditos para responder los presupuestos enviados y generar una reserva.</h5>
													@endif
												</div>
												</div>
											</div>										
										@endif										
									@endif
								@endif
							@endforeach
						</div>						
					</div>
				</div>
			@empty
				@include('includes.mensaje')
			@endforelse
		</div>
	</div>
@endsection