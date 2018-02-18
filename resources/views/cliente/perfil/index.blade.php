@extends('layouts.app')
@section('titulo','Perfil del Cliente')
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
				@foreach($clientes as $cliente)
				@if($cliente->user_id == Auth::user()->id)
				<div class="wrapper">
					<div class="header header-filter" style="background-image:url('../imagenes/paisaje.jpg'); border-radius: 4px 4px 0px 0px;">
						<div class="container">
							<div class="row">
								<div class="col-12 col-sm-2 col-md-3">
                				</div>
                				<div class="col-12 col-sm-8 col-md-6 text-center">
                					<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$cliente->url}}" style="background: #fff; margin-top: 15px;" alt="">
                					<h2 class="link-1">{{$cliente->usuario->name}}</h2>									
									<h6 class="link-1 margin-arriba">{{$cliente->usuario->email}}</h6>
									<h6 class="link-1">{{$cliente->phone}}</h6>
									<h6 class="link-1">{{$cliente->address}}</h6>
									@empty($cliente->comuna->commune)
									<h6 class="link-1">Ingrese una comuna</h6>
									@endempty
									@isset($cliente->comuna->commune)
									<h6 class="link-1">{{$cliente->comuna->commune}}</h6>
									@endisset
									<form method="post" action="{{url('/cliente/perfil/'.$cliente->id)}}">
										{{csrf_field()}}
										<a class="btn btn-warning btn-sm link-1" href="{{url('/cliente/perfil/'.$cliente->id.'/edit')}}">Administrar Perfil</a>
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
									</ul>
									<div class="tab-content">
										<div class="tab-pane text-center active" id="mapa">
											<div class="row">
											@isset($cliente->comuna->commune)
												<input id="address" type="hidden" value="{{$cliente->address}},{{$cliente->comuna->commune}}">
	    										<div id="map" class="mapa margin-arriba"></div>
											@endisset  
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