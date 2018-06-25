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
                            <table class="table table-hover">
                                <thead>
                                    <tr>                                        
                                        <th>Servicio</th>
                                        <th>Cantidad</th>
                                        <th>Mes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($servicios as $servicio)                                    
                                        <tr class="{{$servicio->mes % 2 ? 'table-warning' : 'table-info' }}">
                                            <td>{{$servicio->service}}</td>
                                            <td>{{$servicio->cont}}</td>
                                            <td>
                                                @if($servicio->mes==1)
                                                    Enero
                                                @elseif($servicio->mes==2)
                                                    Febrero
                                                @elseif($servicio->mes==3)
                                                    Marzo
                                                @elseif($servicio->mes==4)
                                                    Abril
                                                @elseif($servicio->mes==5)
                                                    Mayo
                                                @elseif($servicio->mes==6)
                                                    Junio
                                                @elseif($servicio->mes==7)
                                                    Julio
                                                @elseif($servicio->mes==8)
                                                    Agosto
                                                @elseif($servicio->mes==9)
                                                    Septiembre
                                                @elseif($servicio->mes==10)
                                                    Octubre
                                                @elseif($servicio->mes==11)
                                                    Noviembre
                                                @else
                                                    Diciembre
                                                @endif
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                        <tr class="table-dark">
                                            <td><strong>Total Año 2018</strong></td>
                                            <td><strong id="annio"></strong></td>
                                            <td>-</td>
                                        </tr>  
                                </tbody>
                            </table>  
                                                    
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

            var enero = 0, febrero = 0 , marzo = 0, abril = 0, mayo = 0, junio = 0, julio = 0, agosto = 0, septiembre = 0, octubre = 0, noviembre = 0, diciembre = 0;


        
            @foreach($reservas as $reserva)
             
                    var fecha = '{{$reserva->date}}';
                    var year = fecha.substring(0, 4);
                    var mes = fecha.substring(5,7);
                    var dia = fecha.substring(8,10);

                    for (var i = 1; i <= 12; i++) {
                        if(mes == i){
                            if(i == 1){
                                enero += {{$reserva->reserva}}
                            }else if(i == 2){
                                febrero += {{$reserva->reserva}}
                            }else if(i == 3){
                                marzo += {{$reserva->reserva}}
                            }else if(i == 4){
                                abril += {{$reserva->reserva}}
                            }else if(i == 5){
                                mayo += {{$reserva->reserva}}
                            }else if(i == 6){
                                junio += {{$reserva->reserva}}
                            }else if(i == 7){
                                julio += {{$reserva->reserva}}
                            }else if(i == 8){
                                agosto += {{$reserva->reserva}}
                            }else if(i == 9){
                                septiembre += {{$reserva->reserva}}
                            }else if(i == 10){
                                octubre += {{$reserva->reserva}}
                            }else if(i == 11){
                                noviembre += {{$reserva->reserva}}
                            }else if(i == 12){
                                diciembre += {{$reserva->reserva}}
                            }
                        }
                    }
                    document.getElementById("annio").innerHTML = enero+febrero+marzo+abril+mayo+junio+julio+agosto+septiembre+octubre+noviembre+diciembre;

                    dataTable.addRows([
                        [new Date(year,(mes-1),dia), {{$reserva->reserva}} ],
                    ]);

         
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
        }
    </script>
@endsection
