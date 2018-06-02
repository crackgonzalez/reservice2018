<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
		<a class="{{ request()->is('empresa/perfil') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/perfil')}}">Perfil</a>
		<a class="{{ request()->is('empresa/trabajador') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/trabajador')}}">Trabajadores</a>
		<a class="{{ request()->is('empresa/solicitud') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/solicitud')}}">Solicitudes</a>
		<a class="{{ request()->is('empresa/presupuesto') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/presupuesto')}}">Presupuestos</a>
		<a class="{{ request()->is('empresa/reserva') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/reserva')}}">Reservas</a>
		<a class="{{ request()->is('empresa/asignar') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/asignar')}}">Asignar Trabajador</a>
		<a class="{{ request()->is('empresa/resumen-reserva') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/resumen-reserva')}}">Info Reservas</a>
		<a class="{{ request()->is('empresa/resumen-trabajador') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/resumen-trabajador')}}">Info Trabajadores</a>
		<a class="{{ request()->is('empresa/resumen-calificacion') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/empresa/resumen-calificacion')}}">Info Calificacion</a>
	</div>
</div>