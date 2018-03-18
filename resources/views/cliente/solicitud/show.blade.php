@extends('layouts.app')
@section('titulo','Perfil de la Empresa')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">				
				<div class="wrapper">
					<div class="header header-filter" style="background-image:url('/imagenes/ciudad.jpg'); border-radius: 4px 4px 0px 0px;">
						<div class="container">
                			<div class="row">
                				<div class="col-12 col-sm-2 col-md-3">                						
                				</div>
                				<div class="col-12 col-sm-8 col-md-6 text-center">
									<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$compania->url}}" style="background: #fff; margin-top: 15px;" alt="">
									@if($compania->usuario->validation)
										<img class="img-raised rounded-circle" style="height: 45px; width: 45px; margin-left: -55px; margin-bottom: -130px;" src="{{asset('imagenes/verificado.png')}}" data-toggle="tooltip" data-placement="right" title="Cuenta Verficada">
									@endif
									<h2 class="link-1">{{$compania->usuario->name}}</h2>
									<small class="link-1 text-justify">{{$compania->description}}</small>
									<h6 class="link-1">{{$compania->address}}</h6>
									@empty($compania->comuna->commune)
									<h6 class="link-1">Ingrese una comuna</h6>
									@endempty
									@isset($compania->comuna->commune)
									<h6 class="link-1">{{$compania->comuna->commune}}</h6>
									@endisset									
									<form action="" method="POST" enctype="multipart/form-data">
										<a class="btn btn-warning btn-sm link-1 margin-arriba" href="{{url('/cliente/solicitud/'.$compania->id.'/cotizar')}}">Solicitar un Servicio</a>
									</form>
								</div>
                			</div>
                		</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-1 col-md-1"></div>
						<div class="col-12 col-sm-10 col-md-10">
							<div class="profile-tabs">
								<div class="nav-align-center">
									<ul class="nav nav-pills" role="tablist">
										<li class="nav-pills-estilo active">
											<a href="#mapa" role="tab" data-toggle="tab">
												<i class="material-icons">pin_drop</i>Mapa
											</a>													
										</li>
										<li class="nav-pills-estilo">
											<a href="#servicios" role="tab" data-toggle="tab">
												<i class="material-icons">work</i>Servicios
											</a>
										</li>
										<li class="nav-pills-estilo">
											<a href="#comunas" role="tab" data-toggle="tab">
												<i class="material-icons">my_location</i>Comunas
											</a>
										</li>
										<li class="nav-pills-estilo">
											<a href="#galeria" role="tab" data-toggle="tab">
												<i class="material-icons">add_a_photo</i>Galeria
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane text-center active" id="mapa">
											<div class="row">
				                            @isset($compania->comuna->commune)
	    										<input id="address" type="hidden" value="{{$compania->address}},{{$compania->comuna->commune}}">
	    										<div id="map" class="mapa margin-arriba"></div>
				                            @endisset                  	
				                            </div>
										</div>
										<div class="tab-pane text-center" id="servicios">
											<div class="row">
												@foreach($compania->servicios as $servicios)
												<div class="col-12 col-sm-4 col-md-3">
													<div class="text-center separacion-fotos">
														<img src="{{$servicios->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
														<h5>{{$servicios->service}}</h5>
														<h6>{{$servicios->categoria->category}}</h6>
														<img src="{{$servicios->categoria->url}}" class="img-raised rounded-circle tamaño-imagen-pequeño margin-arriba margin-abajo">
													</div>
												</div>
												@endforeach
											</div>
										</div>
										<div class="tab-pane text-center" id="comunas">
											<div class="row">
												@foreach($compania->comunas as $comunas)
												<div class="col-12 col-sm-4 col-md-3">
													<div class="text-center separacion-fotos">
														<img src="{{$comunas->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
														<h5>{{$comunas->commune}}</h5>
														<h6>{{$comunas->region->region}}</h6>
														<img src="{{$comunas->region->url}}" class="img-raised rounded-circle tamaño-imagen-pequeño margin-arriba margin-abajo">
													</div>
												</div>
												@endforeach
											</div>
										</div>
										<div class="tab-pane text-center" id="galeria">											
											<div class="row">
												@foreach($compania->fotos as $fotos)
												<div class="col-12 col-sm-4 col-md-4">
													<div class="text-center ">
														<img src="{{$fotos->url}}" class="tamaño-imagen-grande margin-arriba margin-abajo img-raised img-thumbnail">
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
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
        	zoom: 17,
        	center: {lat: -33.4378394, lng: -70.6526683}
        });
        var geocoder = new google.maps.Geocoder();
        geocodeAddress(geocoder, map);
    }

    function geocodeAddress(geocoder, resultsMap) {
    	var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
        	if (status === 'OK') {
        		resultsMap.setCenter(results[0].geometry.location);
        		var marker = new google.maps.Marker({
        			map: resultsMap,
        			position: results[0].geometry.location
        		});
        	}else {
        		alert('Geocode was not successful for the following reason: ' + status);
        	}
        });
    }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmodiJXhAJMxo-fS9PMpxiNd2JvaDt7Fs&callback=initMap">
    </script>
@endsection