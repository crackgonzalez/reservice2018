@extends('layouts.app')
@section('titulo','Ubicacion')
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
		<div class="col-12 col-sm-1 col-md-1"></div>
		<div class="col-12 col-sm-10 col-md-10">
			<div id="map" class="mapa margin-arriba margin-abajo"></div>
            <div id="right-panel">
                <p>Distancia Total: <span id="total"></span></p>
            </div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: -24.345, lng: 134.46}  // Australia.
        });

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            draggable: true,
            map: map,
            panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function() {
            computeTotalDistance(directionsDisplay.getDirections());
        });

        displayRoute('{{$empresa->address}}, {{$empresa->comuna->commune}}','{{$cliente->address}}, {{$cliente->comuna->commune}}', directionsService,
            directionsDisplay);
    }

    function displayRoute(origin, destination, service, display) {
        service.route({
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING',
            avoidTolls: true
        }, function(response, status) {
            if (status === 'OK') {
                display.setDirections(response);
            } else {
                alert('Could not display directions due to: ' + status);
            }
        });
    }

    function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
            total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }

</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmodiJXhAJMxo-fS9PMpxiNd2JvaDt7Fs&callback=initMap">
</script>
@endsection



<!-- 
Devuelve las coordenadas de lat y lon

if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitud').value=position.coords.latitude;
            document.getElementById('longitud').value=position.coords.longitude;
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
 -->