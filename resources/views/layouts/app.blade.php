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
		nav, footer {
			font-family: 'Roboto', 'Signika', sans-serif;
		}
		.container {
			font-family: 'Signika', 'Roboto', sans-serif;
		}
	</style>
	@yield('css')

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
				<li class="nav-item">
						<a class="nav-link" href="/register">Registrarse</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/login">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		@yield('content')
	</div>
	<footer>

	</footer>
	@yield('js')
</body>

</html>
