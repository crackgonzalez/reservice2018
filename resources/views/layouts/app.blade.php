<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('titulo','Reservice')</title>
	<link rel="icon" type="image/png" href="{{asset('imagenes/logo.png')}}">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/estilo.css')}}"> 
	@yield('estilo-footer')
</head>
<body class="@yield('perfil-fondo')">
	<header>
		<nav class="navbar navbar-light bg-dark">
			<a class="navbar-brand" href="#">
				<img src="{{asset('imagenes/logo.png')}}" width="30" height="30" alt="Icono Reservice">
				<h6 class="d-inline link-1">Reservice</h6>
			</a>
			<div class="pull-right">
		        @if (Auth::check())
		    	<div class="btn-group">
					<button type="button" class="btn btn-warning btn-sm link-1">{{ Auth::user()->name }}</button>
					<button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-toggle-split link-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
		            <div class="dropdown-menu dropdown-menu-right">
		            	<a class="dropdown-item btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion
		            	</a>
		            	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		            		{{ csrf_field() }}
		            	</form>
		            </div>
		        </div>
		        @else
		        	<a class="btn btn-warning btn-sm link-1" href="{{ route('login') }}">Iniciar Sesion</a>
                    <a class="btn btn-warning btn-sm link-1" href="{{ route('register') }}">Registrarse</a>
		    	@endif
			</div>			
		</nav>
		@if (Auth::check())
			<nav class="navbar navbar-expand-md navbar-light bg-light sombra-navbar">
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand" href="#">@yield('usuario')</a>
				@yield('barra-navegacion')
			</nav>		
		@endif
	</header>
	<div class="container-fluid @yield('fondo','fondo-plomo')">
		@yield('contenido')
		<div class="row">
		    <div class="col-12">
		        <footer id="myFooter" class="margin-arriba">
		            <div class="container">
		                <div class="row">
		                    <div class="col-12 col-sm-3">
		                    </div>
		                    <div class="col-sm-2">
		                        <h5>Comenzemos</h5>
		                        <ul>
		                            <li><a href="#">Inicio</a></li>
		                            <li><a href="#">Iniciar Sesion</a></li>
		                            <li><a href="#">Descargas</a></li>
		                        </ul>
		                    </div>
		                    <div class="col-12 col-sm-2">
		                        <h5>Conocenos</h5>
		                        <ul>
		                            <li><a href="#">Informacion</a></li>
		                            <li><a href="#">Contactanos</a></li>
		                            <li><a href="#">Revisiones</a></li>
		                        </ul>
		                    </div>
		                    <div class="col-12 col-sm-2">
		                        <h5>Soporte</h5>
		                        <ul>
		                            <li><a href="#">FAQ</a></li>
		                            <li><a href="#">Escritorio de ayuda</a></li>
		                            <li><a href="#">Foros</a></li>
		                        </ul>
		                    </div>
		                    <div class="col-12 col-sm-3">
		                        <div class="social-networks">
		                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
		                            <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
		                            <a href="#" class="google"><i class="fab fa-google-plus-g"></i></a>
		                        </div>
		                        <button type="button" class="btn btn-default">Contactanos</button>
		                    </div>
		                </div>
		                <p class="text-center color-texto">Santiago-Chile</p>
		            </div>
		            <div class="footer-copyright">
		                <p>Reservice, Todos los derechos reservados &copy; 2018.</p>
		            </div>
		        </footer>
		    </div>
		</div>
	</div>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	@include('sweet::alert')
	<script>$('[data-toggle="tooltip"]').tooltip();</script>
	<script type="text/javascript" src="{{asset('js/jquery.rut.js')}}"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b0cab7a33fcfa5d"></script>
	@yield('scripts')
</body>
</html>


