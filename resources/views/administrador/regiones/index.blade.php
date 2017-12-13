@extends('layouts.app')
@section('titulo','Mantenedor de Regiones')
@section('usuario','Administrador')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link" href="{{url('/administrador/categorias')}}">Categorias <span class="sr-only">(current)</span></a>
			<a class="nav-item nav-link" href="{{url('/administrador/servicios')}}">Servicios</a>
			<a class="nav-item nav-link active" href="{{url('/administrador/regiones')}}">Regiones</a>			
		</div>
	</div>
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-header text-center">
					<h4 class="card-title">Listado de Regiones</h4>
					<a href="{{url('/administrador/regiones/create')}}" class="btn btn-warning btn-sm link-1">Agregar Region</a>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($regiones as $region)
						<div class="col-12 col-sm-4 col-md-3">
							<div class="text-center separacion-fotos">
								<img src="{{$region->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo">
								<h5>{{$region->region}}</h5>								
								<form method="post" action="{{url('/administrador/regiones/'.$region->id)}}">
									{{csrf_field()}}
									{{method_field('DELETE')}}
									<a class="btn btn-simple btn-sm" href="{{url('/administrador/regiones/'.$region->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="Modificar la Categoria"><i class="material-icons actualizar">refresh</i></a>
									<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar la Categoria"><i class="material-icons eliminar">delete</i></i></button>
								</form>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				{{$regiones->links('vendor.pagination.bootstrap-4')}}
			</div>
		</div>
	</div>
@endsection