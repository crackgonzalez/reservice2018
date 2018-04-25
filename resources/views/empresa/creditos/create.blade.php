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
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<img class="pull-left" src="{{asset('imagenes/logo.png')}}" width="16%">
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<img class="pull-right" src="{{asset('imagenes/webpay.png')}}" width="40%">
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{url('empresa/creditos/webpay')}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}										
					<div class="card text-center">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs">
								<li class="nav-item">
									<a class="nav-link active" href="#">Tarjeta de Debito / Red Compra</a>
								</li>
							</ul>
						</div>
						<div class="card-body">								
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-mouse-pointer"></i></span>
									<select id="plans" class="form-control" onchange="cambiar(this.value)">
										<option value="0">Seleccione un Plan</option>
										@foreach($planes as $plan)
										<option value="{{$plan->price}}">{{$plan->description}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-building"></i></span>
									<input class="form-control" value="Comercio : Reservice" disabled>
								</div>
							</div>							
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-university"></i></span>
									<select id="plans" class="form-control">
										<option value="1">Banco Estado</option>
										<option value="2">Banco Santander</option>
										<option value="3">Banco Bci</option>
										<option value="4">Banco Scotiabank</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-credit-card"></i></span>
									<input class="form-control" placeholder="Numero de Trajeta">
								</div>
							</div>
							<div class="form-group">
								<h6 id="total">Total a pagar $ 0 pesos</h6>
							</div>
						</div>						
					</div>
					<a class="btn btn-sm btn-warning link-1 pull-left margin-arriba" href="/empresa/perfil">Anular</a>
					<button class="btn btn-sm btn-warning link-1 pull-right margin-arriba" type="submit">Pagar</button>
				</form>				
			</div>
			<img class="pull-right margin-arriba" src="{{asset('imagenes/redcompra.png')}}" width="40%">
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
@section('scripts')
<script>
	function cambiar(val) {
    	document.getElementById("total").innerHTML = "Total a pagar $ " + val + " pesos";
	}
</script>
@ensection