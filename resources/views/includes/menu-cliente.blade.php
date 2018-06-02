<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
		<a class="{{ request()->is('cliente/perfil') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/perfil')}}">Perfil</a>
		<a class="{{ request()->is('cliente/buscar') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/buscar')}}">Buscar un Servicio</a>
		<a class="{{ request()->is('cliente/solicitud') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/solicitud')}}">Solicitudes</a>
		<a class="{{ request()->is('cliente/presupuesto') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/presupuesto')}}">Presupuestos</a>
		<a class="{{ request()->is('cliente/reserva') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/reserva')}}">Reservas</a>
		<a class="{{ request()->is('cliente/calificar') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/cliente/calificar')}}">Calificaciones</a>
	</div>
</div>
