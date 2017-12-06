@extends('layouts.app')
@section('titulo','Mantenedor de Servicios')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12">
					<div class="card">
						<div class="card-block">
						    <table class="table table-responsive">
								<thead>
									<tr>
										<th>ID</th>
										<th>Servicio</th>
										<th>Categoria</th>
										<th>Opcion</th>
							    	</tr>
							    </thead>
							    <tbody>
							    	@foreach($servicios as $servicio)
							    	<tr>
							    		<td>{{$servicio->id}}</td>
						    			<td>{{$servicio->service}}</td>
						    			<td>{{$servicio->categoria->category}}</td>
						    			<td>Agregar | Modificar | Eliminar</td>
							    	</tr>
						    		@endforeach	    		
							    </tbody>
							</table>
							<div>
								{{$servicios->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection