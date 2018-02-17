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
							<h4 class="card-title">Solicitar un Servicio a {{$compania->usuario->name}}</h4>
						</div>
						<div class="card-body">
							<form action="" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<select name="service_id" class="form-control">
											<option value="">Seleccione Servicio</option>
											@foreach($compania->servicios as $servicios)
											<option value="{{$servicios->id}}"
											>{{$servicios->service}}</option>
											@endforeach
                                		</select>
                               		</div>
                           		</div>
                           		<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<select name="" class="form-control">
											<option value="">Seleccione Fecha</option>
										
											<option value=""
											></option>
                                		</select>
                               		</div>
                           		</div>
                           		<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<select name="commune_id" class="form-control">
											<option value="">Seleccione Comuna</option>
											@foreach($compania->comunas as $comunas)
											<option value="{{$comunas->id}}"
											>{{$comunas->commune}}</option>
											@endforeach
                                		</select>
                               		</div>
                           		</div>
                           		<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<select name="" class="form-control">
											<option value="">Seleccione Tramo Horario</option>
										
											<option value=""
											></option>
                                		</select>
                               		</div>
                           		</div>
                           		<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">description</i></span>
										<textarea name="" placeholder="Descripcion del Problema" class="form-control" cols="30" rows="4"></textarea>
									</div>
								</div>
                           		<div class="form-group">
									<input type="file" class="form-control-file" name="image">
								</div>								
								<div class="form-group">
									<a href="{{url('/cliente/buscar')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
									<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Solicitar</button>
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