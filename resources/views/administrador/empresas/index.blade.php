@extends('layouts.app')
@section('titulo','Mantenedor de Empresas')
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
		<div class="row">
			@foreach($empresas as $empresa)
			<div class="col-12 col-sm-3 col-md-3">
				<div class="card margin-arriba margin-abajo card-raised">
					<img class="card-img-top" style="height:210px" src="{{$empresa->url}}">	
					<div class="card-body">
						<h2>{{$empresa->usuario->name}}</h2>
						@if($empresa->usuario->state === 1)
						<h5>Cuenta Activa</h5>
						<h6>Cuenta Creada el {{date('d-m-Y',strtotime($empresa->usuario->created_at))}}</h6>
						@else
						<h5>Cuenta Desactivada</h5>
						<h6>Cuenta Creada el {{date('d-m-Y',strtotime($empresa->usuario->created_at))}}</h6>	
						@endif						
					</div>
				</div>
			</div>
			@endforeach	
		</div>
	</div>
</div>
@endsection