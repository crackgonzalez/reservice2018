@extends('layouts.app')
@section('titulo','Mantenedor de Comunas')
@section('usuario','Administrador')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link" href="{{url('/administrador/categorias')}}">Categorias <span class="sr-only">(current)</span></a>
			<a class="nav-item nav-link" href="{{url('/administrador/servicios')}}">Servicios</a>
			<a class="nav-item nav-link" href="{{url('/administrador/regiones')}}">Regiones</a>
			<a class="nav-item nav-link active" href="{{url('/administrador/comunas')}}">Comunas</a>
		</div>
	</div>
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-header text-center">
					<h4 class="card-title">Listado de Comunas</h4>
					<a href="{{url('/administrador/comunas/create')}}" class="btn btn-warning btn-sm link-1">Agregar Comuna</a>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($comunas as $comuna)
						<div class="col-12 col-sm-4 col-md-3">
							<div class="text-center separacion-fotos">
								<img src="{{$comuna->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo">
								<h5>{{$comuna->commune}}</h5>								
								<h6>{{$comuna->region->region}}</h6>
								<img src="{{$comuna->region->url}}" class="img-raised rounded-circle tamaño-imagen-pequeño margin-arriba margin-abajo">
								<form method="post" action="{{url('/administrador/comunas/'.$comuna->id)}}" style="margin-top: -25px;">
									{{csrf_field()}}
									{{method_field('DELETE')}}
									<a class="btn btn-simple btn-sm" href="{{url('/administrador/comunas/'.$comuna->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="Modificar la Comuna"><i class="material-icons actualizar">refresh</i></a>
									<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar la Comuna"><i class="material-icons eliminar">delete</i></i></button>
								</form>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				{{$comunas->links('vendor.pagination.bootstrap-4')}}
			</div>
		</div>
	</div>	
@endsection