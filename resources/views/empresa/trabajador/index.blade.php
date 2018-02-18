@extends('layouts.app')
@section('titulo','Trabajadores')
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
			<div class="card margin-arriba margin-abajo card-raised">
				@foreach($empresas as $empresa)
					@if($empresa->user_id == Auth::user()->id)
						<div class="card-header text-center">
							<h4 class="card-title">Trabajadores de {{$empresa->usuario->name}}</h4>
							<a href="{{url('/empresa/trabajador/create')}}" class="btn btn-warning btn-sm link-1">Agregar un Trabajador</a>
						</div>
						<div class="card-body">
							<div class="row">
								@foreach($empresa->trabajadores as $trabajadores)
								<div class="col-12 col-sm-4 col-md-3">
									<div class="text-center separacion-fotos">
										<img src="{{$trabajadores->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
										<h5>{{$trabajadores->usuario->name}}</h5>										
										<h6>{{$trabajadores->usuario->email}}</h6>
										<h6>{{$trabajadores->phone}}</h6>
										@if($trabajadores->usuario->state === 1)
										<h6>Cuenta Activa</h6>										
										@else
										<h6>Cuenta Desactivada</h6>										
										@endif
										<form method="post" action="{{url('/empresa/trabajador/'.$trabajadores->usuario->id)}}">
											{{csrf_field()}}
											{{method_field('DELETE')}}
											<a class="btn btn-simple btn-sm" href="{{url('/empresa/trabajador/'.$trabajadores->usuario->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="Modificar la Cuenta"><i class="material-icons actualizar">refresh</i></a>
											<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar al Trabajador"><i class="material-icons eliminar">delete</i></i></button>	
										</form>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
@endsection