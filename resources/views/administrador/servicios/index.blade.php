@extends('layouts.app')
@section('titulo','Mantenedor de Servicios')
@section('usuario','Administrador')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link" href="{{url('/administrador/categorias')}}">Categorias <span class="sr-only">(current)</span></a>
			<a class="nav-item nav-link active" href="{{url('/administrador/servicios')}}">Servicios</a>			
		</div>
	</div>
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12">
					<div class="card">
						<h1>Servicios en Construccion</h1>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection