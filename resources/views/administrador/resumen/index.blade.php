@extends('layouts.app')
@section('titulo','Resumen')
@section('usuario','Administrador')
@section('barra-navegacion')
	@include('includes.menu-admin')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">		
		@if($reservas->isEmpty())
            @section('mensaje','Resumen de Reservas')
            @include('includes.mensaje') 
        @else
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card text-center margin-arriba margin-abajo">
                <div class="card-header"><h4>Resumen de Reservas</h4></div>
                <div class="card-body">
                    <div id="piechart"></div>
                </div>
            </div>
        </div>
    @endif
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
        ['Empresa', 'Cantidad de Reservas'],
       	@foreach($reservas as $reserva)
       	['{{$reserva->name}}',{{$reserva->reserva}}],
       	@endforeach
       	]);

        var options = {
        	title: 'Cantidad de Reservas por Empresa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
@endsection





    
  