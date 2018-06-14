@extends('layouts.app')
@section('titulo','Resumen Calificacion')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		@if($notas->isEmpty())
        	@section('mensaje','Resumen de Calificaciones')
        	@include('includes.mensaje') 
    	@else
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card text-center margin-arriba margin-abajo">
                <div class="card-header"><h4>Resumen de Calificaciones</h4></div>
                <div class="card-body">
                    <div id="chart_div" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    	@endif 
	</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    	google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string','Nombre');
      data.addColumn('number', 'Nota');
      data.addRows([
        @foreach($notas as $nota)
        ['{{$nota->name}}',{{$nota->promedio}}],
        @endforeach
      ]);

      var options = {
        hAxis: {
          title: 'Trabajadores'
        },
        vAxis: {
          title: 'Escala de notas',
          minValue: 0,
        }
      };

      var chart = new google.visualization.ColumnChart(
       document.getElementById('chart_div'));

      chart.draw(data, options);
    }
    </script>
@endsection
