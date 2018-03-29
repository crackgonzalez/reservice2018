@extends('layouts.app')
@section('titulo','Calificar al Trabajador')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<div class="row">
			@foreach($clientes as $cliente)				
				@forelse($cliente->trabajadores as $trabajador)
					<div class="col-12 col-sm-3 col-md-3">
						<div class="card margin-arriba margin-abajo card-raised">
							<img class="card-img-top" style="height:200px" src="{{$trabajador->url}}">
							<div class="card-body">
								<h3>Datos de prueba</h3>
								<h3>Nota {{$trabajador->pivot->score}}</h3>
							</div>
						</div>
					</div>
				@empty
					@section('mensaje','Calificaciones')
					@include('includes.mensaje')
				@endforelse
			@endforeach	
		</div>
	</div>
</div>
@endsection