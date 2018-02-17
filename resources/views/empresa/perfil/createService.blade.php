@extends('layouts.app')
@section('titulo','Agregar un Servicio')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('fondo','fondo-foto')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-3 col-md-3"></div>
				<div class="col-12 col-sm-6 col-md-6">
					@if($errors->any())
						<div class="alert alert-danger margin-arriba">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="card margin-arriba margin-abajo card-raised">						
						<div class="card-header text-center">
							<h4 class="card-title">Agregar un Servicio</h4>
						</div>
						<div class="card-body">
							<form action="{{url('/empresa/perfil/createService')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">work</i></span>
                                        <select name="category_id" class="form-control" id="category_id">
                                        	<option value="0">Seleccione una Categoria</option>
	                                        	@foreach($categorias as $categoria)
	                                            <option value="{{$categoria->id}}">{{$categoria->category}}</option>
	                                			@endforeach
                                        </select>
                                    </div>
                                </div>
                                <input name="company" class="form-control" type="hidden" value="{{Auth::user()->empresa->id}}">
                                <div class="form-group">
									<div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">content_paste</i></span>
                                        <select name="service_id" class="form-control" id="service_id">
                                        	<option value="0">Seleccione un Servicio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
									<a href="{{url('/empresa/perfil')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
									<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Agregar</button>
								</div>								
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-3 col-md-3"></div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		$(function(){
			$('#category_id').on('change', onSelectCategoryChange);
		});

		function onSelectCategoryChange(){
			var cat_id = $(this).val();			
			$.get('/api/empresa/perfil/'+cat_id+'/servicios',function(data){
				var html_select = '<option value ="0"> Seleccione un Servicio</option>';
			
				for (var i=0; i<data.length;++i){
					html_select += '<option value ="'+data[i].id+'">'+data[i].service+'</option>';

				}
				$('#service_id').html(html_select);
			});
		}
	</script>
@endsection
