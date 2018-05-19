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
					@foreach($servicios as $servicio)
						@if($presupuesto->servicio->service == $servicio->service)
							<div class="col-12 col-sm-4 col-md-4">
								<div class="card margin-arriba margin-abajo card-raised">
									@if($presupuesto->image == null)
										<img class="card-img-top" style="height:210px" src="{{$presupuesto->servicio->url}}">
									@else
										<img class="card-img-top" style="height:210px" src="{{$presupuesto->url}}">	
									@endif
									<div class="card-body">
										<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px; margin-top: -150px; margin-right: 10px;" src="{{$presupuesto->cliente->url}}">
										<h5><i class="far fa-user"></i> {{$presupuesto->cliente->usuario->name}}</h5>
										<h5><i class="fas fa-suitcase"></i> {{$presupuesto->servicio->service}}</h5>
										<h6><i class="far fa-calendar-alt"></i> {{$presupuesto->date}}</h6>
										<h6><i class="fas fa-map-marker-alt"></i> {{$presupuesto->comuna->commune}}</h6>
										@if(!$presupuesto->cliente->address == null)
											<h6><i class="fab fa-slack-hash"></i> {{$presupuesto->cliente->address}}</h6>
										@else
											<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
										@endif
										<h6><i class="far fa-comments"></i> {{$presupuesto->description}}</h6>
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