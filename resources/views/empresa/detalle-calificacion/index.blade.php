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
					<h5>{{$trabajador->usuario->name}}</h5>
					@endforeach
				</div>
				<div class="col-12 col-sm-9 col-md-9">
					<div class="card margin-arriba margin-abajo card-raised">
						<div class="card-header text-center">
							<h5>Informacion de Calificaciones</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-sm-6 col-md-6 text-center">
									@foreach($promedios as $promedio)
										@if($promedio!= null)							<h5>Promedio Trabajador {{round($promedio->promedio,1)}} <i class="far fa-star"></i></h5>
										@else
											<h6>El Trabajador no cuenta con calificaciones para mostrar la informacion</h6>
										@endif
									@endforeach
									@foreach($empresas as $empresa)
										@if($empresa!=null)
											<h5>Promedio Empresa {{round($empresa->promedio,1)}} <i class="far fa-star"></i></h5>
										@else
											<h6>La Empresa no cuenta con calificaciones para mostrar la informacion</h6>
										@endif
									@endforeach
								</div>
								<div class="col-12 col-sm-6 col-md-6">
									<h5>Escala de Notas</h5>
									<h6>5 <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h6>
									<h6>4 <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h6>
									<h6>3 <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h6>
									<h6>2 <i class="far fa-star"></i><i class="far fa-star"></i></h6>
									<h6>1 <i class="far fa-star"></i></h6>
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
							<h4>Grafico</h4>
						</div>
						<div class="card-body text-center">
							<div id="piechart" style="width: 100%; height: 400px;"></div>
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
@section('scripts')
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
          		['Task', 'Hours per Day'],
          		['Work',     11],
          		['Eat',      2],
          		['Commute',  2],
          		['Watch TV', 2],
          		['Sleep',    7]
        	]);

			var options = {
          		is3D: true,
        	};

        	var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        	chart.draw(data, options);
		}
	</script>
@endsection
						
