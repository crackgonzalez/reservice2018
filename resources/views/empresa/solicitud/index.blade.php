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
				@foreach($ordenes as $orden)
					@if($orden->empresa->id == Auth::user()->empresa->id)
						@if(!$orden->state_company)
						<div class="col-12 col-sm-3 col-md-3">
							<div class="card margin-arriba margin-abajo card-raised">
								@if($orden->image == null)
									<img class="card-img-top" style="height:200px" src="{{$orden->servicio->url}}">
								@else
									<img class="card-img-top" style="height:200px" src="{{$orden->url}}">	
								@endif
								<div class="card-body">
									<h3>{{$orden->servicio->service}}</h3>
									<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$orden->cliente->url}}">
									<h5 class="d-inline">{{$orden->cliente->usuario->name}}</h5>
									<h6 class="margin-arriba">Fecha {{$orden->date}} Horario {{$orden->tramo->section}}</h6>
									<h6>{{$orden->comuna->commune}}</h6>										
									@if($orden->state_client)
										<h6>Confirmado por el Cliente</h6>									
									@endif
									<small class="text-justify margin-arriba">{{$orden->description}}</small>
									<br>
									@if($orden->date > today())
										<form action="{{url('/empresa/solicitud/'.$orden->id)}}" method="post">
											{{csrf_field()}}
											<a class="tn btn-warning btn-sm link-1 pull-right margin-arriba" style="text-decoration:none;"  href="{{url('/empresa/solicitud/'.$orden->id.'/edit')}}">Confirmar Solicitud</a>
										</form>
									@endif
								</div>
							</div>
						</div>
						@endif
					@endif
				@endforeach
			</div>
		</div>
	</div>
@endsection