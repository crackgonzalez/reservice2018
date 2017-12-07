@extends('layouts.app')
@section('titulo','Mantenedor de Categorias')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<!-- <div class="col-12 col-sm-2 col-md-2">
			Por definir la barra de menu
		</div> -->
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-header text-center">
					<h4 class="card-title">Listado de Categorias</h4>
					<a href="{{url('/administrador/categorias/create')}}" class="btn btn-warning">Agregar Categoria</a>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($categorias as $categoria)
						<div class="col-12 col-sm-4 col-md-3 col-lg-2">
							<div class="text-center">
								<img src="{{$categoria->url}}" class="img-raised rounded-circle tamaño-imagen margin-arriba margin-abajo">
								<h5>{{$categoria->category}}</h5>
								<a href=""><i class="material-icons actualizar">refresh</i></a>
								<a href=""><i class="material-icons eliminar">delete</i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection
