@extends('layouts.app')
@section('titulo','Agregar una Comuna')
@section('usuario','Empresa')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link active" href="{{url('/empresa/perfil')}}">Perfil <span class="sr-only">(current)</span></a>
		</div>
	</div>
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
							<h4 class="card-title">Agregar una Comuna</h4>
						</div>
						<div class="card-body">
							<form action="{{url('/empresa/perfil/createCommune')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">work</i></span>
                                        <select name="region_id" class="form-control" id="region_id">
                                        	<option value="0">Seleccione una Region</option>
	                                        	@foreach($regiones as $region)
	                                            <option value="{{$region->id}}">{{$region->region}}</option>
	                                			@endforeach
                                        </select>
                                    </div>
                                </div>
                                <input name="company" class="form-control" type="hidden" value="{{Auth::user()->empresa->id}}">
                                <div class="form-group">
									<div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">content_paste</i></span>
                                        <select name="commune_id" class="form-control" id="commune_id">
                                        	<option value="0">Seleccione una Comuna</option>
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
			$('#region_id').on('change', onSelectRegionChange);
		});

		function onSelectRegionChange(){
			var reg_id = $(this).val();			
			$.get('/api/empresa/perfil/'+reg_id+'/comunas',function(data){
				var html_select = '<option value ="0"> Seleccione una Comuna</option>';
			
				for (var i=0; i<data.length;++i){
					html_select += '<option value ="'+data[i].id+'">'+data[i].commune+'</option>';

				}
				$('#commune_id').html(html_select);
			});
		}
	</script>
@endsection
