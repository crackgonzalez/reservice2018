@extends('layouts.app')
@section('titulo','Orden de Compra')
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
				<h4 class="card-title">Orden de Compra</h4>
			</div>
			<div class="card-body">
				<h6>Orden N°: {{$orden_compra}}</h6>
				<h6>Monto: {{$monto}}</h6>
				<h6>Descripcion: {{$concepto}}</h6>
				<h6>{{$email}}</h6>
				<form method="POST" action="{{ config('flow.url_pago') }}">
        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        			<input type="hidden" name="parameters" value="{{ $flow_pack }}">
        			<button type="submit">Pagar en Flow</button>
    			</form>
			</div>			
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3"></div>
</div>
@endsection