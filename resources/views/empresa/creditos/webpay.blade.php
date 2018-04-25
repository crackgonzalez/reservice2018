@extends('layouts.app')
@section('titulo','Comprar Creditos')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('fondo','fondo-foto')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
	<div class="col-12 col-sm-3 col-md-3"></div>
	<div class="col-12 col-sm-6 col-md-6">
		<div class="card margin-arriba margin-abajo card-raised">
			<div class="card-header text-center">
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<img class="pull-left" src="{{asset('imagenes/logo.png')}}" width="18%">
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<img class="pull-right" src="{{asset('imagenes/webpay.png')}}" width="40%">
					</div>
				</div>
			</div>
			<div class="card-body">
				<h1>Por terminar</h1>
			</div>
		</div>
	</div>
</div>
@endsection