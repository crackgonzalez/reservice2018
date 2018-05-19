@extends('layouts.app')
@section('titulo','Solicitar Presupuesto')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<h1>Realizar Solicitud Multiple en Construccion...</h1>
@endsection