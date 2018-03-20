@extends('layouts.app')
@section('titulo','Validar Cuenta de Empresa')
@section('usuario','Administrador')
@section('barra-navegacion')
	@include('includes.menu-admin')
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
							<h4 class="card-title">Validar la Cuenta de {{$usuario->name}}</h4>
						</div>
						<div class="card-body">
							<form action="" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
																	
								<object height="350px" width="100%"  data="{{asset('archivos/'.$usuario->empresa->documento->document)}}" type="application/pdf"></object>

								<div class="form-group margin-arriba">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">power_settings_new</i></span>
                                        <select name="validation" class="form-control">
                                        	<option value=null>Seleccione una Opcion</option>
                                        	<option value=1>Validar</option>
                                        	<option value=0>No Validado</option>
                                        </select>
                                    </div>
                                </div>
								
								<div class="form-group">
									<a href="{{url('/administrador/empresas')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
									<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Actualizar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-md-3"></div>
			</div>
		</div>
	</div>
@endsection