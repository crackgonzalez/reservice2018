@extends('layouts.app')
@section('titulo','Ruta de Trabajo')
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
		<div class="row">
			<div class="col-12 col-sm-8 col-md-8">
				<div id="map" class="mapa margin-arriba"></div>
			</div>
			<div class="col-12 col-sm-4 col-md-4">
				<div class="card margin-arriba margin-abajo card-raised">
					<div class="card-body">
						
						<!-- Elimine el formulario -->
							<h6>Inicio</h6>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-play" aria-hidden="true"></i></span>
									<select id="inicio" name="inicio" class="form-control">
									</select>									
								</div>
							</div>
							<h6>Paradas Intermedias</h6>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map-pin" aria-hidden="true"></i></span>
									<select multiple="" id="intermedio" name="intermedio" class="form-control">
									</select>									
								</div>
							</div>
							<h6>Fin</h6>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-stop" aria-hidden="true"></i></span>
									<select id="fin" name="fin" class="form-control">
									</select>									
								</div>
							</div>
							<div class="form-group">
								<input class="btn btn-sm btn-warning link-1 pull-right" type="submit" id="submit" value="Calcular">
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
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: {lat: -33.4378394, lng: -70.6526683}
        });

        directionsDisplay.setMap(map);

	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmodiJXhAJMxo-fS9PMpxiNd2JvaDt7Fs&callback=initMap">  	
</script>
@endsection