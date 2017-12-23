@extends('layouts.app')
@section('titulo','Perfil de la Empresa')
@section('usuario','Empresa')
@section('barra-navegacion')
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link active" href="{{url('/empresa/perfil')}}">Perfil <span class="sr-only">(current)</span></a>
		</div>
	</div>
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
							<div class="header header-filter" style="background-image:url('../imagenes/ciudad.jpg');">
								<div class="container">
                					<div class="row">
                						<div class="col-12 col-sm-2 col-md-3">
                						</div>
										<div class="col-12 col-sm-8 col-md-6 text-center">
											<img class="img-raised rounded-circle tamaño-imagen-normal img-thumbnail" src="{{$empresa->url}}" style="background: #fff; margin-top: 15px;" alt="">
											<h2 class="link-1">{{$empresa->usuario->name}}</h2>	
											<small class="link-1 text-justify">{{$empresa->description}}</small>
											<h6 class="link-1 margin-arriba">{{$empresa->usuario->email}}</h6>
											<h6 class="link-1">{{$empresa->phone}}</h6>
											<h6 class="link-1">{{$empresa->address}}</h6>
											@empty($empresa->comuna->commune)
											<h6 class="link-1">Ingrese una comuna</h6>
											@endempty
											@isset($empresa->comuna->commune)
											<h6 class="link-1">{{$empresa->comuna->commune}}</h6>
											@endisset
											<form method="post" action="{{url('/empresa/perfil/'.$empresa->id)}}">
												<a class="btn btn-warning btn-sm link-1" href="{{url('/empresa/perfil/'.$empresa->id.'/edit')}}">Administrar Perfil</a>
											</form>											
										</div>										
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">				
						</div>
					@endif
				@endforeach	
			</div>
		</div>
	</div>
@endsection




<!-- <div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="profile-tabs">
			                    <div class="nav-align-center">
									<ul class="nav nav-pills" role="tablist">
										<li class="active">
											<a href="#studio" role="tab" data-toggle="tab">
												<i class="material-icons">camera</i>
												Studio
											</a>
										</li>
										<li>
				                            <a href="#work" role="tab" data-toggle="tab">
												<i class="material-icons">palette</i>
												Work
				                            </a>
				                        </li>
				                        <li>
				                            <a href="#shows" role="tab" data-toggle="tab">
												<i class="material-icons">favorite</i>
				                                Favorite
				                            </a>
				                        </li>
				                    </ul>

				                    <div class="tab-content gallery">
										<div class="tab-pane active" id="studio">
				                            <div class="row">
												<div class="col-md-6">
													<img src="../assets/img/examples/chris1.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris0.jpg" class="img-rounded" />
												</div>
												<div class="col-md-6">
													<img src="../assets/img/examples/chris3.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
												</div>
				                            </div>
				                        </div>
				                        <div class="tab-pane text-center" id="work">
											<div class="row">
												<div class="col-md-6">
													<img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
												</div>
												<div class="col-md-6">
													<img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris8.jpg" class="img-rounded" />
												</div>
											</div>
				                        </div>
										<div class="tab-pane text-center" id="shows">
											<div class="row">
												<div class="col-md-6">
													<img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
												</div>
												<div class="col-md-6">
													<img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
													<img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
												</div>
											</div>
				                        </div>

				                    </div>
								</div>
							</div>
						
						</div>
	                </div> -->


