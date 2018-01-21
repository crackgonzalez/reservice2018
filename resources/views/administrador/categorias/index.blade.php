@extends('layouts.app')
@section('titulo','Mantenedor de Categorias')
@section('usuario','Administrador')
@section('barra-navegacion')
	@include('includes.menu-admin')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-header text-center">
					<h4 class="card-title">Listado de Categorias</h4>
					<a href="{{url('/administrador/categorias/create')}}" class="btn btn-warning btn-sm link-1">Agregar Categoria</a>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($categorias as $categoria)
						<div class="col-12 col-sm-4 col-md-3">
							<div class="text-center separacion-fotos">
								<img src="{{$categoria->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
								<h5>{{$categoria->category}}</h5>								
								<form method="post" action="{{url('/administrador/categorias/'.$categoria->id)}}">
									{{csrf_field()}}
									{{method_field('DELETE')}}
									<a class="btn btn-simple btn-sm" href="{{url('/administrador/categorias/'.$categoria->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="Modificar la Categoria"><i class="material-icons actualizar">refresh</i></a>
									<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar la Categoria"><i class="material-icons eliminar">delete</i></i></button>									
								</form>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				{{$categorias->links('vendor.pagination.bootstrap-4')}}
			</div>
		</div>
	</div>	
@endsection


