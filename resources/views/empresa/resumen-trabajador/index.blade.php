@extends('layouts.app')
@section('titulo','Resumen de Trabajadores')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
    @if($trabajadores->isEmpty())
        @section('mensaje','Resumen de Trabajadores')
        @include('includes.mensaje') 
    @else
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card text-center margin-arriba margin-abajo">
                <div class="card-header"><h4>Resumen de Trabajadores</h4></div>
                <div class="card-body">
                    <div id="piechart" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    @endif              
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
    }
    </script>
@endsection
                    
				

                    
