@extends('layouts.app')
@section('titulo','Reservice')
@section('estilo-footer')
    <link rel="stylesheet" href="{{asset('css/footer-with-button-logo-white.css')}}">
@endsection
@section('contenido')
    <div class="row">
		<div class="col-12 col-sm-12 col-md-12">
    		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-right: -15px; margin-left: -15px;">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="{{asset('imagenes/abogado.png')}}" alt="First slide" width="100%">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres abogado?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/mecanico.png')}}" alt="Second slide" width="100%">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Eres mecanico y tienes un taller?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{{asset('imagenes/constructor.png')}}" alt="Third slide" width="100%">
						<div class="carousel-caption d-none d-md-block">
          					<h3>¿Tienes una microempresa dedicada a la construccion?</h3>
          					<p>Crea una cuenta y publica tus servicios en Reservice</p>
          				</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>    		
    </div>
    <div class="row">
    	<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-3 col-md-3">
						</div>
						<div class="col-12 col-sm-8 col-md-8">
							<form class="form-inline" action="" method="get" enctype="multipart/form-data">
								{{csrf_field()}}						
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon mb-3 mr-sm-0 mb-sm-0"><i class="material-icons">work</i></span>
										<select name="category_id" class="form-control mb-3 mr-sm-3 mb-sm-0" id="category_id">
											<option value="0">Seleccione la Categoria</option>
											@foreach($categorias as $categoria)
											<option value="{{old('category_id',$categoria->id)}}">{{$categoria->category}}</option>
											@endforeach
										</select>
									</div>
		                    	</div>	                    
		                    	<div class="form-group">
									<div class="input-group">
	                                	<span class="input-group-addon mb-3 mr-sm-0 mb-sm-0""><i class="material-icons">content_paste</i></span>
	                                	<select name="service_id" class="form-control mb-3 mr-sm-3 mb-sm-0" id="service_id">
	                                		<option value="0">Seleccione un Servicio</option>
	                               		</select>
	                           		</div>
	                       		</div>
	                       		<div class="form-group">
									<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho margin-izquierdo link-1 ">Buscar</button>
	                        		<button type="submit" class="btn btn-secondary btn-sm pull-right margin-izquierdo">Limpiar</button>	
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				@foreach($servicios as $servicio)
					@foreach($servicio->empresas as $empresas)
						@if($empresas->usuario->state)
						<div class="col-12 col-sm-3 col-md-3">
							<div class="card margin-arriba margin-abajo card-raised">
								<img class="card-img-top" style="height:210px" src="{{$servicio->url}}">			
								<div class="card-body">							
									<h5>{{$servicio->service}}</h5>
									<img class="img-raised rounded-circle" style="height: 35px; width: 35px;" src="{{$empresas->url}}">
									<h6 class="d-inline">{{$empresas->usuario->name}}</h6>
									<br><br>
									<small class="text-justify">{{$empresas->description}}</small>
									<br><br>	
									<a class="btn btn-warning btn-sm pull-right link-1" href="{{ route('register') }}">Registrarse</a>
									<a class="btn btn-warning btn-sm pull-right link-1 margin-derecho" href="{{ route('login') }}">Iniciar Sesion</a>
								</div>
							</div>
						</div>
						@endif					
					@endforeach
				@endforeach				
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
