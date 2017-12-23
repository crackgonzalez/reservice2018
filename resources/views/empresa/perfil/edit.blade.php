@extends('layouts.app')
@section('titulo','Modificar su Perfil de Empresa')
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
							<h4 class="card-title">Modificando el Perfil de {{$usuario->name}}</h4>
						</div>
						<div class="card-body">
							<form action="{{url('/empresa/perfil/'.$empresa->id.'/edit')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">person</i></span>
										<input type="text" class="form-control" name="name" placeholder="Nombre" value="{{old('name',$empresa->usuario->name)}}">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">email</i></span>
										<input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email',$empresa->usuario->email)}}">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">phone</i></span>
										<input type="text" class="form-control" name="phone" placeholder="Telefono" value="{{old('phone',$empresa->phone)}}">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">person_pin_circle</i></span>
										<input type="text" class="form-control" name="address" placeholder="Direccion" value="{{old('address',$empresa->address)}}">
									</div>
								</div>
								<div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">terrain</i></span>
                                        <select name="commune_id" class="form-control">
                                        	<option value="">Seleccione Comuna</option>
                                    		@foreach($comunas as $comuna)
                                            <option value="{{$comuna->id}}"
												@if($empresa->commune_id == $comuna->id)
													selected=""
												@endif
                                            	>{{$comuna->commune}}</option>
                                			@endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="material-icons">description</i></span>
										<textarea name="description" placeholder="Descripcion" class="form-control" cols="30" rows="4">{{old('description',$empresa->description)}}</textarea>
									</div>
								</div>
								<div class="form-group">
									<input type="file" class="form-control-file" name="image">
									@if($empresa->image)
									<small>Subir una nueva imagen solo si desea reemplazar la imagen anterior</small>
									@endif
								</div>
								<div class="form-group">
									<a href="{{url('/empresa/perfil')}}" class="btn btn-secondary btn-sm pull-right">Cancelar</a>
									<button type="submit" class="btn btn-warning btn-sm pull-right margin-derecho link-1">Actualizar</button>
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