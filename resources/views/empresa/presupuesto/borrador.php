<div class="col-12 col-sm-3 col-md-3">
	<div class="card margin-arriba margin-abajo card-raised">
		@if($presupuesto->image == null)
			<img class="card-img-top" style="height:180px" src="{{$presupuesto->servicio->url}}">
		@else
			<img class="card-img-top" style="height:180px" src="{{$presupuesto->url}}">	
		@endif
		<div class="card-body">
			<img class="img-raised rounded-circle img-thumbnail" style="height: 60px; width: 60px; margin-top: -150px; margin-right: 10px;" src="{{$presupuesto->cliente->url}}">
			<h5><i class="far fa-user"></i> {{$presupuesto->cliente->usuario->name}}</h5>
			<h5><i class="fas fa-suitcase"></i> {{$presupuesto->servicio->service}}</h5>
			<h6><i class="far fa-calendar-alt"></i> {{$presupuesto->date}}</h6>
			<h6><i class="fas fa-map-marker-alt"></i> {{$presupuesto->comuna->commune}}</h6>
			@if(!$presupuesto->cliente->address == null)
				<h6><i class="fab fa-slack-hash"></i> {{$presupuesto->cliente->address}}</h6>
			@else
				<h6><i class="fab fa-slack-hash"></i> Sin Direccion</h6>
			@endif
			<h6><i class="far fa-comments"></i> {{$presupuesto->description}}</h6>
			
		</div>
	</div>								
</div>


@foreach($presupuesto->respuestas as $respuesta)
						@if($respuesta->company_id == Auth::user()->empresa->id)
							<h1>{{$respuesta->id}}</h1>
						@endif
					@endforeach