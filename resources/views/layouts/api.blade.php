<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title') - App Name</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Signika&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Signika&display=swap" rel="stylesheet">

	<!-- Styles -->
	<style>
		body {
			/*background-color: #010a0f;*/
			height: 100%;
		}
		nav, footer {
			margin: 15px 0;
			background-color: #001E28;
			font-family: 'Roboto', 'Signika', sans-serif;
		}
		main {
			height: 75vh;
			/*background-color: #001E28;*/
			font-family: 'Signika', 'Roboto', sans-serif;
		}
	</style>
	@yield('css')

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="container">
	<div class="row">
		<nav class="navbar navbar-expand-lg navbar-dark rounded">
			<div class="container-fluid">
				<a class="navbar-brand" href="/">App Name</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
						<li class="nav-item">
							<a class="nav-link" href="/pruebas">Pruebas</a>
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
	<div class="row">
		<main class="rounded">
			@yield('content')
		</main>
	</div>
	<div class="row">
		<footer class="rounded">

		</footer>
	</div>
	@yield('js')
</body>

</html>