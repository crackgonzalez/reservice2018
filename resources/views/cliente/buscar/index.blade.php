@extends('layouts.app')
@section('titulo','Buscar un Servicio')
@section('usuario','Cliente')
@section('barra-navegacion')
	@include('includes.menu-cliente')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-9 col-md-9">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-3 col-md-3">
						</div>
						<div class="col-12 col-sm-9 col-md-9">
							<form class="form-inline text-center" method="get" autocomplete="off">
								<div class="form-group" style="margin: 5px;">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">terrain</i></span>
										<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Buscar Servicio">
									</div>
								</div>								
								<div class="form-group" style="margin: 5px;">
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
										<select name="price" class="form-control">
											<option value="asc">Ordenar por Precio</option>
											<option value="desc">Mayor a Menor Precio</option>
											<option value="asc">Menor a Mayor Precio</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="margin: 5px;">
									<input type="submit" value="Buscar" class="btn btn-sm btn-warning link-1">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-3 col-md-3">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-body text-center">
					@if($creditos> 0)
					<div class="form-group" style="margin: 8px;">
						<a class="btn btn-sm btn-success" href="{{url('/cliente/presupuesto/solicitar')}}">Solicitar Servicio Hoy</a>
					</div>
					@else
					<div class="form-group" style="margin: 8px;">
						<button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="No tienes creditos en tu cuenta">Solicitar Servicio Hoy</button>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				@forelse($servicios as $servicio)				
					<div class="col-12 col-sm-3 col-md-3">									
						<div class="card margin-arriba margin-abajo card-raised">
							<img class="card-img-top" src="../imagenes/perfil/{{$servicio->image}}" style="height:200px">
							<div class="card-body">
								<h4 class="d-inline">{{$servicio->name}}</h4>
								@if($servicio->validation)
									<img class="img-raised rounded-circle" style="height: 30px; width: 30px;" src="{{asset('imagenes/verificado.png')}}" data-toggle="tooltip" data-placement="right" title="Cuenta Verficada">
								@endif
								<h6 class="margin-arriba">{{$servicio->service}}</h6>
								<h6 class="margin-arriba"><i class="fas fa-dollar-sign"></i> {{$servicio->price}}</h6>
								<h6 class="margin-arriba"><i class="far fa-comments"></i> Descripcion de la Empresa</h6>
								<small class="text-justify">{{$servicio->description}}</small>			
								<form class="margin-arriba" method="post" action="{{url('/cliente/solicitud/'.$servicio->company_id)}}">
									{{csrf_field()}}
									<a class="btn btn-warning btn-sm pull-right link-1" href="{{url('/cliente/solicitud/'.$servicio->company_id.'/show')}}">Ver Empresa</a>
								</form>
							</div>
						</div>
					</div>
				@empty
					@include('includes.mensaje')
				@endforelse
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


									
