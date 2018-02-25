@extends('layouts.app')
@section('titulo','Resumen')
@section('usuario','Administrador')
@section('barra-navegacion')
	@include('includes.menu-admin')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
@endsection