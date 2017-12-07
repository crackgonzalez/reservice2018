<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('titulo','Reservice')</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/estilo.css')}}"> 
	@yield('estilo-footer')
</head>
<body class="@yield('fondo','fondo-plomo')">
	<header>
		<nav class="navbar navbar-light bg-dark">
			<a class="navbar-brand" href="#">
				<img src="{{asset('imagenes/logo.png')}}" width="30" height="30" alt="Icono Reservice">
			</a>
		</nav>		
	</header>
	<div class="container-fluid">
		@yield('contenido')
		<div class="row">
		    <div class="col-12">
		        <footer id="myFooter">
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
		                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
		                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
		                            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
		                        </div>
		                        <button type="button" class="btn btn-default">Contactanos</button>
		                    </div>
		                </div>
		                <p class="text-center color-texto">santiago-chile</p>
		            </div>
		            <div class="footer-copyright">
		                <p>Reservice, Todos los derechos reservados &copy; 2017.</p>
		            </div>
		        </footer>
		    </div>
		</div>
	</div>	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
</body>
</html>

