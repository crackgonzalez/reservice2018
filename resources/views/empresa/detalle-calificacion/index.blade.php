@extends('layouts.app')
@section('titulo','Detalle Calificacion')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-3 col-md-3 text-center">
					@foreach($trabajadores as $trabajador)
					<img src="{{$trabajador->url}}" alt="" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
					<h6>{{$trabajador->usuario->name}}</h6>
					@endforeach
				</div>
				<div class="col-12 col-sm-3 col-md-3">
					<div class="card margin-arriba margin-abajo card-raised">
						<div class="card-header">
							<h5>Promedio Calificacion</h5>
						</div>
						<div class="card-body">							
							@foreach($promedios as $promedio)
								@if($promedio!= null)								
								<h6>Trabajador {{round($promedio->promedio,1)}} <i class="far fa-star"></i></h6>
								@else
									<h6>El Trabajador no cuenta con calificaciones para mostrar la informacion</h6>
								@endif
							@endforeach
							@foreach($empresas as $empresa)
								@if($empresa!=null)
								<h6>Empresa {{round($empresa->promedio,1)}} <i class="far fa-star"></i></h6>
								@else
									<h6>La Empresa no cuenta con calificaciones para mostrar la informacion</h6>
								@endif
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-6">
					<div class="card margin-arriba margin-abajo card-raised">
						<div class="card-header">
							<h4>Grafico</h4>
						</div>
						<div class="card-body"> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-header text-center">
					<h5>Detalle de las calificaciones</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12">
							<div class="row">
								@foreach($notas as $nota)
								<div class="col-12 col-sm-3 col-md-3">
									<div class="card margin-arriba margin-abajo card-raised">
										<img class="card-img-top" style="height:180px" src="{{url('/imagenes/perfil/'.$nota->image)}}">
										<div class="card-body"> 
											<h6><i class="fas fa-user"></i> {{$nota->name}}</h6>
				                			<h6><i class="fas fa-suitcase"></i> {{$nota->service}}</h6>
				                			<h6><i class="far fa-calendar-alt"></i> {{$nota->date}}</h6>
				                			<h6>Calificacion {{$nota->score}} <i class="far fa-star"></i></h6>
				                			<h6><i class="far fa-comments"></i> Comentario</h6>
				                			<small class="text-justify">{{$nota->comment}}</small>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
						
