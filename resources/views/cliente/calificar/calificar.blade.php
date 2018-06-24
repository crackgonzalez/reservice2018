@extends('layouts.app')
@section('titulo','Calificar al Trabajador')
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
						<h4 class="card-title">Calificar al Trabajador</h4>
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
							<div class="form-group text-center">
								<img src="{{$reserva->trabajador->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-abajo img-thumbnail">
								<h6>{{$reserva->trabajador->usuario->name}}</h6>
							</div>							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="material-icons">grade</i></span>
									<select name="score" class="form-control">
										<option value="">Asigne una Calificacion</option>
										<option value="1">1</option>	
										<option value="2">2</option>	
										<option value="3">3</option>	
										<option value="4">4</option>
										<option value="5">5</option>
                                	</select>
                                </div>
                            </div>
                            <div class="form-group">
                            	<div class="input-group">
                                	<span class="input-group-addon"><i class="material-icons">description</i></span>
										<textarea name="commets" placeholder="Comentario" class="form-control" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                            
							<div class="form-group">
								<a href="{{url('/cliente/reserva')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
								<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Calificar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection