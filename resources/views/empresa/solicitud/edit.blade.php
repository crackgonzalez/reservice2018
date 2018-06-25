@extends('layouts.app')
@section('titulo','Confirmar Solicitud')
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
						<h4 class="card-title">Responder la Solicitud de {{$solicitud->cliente->usuario->name}}</h4>
					</div>
					<div class="card-body">
						<form action="{{url('/empresa/solicitud/'.$solicitud->id.'/edit')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-clipboard-check"></i></span>
									<select name="state_company" class="form-control">
										<option value=null>Seleccione una Opcion</option>
										<option value=1>Confirmar Solicitud</option>
										<option value=2>Rechazar Solicitud</option>
                                	</select>
                                </div>
                            </div>
                            <div class="form-group">
                            	<div class="input-group">
                            		<span class="input-group-addon"><i class="far fa-comments"></i></span>
                            		<textarea name="answer" placeholder="Respuesta" class="form-control" cols="30" rows="4">{{old('answer',$solicitud->answer)}}</textarea>
                            	</div>
                            </div>
                         
							<div class="form-group">
								<a href="{{url('/empresa/solicitud')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
								<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Responder</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection