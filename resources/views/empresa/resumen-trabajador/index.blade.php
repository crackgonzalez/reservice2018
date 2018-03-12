@extends('layouts.app')
@section('titulo','Resumen Trabajadores')
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
		<div class="card margin-arriba margin-abajo card-raised">
			<div class="card-header text-center">
				<h4 class="card-title">Cantidad de Trabajos Asignados por Trabajador</h4>                
			</div>
			<div class="card-body">               
				@if($trabajadores->isEmpty())
                    <h3 class="text-center">No hay datos para mostrar la informacion</h3>
                @else
                    
                    <div id="piechart" style="width: 100%; height: 100%;"></div>
                @endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Trabajador', 'Cantidad de Trabajados Asignados'],
        @foreach($trabajadores as $trabajador)
        ['{{$trabajador->name}}',{{$trabajador->trabajador}}],
        @endforeach
        ]);

        var options = {
            
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);

        $(window).resize(function(){
            drawChart();
        });
    }
    </script>
@endsection
