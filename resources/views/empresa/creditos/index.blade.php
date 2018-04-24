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
				<h4 class="card-title">Comprar Creditos</h4>
			</div>
			<div class="card-body">
				<form action="{{url('empresa/creditos/orden')}}" method="POST" enctype="multipart/form-data">		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-mouse-pointer"></i></span>
							<select name="monto" class="form-control">
								<option value="">Seleccione un Plan</option>
								<option value="1000">Basico</option>
								<option value="1750">Estandar</option>
								<option value="7500">Intermedio</option>
								<option value="12500">Avanzado</option>
							</select>
						</div>
					</div>
					<button class="btn btn-sm btn-warning link-1 pull-right" type="submit">Aceptar</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3"></div>
</div>
<div class="row">
	<div class="col-12 col-sm-3 col-md-3">
		<div class="card bg-ligth margin-arriba">
			<div class="card-header">Basico</div>
			<div class="card-body">
				<h5 class="card-title">Comprar 5 creditos</h5>
				<p class="card-text">Adquiera 5 creditos por un precio de $1000 pesos</p>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3">
		<div class="card text-white bg-info margin-arriba">
			<div class="card-header">Estandar</div>
			<div class="card-body">
				<h5 class="card-title">Comprar 10 creditos</h5>
				<p class="card-text">Adquiera 10 creditos por un precio de $1750 pesos</p>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3">
		<div class="card text-white bg-warning margin-arriba">
			<div class="card-header">Intermedio</div>
			<div class="card-body">
				<h5 class="card-title">Comprar 50 creditos</h5>
				<p class="card-text">Adquiera 50 creditos por un precio de $7500 pesos</p>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3">
		<div class="card text-white bg-success margin-arriba">
			<div class="card-header">Avanzado</div>
			<div class="card-body">
				<h5 class="card-title">Comprar 100 creditos</h5>
				<p class="card-text">Adquire 100 creditos por un precio de $12500 pesos</p>
			</div>
		</div>
	</div>
</div>
@endsection