@extends('layouts.app')
@section('titulo','Crear una Categoria')
@section('fondo','fondo-foto')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-3 col-md-3"></div>
				<div class="col-12 col-sm-6 col-md-6">
					@if($errors->any())
						<div class="alert alert-danger margin-arriba">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="card margin-arriba margin-abajo card-raised">						
						<div class="card-header text-center">
							<h4 class="card-title">Crear una Categoria</h4>
						</div>
						<div class="card-body">
							<form action="{{url('/administrador/categorias')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">work</i></span>
										<input type="text" class="form-control" name="category" placeholder="Categoria">
									</div>
								</div>
								<div class="form-group">
									<input type="file" class="form-control-file" name="image">
								</div>
								<div class="form-group">
									<a href="{{url('/administrador/categorias')}}" class="btn btn-secondary pull-right">Cancelar</a>
									<button type="submit" class="btn btn-warning pull-right margin-derecho">Agregar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-md-3"></div>
			</div>
		</div>
	</div>
@endsection