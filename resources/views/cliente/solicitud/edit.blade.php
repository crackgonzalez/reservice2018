@extends('layouts.app')
@section('titulo','Confirmar Solicitud')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
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
						<h4 class="card-title">Confirmar la Solicitud a {{$orden->empresa->usuario->name}}</h4>
					</div>
					<div class="card-body">
						<form action="{{url('/cliente/solicitud/'.$orden->id.'/edit')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="material-icons">terrain</i></span>
									<select name="state_client" class="form-control">
										<option value=null>Seleccione una Opcion</option>
										@if($orden->state_company == 1)
											<option value=1>Confirmar Solicitud</option>
											<option value=2>Rechazar Solicitud</option>
										@elseif($orden->state_company == 2)
											<option value=2>Rechazar Solicitud</option>
										@endif
                                	</select>
                                </div>
                            </div>
                                                    
							<div class="form-group">
								<a href="{{url('/cliente/solicitud')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
								<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Confirmar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection