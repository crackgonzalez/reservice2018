@extends('layouts.app')
@section('titulo','Perfil de la Empresa')
@section('usuario','Empresa')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link active" href="{{url('/empresa/perfil')}}">Perfil <span class="sr-only">(current)</span></a>
		</div>
	</div>
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				@foreach($empresas as $empresa)
					@if($empresa->user_id == Auth::user()->id)
						<div class="wrapper">
							<div class="header header-filter" style="background-image:url('../imagenes/ciudad.jpg');">
								<div class="container">
                					<div class="row">
                						<div class="col-12 col-sm-2 col-md-3">
                						</div>
										<div class="col-12 col-sm-8 col-md-6 text-center">
											<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$empresa->url}}" style="background: #fff; margin-top: 15px;" alt="">
											<h2 class="link-1">{{$empresa->usuario->name}}</h2>	
											<small class="link-1 text-justify">{{$empresa->description}}</small>
											<h6 class="link-1 margin-arriba">{{$empresa->usuario->email}}</h6>
											<h6 class="link-1">{{$empresa->phone}}</h6>
											<h6 class="link-1">{{$empresa->address}}</h6>
											@empty($empresa->comuna->commune)
											<h6 class="link-1">Ingrese una comuna</h6>
											@endempty
											@isset($empresa->comuna->commune)
											<h6 class="link-1">{{$empresa->comuna->commune}}</h6>
											@endisset
											<form method="post" action="{{url('/empresa/perfil/'.$empresa->id)}}">
												<a class="btn btn-warning btn-sm link-1" href="{{url('/empresa/perfil/'.$empresa->id.'/edit')}}">Administrar Perfil</a>
											</form>											
										</div>										
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-sm-2 col-md-2"></div>
								<div class="col-12 col-sm-8 col-md-8">
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
													<a href="#galeria" role="tab" data-toggle="tab">
														<i class="material-icons">add_a_photo</i>
														Galeria
													</a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane text-center active" id="mapa">
				                            		<div class="row">				                            			
	    												<input id="address" type="hidden" value="{{$empresa->address}},{{$empresa->comuna->commune}}">
	    												<div id="map" class="mapa"></div>
				                            		</div>
				                        		</div>
				                        		<div class="tab-pane text-center" id="servicios">
													<div class="row">
														<h1>Servicio</h1>
													</div>
				                        		</div>
												<div class="tab-pane text-center" id="galeria">
													<div class="row">
														<h1>Galeria</h1>
													</div>
				                        		</div>

				                    		</div>
										</div>
									</div>
								</div>
							</div>				
						</div>
					@endif
				@endforeach	
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
        // var address = document.getElementById('address').value;
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmodiJXhAJMxo-fS9PMpxiNd2JvaDt7Fs&callback=initMap">
    </script>
@endsection