@extends('layouts.app')
@section('titulo','Mantenedor de Categorias')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-3"></div>
				<div class="col-12 col-sm-12 col-md-6">
					<div class="card">
						<div class="card-block">
						    <table class="table table-responsive">
								<thead>
									<tr>
										<th>ID</th>
										<th>Categoria</th>
										<th>Imagen</th>
										<th>Opcion</th>
							    	</tr>
							    </thead>
							    <tbody>
							    	@foreach($categorias as $categoria)
							    	<tr>
							    		<td>{{$categoria->id}}</td>
						    			<td>{{$categoria->category}}</td>
						    			<td><img src="{{$categoria->url}}"></td>
						    			<td>Agregar | Modificar | Eliminar</td>
							    	</tr>
						    		@endforeach	    		
							    </tbody>
							</table>
							<div>	
								{{$categorias->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>					
		</div>
	</div>	
@endsection
