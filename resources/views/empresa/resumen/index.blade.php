@extends('layouts.app')
@section('titulo','Resumen')
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
				<h4 class="card-title">Resumen</h4>
			</div>
			<div class="card-body">               
				<div id="calendar_basic" style="width: 100%; height: 100%;"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current",{packages:["calendar"], 'language' : 'es'});
      google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
       var dataTable = new google.visualization.DataTable();
       dataTable.addColumn({ type: 'date', id: 'Date' });
       dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
       @foreach($reservas as $reserva)
        @if($reserva->company_id == Auth::user()->empresa->id)
            var fecha = '{{$reserva->date}}';
            var year = fecha.substring(0, 4);
            var mes = fecha.substring(5,7);
            var dia = fecha.substring(8,10);
           dataTable.addRows([
            [new Date(year,(mes-1),dia), {{$reserva->reserva}} ],
            ]);
        @endif
       @endforeach

       var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

       var options = {
         title: "Cantidad de reservas en el tiempo",
         height: 400,         
         calendar: { cellSize: 20,
         daysOfWeek: 'DLMMJVS',},
         noDataPattern: {
           backgroundColor: '#ffca2c',
           color: '#fff0c4'           
         }
       };

       chart.draw(dataTable, options);

       // $(window).resize(function(){
       //      drawChart();
       //  });
   }
    </script>
@endsection
