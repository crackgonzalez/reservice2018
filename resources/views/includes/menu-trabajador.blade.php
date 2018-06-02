<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
		<a class="{{ request()->is('trabajador/perfil') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/trabajador/perfil')}}">Perfil</a>
		<a class="{{ request()->is('trabajador/reserva') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/trabajador/reserva')}}">Trabajos Asignados</a>
		<a class="{{ request()->is('trabajador/calificar') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/trabajador/calificar')}}">Calificaciones</a>
		<a class="{{ request()->is('trabajador/mapa') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/trabajador/mapa')}}">Ruta</a>
	</div>
</div>