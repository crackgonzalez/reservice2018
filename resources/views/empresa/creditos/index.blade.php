@extends('layouts.app')
@section('titulo','Seleccionar Creditos')
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
	<div class="col-12 col-sm-3 col-md-3"></div>
	<div class="col-12 col-sm-6 col-md-6">
		<div class="card margin-arriba margin-abajo card-raised">						
			<div class="card-header text-center">
				<h4 class="card-title">Seleccionar plan de creditos</h4>
			</div>
			<div class="card-body">
				<form action="{{url('empresa/creditos/webpay')}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-mouse-pointer"></i></span>
							<select name="price" class="form-control">
								<option value=null>Seleccione un Plan</option>
								@foreach($planes as $plan)
								<option value="{{$plan->price}}">{{$plan->description}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<button class="btn btn-sm btn-warning link-1 pull-right" type="submit">Aceptar</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-3 col-md-3"></div>
</div>
<div class="row">
	@foreach($planes as $plan)
	<div class="col-12 col-sm-3 col-md-3">		
		<div class="card {{$plan->style}} text-white margin-arriba">
			<div class="card-header">{{$plan->description}}</div>
			<div class="card-body">				
				<h5 class="card-title">Comprar {{$plan->credit}} creditos</h5>
				<p class="card-text">Adquiera {{$plan->credit}} creditos por un precio de ${{$plan->price}} pesos</p>
			</div>
		</div>
	</div>
	@endforeach		
</div>
@endsection