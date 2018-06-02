@extends('layouts.app')
@section('titulo','Reservice')
@section('estilo-footer')
    <link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
    <div class="row">
		<div class="col-12 col-sm-12 col-md-12">
    		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-right: -15px; margin-left: -15px;">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="{{asset('imagenes/abogado.png')}}" alt="First slide" style="height: 450px;">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres abogado?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/mecanico.png')}}" alt="Second slide" style="height: 450px;">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres mecanico y tienes un taller?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/constructor.png')}}" alt="Third slide" style="height: 450px;">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Tienes una microempresa dedicada a la construccion?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>    		
    </div>
    <div class="row">
    	<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-3 col-md-3">
						</div>
						<div class="col-12 col-sm-9 col-md-9">
							<form class="form-inline text-center" method="get" autocomplete="off">
								<div class="form-group" style="margin: 5px;">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Buscar Servicio">
									</div>
								</div>								
								<div class="form-group" style="margin: 5px;">
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
										<select name="price" class="form-control">
											<option value="asc">Ordenar por Precio</option>
											<option value="asc">Menor a Mayor Precio</option>
											<option value="desc">Mayor a Menor Precio</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="margin: 5px;">
									<div class="input-group">
										<input type="submit" value="Buscar" class="btn btn-sm btn-warning link-1">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				@forelse($servicios as $servicio)				
					<div class="col-12 col-sm-3 col-md-3">									
						<div class="card margin-arriba margin-abajo card-raised">
							<img class="card-img-top" src="imagenes/perfil/{{$servicio->image}}" style="height:180px">
							<div class="card-body">
								<h5 class="d-inline"><i class="far fa-building"></i> {{$servicio->name}}</h5>
								@if($servicio->validation)
									<img class="img-raised rounded-circle" style="height: 30px; width: 30px;" src="{{asset('imagenes/verificado.png')}}" data-toggle="tooltip" data-placement="right" title="Cuenta Verficada">
								@endif
								<h6 class="margin-arriba"><i class="fas fa-suitcase"></i> {{$servicio->service}}</h6>
								<h6 class="margin-arriba"><i class="fas fa-dollar-sign"></i> {{$servicio->price}}</h6>
								<h6 class="margin-arriba"><i class="far fa-comments"></i> Descripcion de la Empresa</h6>
								<small class="text-justify">{{$servicio->description}}</small>
								<div class="margin-arriba">
									<a class="btn btn-warning btn-sm pull-right link-1" href="{{ route('register') }}">Registrarse</a>
									<a class="btn btn-warning btn-sm pull-right link-1 margin-derecho" href="{{ route('login') }}">Iniciar Sesion</a>
								</div>
							</div>
						</div>
					</div>
				@empty
					@include('includes.mensaje')
				@endforelse
			</div>				
		</div>
	</div>
@endsection


