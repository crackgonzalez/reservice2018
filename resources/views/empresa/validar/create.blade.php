@extends('layouts.app')
@section('titulo','Validar Cuenta')
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
						<h4 class="card-title">Subir Certificado de Inicio de Actividades</h4>
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}							
                            <div class="form-group">
								<input type="file" class="form-control-file" name="pdf">
							</div>
							<div class="form-group">
								<a href="{{url('/empresa/perfil')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
								<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Subir Certificado</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection