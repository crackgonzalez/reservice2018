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
			<input id="latitud" type="text">
			<input id="longitud" type="text">
			<div id="map" class="mapa margin-arriba margin-abajo"></div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
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