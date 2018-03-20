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
								<h3 class="d-inline">{{$empresa->usuario->name}}</h3>
								@if($empresa->usuario->validation)
									<img class="img-raised rounded-circle" style="height: 25px; width: 25px;" src="{{asset('imagenes/verificado.png')}}" data-toggle="tooltip" data-placement="right" title="Cuenta Verficada">
								@endif
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
									<a class="btn btn-warning btn-sm link-1 pull-right" href="{{url('/administrador/empresas/'.$empresa->usuario->id.'/edit')}}">Modificar Estado</a>
									@if($empresa->documento)
										<a class="btn btn-warning btn-sm link-1" href="{{url('/administrador/empresas/'.$empresa->usuario->id.'/verificar')}}">Validar Cuenta</a>
									@endif									
								</form>	
							@endif				
						</div>
					</div>
				</div>
			@empty
				@section('mensaje','Empresas')
				@include('includes.mensaje')	
			@endforelse
		</div>
		{{$empresas->links('vendor.pagination.bootstrap-4')}}
	</div>
</div>
@endsection