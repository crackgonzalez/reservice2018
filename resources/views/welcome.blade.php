@extends('layouts.app')
@section('titulo','Reservice')
@section('estilo-footer')
    <link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
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
						<img class="d-block w-100" src="{{asset('imagenes/abogado.png')}}" alt="First slide" width="100%">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres abogado?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/mecanico.png')}}" alt="Second slide" width="100%">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres mecanico y tienes un taller?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/constructor.png')}}" alt="Third slide" width="100%">
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
@endsection
