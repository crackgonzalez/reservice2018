@extends('layouts.app')
@section('titulo','Perfil de la Empresa')
@section('usuario','Empresa')
@section('barra-navegacion')
	@include('includes.menu-empresa')
@endsection
@section('perfil-fondo','profile-page')
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
			<div class="card margin-arriba margin-abajo card-raised">
				@foreach($empresas as $empresa)
				@if($empresa->user_id == Auth::user()->id)
					<div class="wrapper">
						<div class="header header-filter" style="background-image:url('../imagenes/ciudad.jpg'); border-radius: 4px 4px 0px 0px;">
							<div class="container">
                				<div class="row">
                					<div class="col-12 col-sm-2 col-md-3"></div>
									<div class="col-12 col-sm-8 col-md-6 text-center">
										<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$empresa->url}}" style="background: #fff; margin-top: 15px;" alt="">
										@if($empresa->usuario->validation)
											<img class="img-raised rounded-circle" style="height: 45px; width: 45px; margin-left: -55px; margin-bottom: -130px;" src="{{asset('imagenes/verificado.png')}}" data-toggle="tooltip" data-placement="right" title="Cuenta Verficada">
										@endif
										<h2 class="link-1">{{$empresa->usuario->name}}</h2>
										@if($notas>0)
										<h5 class="link-1">Calificacion {{round($notas,1)}} <i class="far fa-star"></i></h5>
										@endif
										@empty($empresa->description)
											<small class="link-1 text-justify"><i class="fas fa-align-left"></i> Ingrese una descripcion para su empresa</small>
										@endempty
										@isset($empresa->description)
											<small class="link-1 text-justify"><i class="fas fa-align-left"></i> {{$empresa->description}}</small>
										@endisset
										<h6 class="link-1 margin-arriba"><i class="fas fa-envelope"></i> {{$empresa->usuario->email}}</h6>										
										@empty($empresa->phone)
											<h6 class="link-1"><i class="fas fa-phone"></i> Ingrese un numero telefonico</h6>
										@endempty
										@isset($empresa->phone)
											<h6 class="link-1"><i class="fas fa-phone"></i> {{$empresa->phone}}</h6>
										@endisset
										@empty($empresa->address)
											<h6 class="link-1"><i class="fab fa-slack-hash"></i> Ingrese una direccion</h6>
										@endempty
										@isset($empresa->address)
											<h6 class="link-1"><i class="fab fa-slack-hash"></i> {{$empresa->address}}</h6>
										@endisset
										@empty($empresa->comuna->commune)
											<h6 class="link-1"><i class="fas fa-map-marker-alt"></i> Ingrese una comuna</h6>
										@endempty
										@isset($empresa->comuna->commune)
											<h6 class="link-1"><i class="fas fa-map-marker-alt"></i> {{$empresa->comuna->commune}}</h6>
										@endisset
										<form method="post" action="{{url('/empresa/perfil/'.$empresa->id)}}">
											{{csrf_field()}}
											<a class="btn btn-warning btn-sm link-1" href="{{url('/empresa/perfil/'.$empresa->id.'/edit')}}">Administrar Perfil</a>
											@if(!$empresa->usuario->validation)
												<a class="btn btn-warning btn-sm link-1 margin-izquierdo" href="{{url('/empresa/validar/create')}}">Validar Cuenta</a>			
											@endif
										</form>											
									</div>										
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 text-center">			
								<h4>Creditos Disponibles <span class="badge badge-secondary">{{$empresa->credit}}</span></h4>
								<a class="btn btn-sm btn-warning link-1" href="{{url('/empresa/creditos/create')}}">Comprar Creditos</a>
							</div>
						</div>				
						<div class="row">
							<div class="col-12 col-sm-1 col-md-1"></div>
							<div class="col-12 col-sm-10 col-md-10">
								<div class="profile-tabs">
									<div class="nav-align-center">
										<ul class="nav nav-pills" role="tablist">
											<li class="nav-pills-estilo active">
												<a href="#mapa" role="tab" data-toggle="tab">
													<i class="material-icons">pin_drop</i>Mapa
												</a>													
											</li>
											<li class="nav-pills-estilo">
												<a href="#servicios" role="tab" data-toggle="tab">
													<i class="material-icons">work</i>Servicios
												</a>
											</li>
											<li class="nav-pills-estilo">
												<a href="#comunas" role="tab" data-toggle="tab">
													<i class="material-icons">my_location</i>Comunas
												</a>
											</li>
											<li class="nav-pills-estilo">
												<a href="#galeria" role="tab" data-toggle="tab">
													<i class="material-icons">add_a_photo</i>Galeria
												</a>
											</li>										
										</ul>
										<div class="tab-content">
											<div class="tab-pane text-center active" id="mapa">
				                            	<div class="row">
				                            		@isset($empresa->comuna->commune)
	    												<input id="address" type="hidden" value="{{$empresa->address}},{{$empresa->comuna->commune}}">
	    												<div id="map" class="mapa margin-arriba"></div>
				                            		@endisset                  	
				                            	</div>
				                        	</div>
				                        	<div class="tab-pane text-center" id="servicios">
				                        		<form method="post" action="{{url('/empresa/perfil')}}">
				                        			<a class="btn btn-warning btn-sm link-1 margin-arriba" href="{{url('/empresa/perfil/createService')}}">Agregar un Servicio</a>
				                        		</form>
												<div class="row">										
													@foreach($empresa->servicios as $servicios)
													<div class="col-12 col-sm-4 col-md-3">
														<div class="text-center separacion-fotos">
															<img src="{{$servicios->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
															<h5>{{$servicios->service}}</h5>
															<h6>{{$servicios->categoria->category}}</h6>
															<h6><i class="fas fa-dollar-sign"></i> {{$servicios->pivot->price}}</h6>
															<img src="{{$servicios->categoria->url}}" class="img-raised rounded-circle tamaño-imagen-pequeño margin-arriba margin-abajo">

															<form method="post" action="{{url('/empresa/perfil/'.$servicios->id)}}" style="margin-top: -25px;">
																{{csrf_field()}}
																{{method_field('DELETE')}}
																<input name="company" class="form-control" type="hidden" value="{{Auth::user()->empresa->id}}">
																<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar el Servicio"><i class="material-icons eliminar">delete</i></i></button>
															</form>
														</div>
													</div>
													@endforeach	
											</div>
				                        </div>
				                        <div class="tab-pane text-center" id="comunas">
				                        	<form method="post" action="{{url('/empresa/perfil')}}">
				                        		<a class="btn btn-warning btn-sm link-1 margin-arriba" href="{{url('/empresa/perfil/createCommune')}}">Agregar una Comuna</a>
				                        	</form>
											<div class="row">										
												@foreach($empresa->comunas as $comunas)
												<div class="col-12 col-sm-4 col-md-3">
													<div class="text-center separacion-fotos">
														<img src="{{$comunas->url}}" class="img-raised rounded-circle tamaño-imagen-normal margin-arriba margin-abajo img-thumbnail">
														<h5>{{$comunas->commune}}</h5>
														<h6>{{$comunas->region->region}}</h6>
														
														<img src="{{$comunas->region->url}}" class="img-raised rounded-circle tamaño-imagen-pequeño margin-arriba margin-abajo">
														<form method="post" action="{{url('/empresa/perfil/'.$comunas->id.'/'.$comunas->commune)}}" style="margin-top: -25px;">
															{{csrf_field()}}
															{{method_field('DELETE')}}
															<input name="company" class="form-control" type="hidden" value="{{Auth::user()->empresa->id}}">
															<button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar la Comuna"><i class="material-icons eliminar">delete</i></i></button>
														</form>
													</div>
												</div>
												@endforeach	
											</div>
				                        </div>
				                        <div class="tab-pane text-center" id="galeria">
											<form method="post" action="{{url('/empresa/perfil')}}">
				                        		<a class="btn btn-warning btn-sm link-1 margin-arriba" href="{{url('/empresa/perfil/createGalery')}}">Agregar una Foto</a>
				                        	</form>
											<div class="row">
												@foreach($empresa->fotos as $fotos)
												<div class="col-12 col-sm-4 col-md-4">
													<div class="text-center ">
														<img src="{{$fotos->url}}" class="tamaño-imagen-grande margin-arriba margin-abajo img-raised img-thumbnail">
														<form method="post" action="{{url('/empresa/perfil/'.$fotos->id.'/'.$fotos->image.'/'.$fotos->company_id)}}" style="margin-top: -25px;">
															{{csrf_field()}}
															{{method_field('DELETE')}}
															<button style="margin-top: 30px;" type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar Imagen"><i class="material-icons eliminar">delete</i></i></button>
														</form>
													</div>
												</div>
												@endforeach	
											</div>
				                        </div>				                        					
				                    </div>
								</div>
							</div>				
						</div>
				@endif
				@endforeach	
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
        	zoom: 15,
        	center: {lat: -33.4378394, lng: -70.6526683}
        });
        var geocoder = new google.maps.Geocoder();
        geocodeAddress(geocoder, map);
    }

    function geocodeAddress(geocoder, resultsMap) {
    	var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
        	if (status === 'OK') {
        		resultsMap.setCenter(results[0].geometry.location);
        		var marker = new google.maps.Marker({
        			map: resultsMap,
        			position: results[0].geometry.location
        		});
        	}else {
        		alert('Geocode was not successful for the following reason: ' + status);
        	}
        });
    }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmodiJXhAJMxo-fS9PMpxiNd2JvaDt7Fs&callback=initMap">
    </script>
@endsection

