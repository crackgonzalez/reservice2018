@extends('layouts.app')
@section('titulo','Mantenedor de Categorias')
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12">
		    <table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Categoria</th>
						<th>Opcion</th>
			    	</tr>
			    </thead>
			    <tbody>
			    	@foreach($categorias as $categoria)
			    	<tr>
			    		<td>{{$categoria->id}}</td>
		    			<td>{{$categoria->category}}</td>
		    			<td></td>
			    	</tr>
		    		@endforeach	    		
			    </tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12">
			<div>	
				{{$categorias->links()}}
			</div>			
		</div>	
	</div>	
@endsection




