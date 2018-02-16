@extends('layouts.app')
@section('titulo','Solicitar un Servicio')
@section('usuario','Cliente')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link active" href="{{url('/cliente/perfil')}}">Perfil</span></a>
			<a class="nav-item nav-link active" href="{{url('/cliente/buscar')}}">Buscar Servicio <span class="sr-only">(current)</span></a>
		</div>
	</div>
@endsection
@section('fondo','fondo-foto')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<h1>Pagina Para Solicitar un Servicio</h1>
@endsection