<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title') - LiveFútbol</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Iconos equipos -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Signika:wght@400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">	
	
	<!-- Styles -->
	<style>
		#header {
			background-color: #255e50; /* Verde */
			/*background-color: #0f2d37;*/ /* Azul */
			font-family: 'Signika', 'sans-serif';
		}
		#content {
			background-color: #a6b7bb; /* Verdes */
    		/*background-color: #eeeeee;*/ /* Azules */
			font-family: 'Roboto', 'sans-serif';
		}
		#footer {
			background-color: #255e50; /* Verde */
			/*background-color: #0f2d37;*/ /* Azul */
			font-family: 'Signika', 'sans-serif';
			color: white;
		}
	</style>
	@yield('css')

	<!-- Bootstrap Script -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	<!-- JQuery Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<div class="row m-0" id="header">
		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container-fluid nav-content">
				<a class="navbar-brand" style="color: white;" href="/">
					LIVEFÚTBOL
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="/livescore">Livescore</a>
						</li>
						@auth
						<li class="nav-item">
							<a class="nav-link" href="/favoritos">Favoritos</a>
						</li>
						@endauth
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Ligas
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="/liga/140">La Liga</a></li>
								<li><a class="dropdown-item" href="/liga/141">Segunda Division</a></li>
								<li><a class="dropdown-item" href="/liga/39">Premier League</a></li>
								<li><a class="dropdown-item" href="/liga/78">Bundesliga</a></li>
								<li><a class="dropdown-item" href="/liga/135">Serie A</a></li>
								<li><a class="dropdown-item" href="/liga/61">Ligue 1</a></li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Equipos
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="/equipo/529">FC Barcelona</a></li>
								<li><a class="dropdown-item" href="/equipo/9580">Burgos CF</a></li>
								<li><a class="dropdown-item" href="/equipo/50">Manchester City</a></li>
								<li><a class="dropdown-item" href="/equipo/533">Villareal CF</a></li>
								<li><a class="dropdown-item" href="/equipo/157">Bayern de Múnich</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
					<ul class="navbar-nav mb-2 mb-lg-0">
						@guest
						<li class="nav-item">
							<a class="nav-link" href="/register">Registrarse</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/login">Login</a>
						</li>
						@else
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								{{ Auth::user()->name }}
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="/user/profile">Perfil</a></li>
								<li>
									<a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
										Cerrar sesión
									</a>
								</li>
								<form method="POST" id="logout-form" action="{{ route('logout') }}">
									@csrf
								</form>
							</ul>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="row m-0" id="content">
		<main>
			<div class="main-content">
				@yield('content')
			</div>
		</main>
	</div>
	<div class="row m-0 p-3" id="footer">
		<footer>
			<div class="footer-content">
				<div class="row">
					<div class="col">
						Contacto: adri__16@hotmail.com
					</div>
					<div class="col text-end">
						2022 &#169
					</div>
				</div>
			</div>
		</footer>
	</div>
	@yield('js')
</body>

</html>
