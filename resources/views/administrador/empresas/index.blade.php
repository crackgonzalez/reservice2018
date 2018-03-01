@extends('layouts.app')
@section('titulo','Mantenedor de Empresas')
@section('usuario','Administrador')
@section('barra-navegacion')
	@include('includes.menu-admin')
@endsection
@section('estilo-footer')
	<link rel="stylesheet" href="{{asset('css/footer-with-button-logo-black.css')}}">
@endsection
@section('contenido')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<div class="row">
			@forelse($empresas as $empresa)
				<div class="col-12 col-sm-3 col-md-3">
					<div class="card margin-arriba margin-abajo card-raised">
						<img class="card-img-top" style="height:210px" src="{{$empresa->url}}">	
						<div class="card-body">
							@if($empresa->usuario->account_id === 3)
							<h2>{{$empresa->usuario->name}}</h2>
							@if($empresa->usuario->state === 1)
							<h5>Cuenta Activa</h5>
							<h6>Cuenta Creada el {{date('d-m-Y',strtotime($empresa->usuario->created_at))}}</h6>
							@else
							<h5>Cuenta Desactivada</h5>
							<h6>Cuenta Creada el {{date('d-m-Y',strtotime($empresa->usuario->created_at))}}</h6>	
							@endif
							<br>
							<form action="{{url('/administrador/empresas/'.$empresa->usuario->id)}}" method="post">
								{{csrf_field()}}
								<a class="tn btn-warning btn-sm link-1 pull-right" style="text-decoration:none;"  href="{{url('/administrador/empresas/'.$empresa->usuario->id.'/edit')}}">Modificar Cuenta</a>
							</form>	
							@endif				
						</div>
					</div>
				</div>
			@empty
			<div class="col-12 col-sm-12 col-md-12">
				<div class="card margin-arriba margin-abajo card-raised">
					<!-- Solucion Basica para cuando no se encuentren datos -->
					<h3 class="text-center">No hay empresas registradas en la pagina</h3>
				</div>
			</div>
			@endforelse
		</div>
		{{$empresas->links('vendor.pagination.bootstrap-4')}}
	</div>
</div>
@endsection