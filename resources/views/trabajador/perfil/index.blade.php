@extends('layouts.app')
@section('titulo','Perfil del Trabajador')
@section('usuario','Trabajador')
@section('barra-navegacion')
	@include('includes.menu-trabajador')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				@foreach($trabajador as $empleado)				
				<div class="wrapper">
					<div class="header header-filter" style="background-image:url('../imagenes/valle.jpg'); border-radius: 4px 4px 0px 0px;">
						<div class="container">
							<div class="row">
								<div class="col-12 col-sm-2 col-md-3">
                				</div>
                				<div class="col-12 col-sm-8 col-md-6 text-center">
                					<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$empleado->url}}" style="background: #fff; margin-top: 15px;" alt="">
                					<h2 class="link-1">{{$empleado->usuario->name}}</h2>
									<div data-toggle="tooltip" data-placement="bottom" title="Nota {{round($contador,0)}}">	
									@for ($i = 0; $i < $contador; $i++)
    									<i class="material-icons link-1">grade</i>
									@endfor
									</div>
                					<h6 class="link-1">{{$empleado->usuario->email}}</h>
                					<h6 class="link-1">{{$empleado->phone}}</h6>
                					<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$empleado->empresa->url}}">
									<h6 class="link-1 d-inline">{{$empleado->empresa->usuario->name}}</h6>			
									<form method="post" action="{{url('/trabajador/perfil/'.$empleado->id)}}">
										{{csrf_field()}}
										<a class="btn btn-warning btn-sm link-1 margin-arriba" href="{{url('/trabajador/perfil/'.$empleado->id.'/edit')}}">Administrar Perfil</a>
									</form>	
                				</div>
							</div>
						</div>
					</div>
				</div>						
				@endforeach	
			</div>
		</div>
	</div>
@endsection