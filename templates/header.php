<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CRUD-Login & Registration</title>
	
	<!-- bootstrap css -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- sweet alert css -->
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">

</head>
<body>

	<div class="container-fluid">
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<!-- Brand -->
			<a class="navbar-brand" href="index.php">CRUD Bank</a>

			<!-- Toggler/collapsibe Button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Navbar links -->
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ml-auto mr-3">
					<?php
					if (isset($_SESSION['userAuth'])) { ?>
						<li class="nav-item p-1">
							<a class="nav-link btn btn-outline-success btn-sm" href="index.php">Home</a>
						</li>
						<li class="nav-item p-1">
							<a class="nav-link btn btn-outline-success btn-sm" href="profile.php">Profile</a>
						</li>
						<li class="nav-item p-1">
							<a id="logout" class="nav-link btn btn-outline-success btn-sm" href="logout.php">Logout</a>
						</li>
					<?php } else { ?>
						<li class="nav-item p-1">
							<a class="nav-link btn btn-outline-success btn-sm" href="login.php">Login</a>
						</li>
						<li class="nav-item p-1">
							<a class="nav-link btn btn-outline-success btn-sm" href="register.php">Register</a>
						</li>
				<?php } ?>
				</ul>
			</div>
		</nav>
		
		<main class="p-5 text-info border border-info" style="min-height: 80vh;">