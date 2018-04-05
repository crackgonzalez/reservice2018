@extends('layouts.app')
@section('titulo','Resumen Reservas')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">	
    @if($reservas->isEmpty())
        @section('mensaje','Resumen de Reservas')
        @include('includes.mensaje') 
    @else
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card text-center margin-arriba margin-abajo">
                <div class="card-header"><h4>Resumen de Reservas</h4></div>
                <div class="card-body">
                    <div id="calendar_basic" style="width: 100%; height: 100%;"></div>                    
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card text-center margin-arriba margin-abajo">
                        <div class="card-header"><h4>Detalle por Mes</h4></div>
                        <div class="card-body">
                            @include('includes.tabla-reservas')
                        </div>
                    </div>
                </div>                
            </div>
        </div>        
    @endif 
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
            var totalAnual = 0;
            var enero = 0;
            var febrero = 0;
            var marzo = 0;
            var abril = 0;
            var mayo = 0;
            var junio = 0;
            var julio = 0;
            var agosto = 0;
            var septiembre = 0;
            var octubre = 0;
            var noviembre = 0;
            var diciembre = 0; 
            @foreach($reservas as $reserva)
                @if($reserva->company_id == Auth::user()->empresa->id)
                    var fecha = '{{$reserva->date}}';
                    var year = fecha.substring(0, 4);
                    var mes = fecha.substring(5,7);
                    var dia = fecha.substring(8,10);

                    if(mes == 1){
                        enero++;
                    }else if(mes == 2){
                        febrero++;
                    }else if(mes == 3){
                        marzo++;
                    }else if(mes == 4){
                        abril++;
                    }else if(mes == 5){
                        mayo++;
                    }else if(mes == 6){
                        junio++;
                    }else if(mes == 7){
                        julio++;
                    }else if(mes == 8){
                        agosto++;
                    }else if(mes == 9){
                        septiembre++;
                    }else if(mes == 10){
                        octubre++;
                    }else if(mes == 11){
                        noviembre++;
                    }else if(mes == 12){
                        diciembre++;
                    }

                    dataTable.addRows([
                        [new Date(year,(mes-1),dia), {{$reserva->reserva}} ],
                    ]);

                @endif
            @endforeach
            var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));
            var options = {
                
                height: 250,         
                calendar: { 
                    cellSize: 20,
                    daysOfWeek: 'DLMMJVS',},
                    noDataPattern: {
                        backgroundColor: '#ffca2c',
                        color: '#fff0c4'           
                    }
                };

            chart.draw(dataTable, options);
        
            document.getElementById('enero').innerHTML = enero;
            document.getElementById('totalEnero').innerHTML ='$'+enero*250;

            document.getElementById('febrero').innerHTML = febrero;
            document.getElementById('totalFebrero').innerHTML = '$'+febrero*250;

            document.getElementById('marzo').innerHTML = marzo;
            document.getElementById('totalMarzo').innerHTML = '$'+marzo*250;

            document.getElementById('abril').innerHTML = abril;
            document.getElementById('totalAbril').innerHTML = '$'+abril*250;

            document.getElementById('mayo').innerHTML = mayo;
            document.getElementById('totalMayo').innerHTML = '$'+mayo*250;

            document.getElementById('junio').innerHTML = junio;
            document.getElementById('totalJunio').innerHTML = '$'+junio*250;

            document.getElementById('julio').innerHTML = julio;
            document.getElementById('totalJulio').innerHTML = '$'+julio*250;

            document.getElementById('agosto').innerHTML = agosto;
            document.getElementById('totalAgosto').innerHTML = '$'+agosto*250;

            document.getElementById('septiembre').innerHTML = septiembre;
            document.getElementById('totalSeptiembre').innerHTML = '$'+septiembre*250;

            document.getElementById('octubre').innerHTML = octubre;
            document.getElementById('totalOctubre').innerHTML = '$'+octubre*250;

            document.getElementById('noviembre').innerHTML = noviembre;
            document.getElementById('totalNoviembre').innerHTML = '$'+noviembre*250;

            document.getElementById('diciembre').innerHTML = diciembre;
            document.getElementById('totalDiciembre').innerHTML = '$'+diciembre*250;

            document.getElementById('annio').innerHTML = enero+febrero+marzo+abril+mayo+junio+julio+agosto+septiembre+octubre+noviembre+diciembre;

            document.getElementById('totalAnnio').innerHTML ='$'+(enero+febrero+marzo+abril+mayo+junio+julio+agosto+septiembre+octubre+noviembre+diciembre)*250;
        }
    </script>
@endsection
