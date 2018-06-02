<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
		<a class="{{ request()->is('administrador/categorias') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/categorias')}}">Categorias</a>
		<a class="{{ request()->is('administrador/servicios') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/servicios')}}">Servicios</a>
		<a class="{{ request()->is('administrador/regiones') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/regiones')}}">Regiones</a>
		<a class="{{ request()->is('administrador/comunas') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/comunas')}}">Comunas</a>
		<a class="{{ request()->is('administrador/empresas') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/empresas')}}">Empresas</a>
		<a class="{{ request()->is('administrador/resumen') ? 'nav-item nav-link nav-pills-estilo activo' : 'nav-item nav-link nav-pills-estilo' }}" href="{{url('/administrador/resumen')}}">Resumen</a>
	</div>
</div>


