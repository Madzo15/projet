<?php require_once __DIR__ . '/config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>SenLogis | Connexion</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="public/templates/TemplateAdmin//assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(public/templates/TemplateAdmin//assets/img/login-bg/login-bg-11.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>SenLogis</b></h4>
					<p>
						Bienvenue sur notre page de connexion.
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin login-header -->
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> <b>Connectez</b> vous
						<small></small>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- end login-header -->
				<!-- begin login-content -->
				<div class="login-content">
					<div id="messageDiv"></div>
					<form id="loginForm" class="margin-bottom-0">
						<div class="form-group m-b-15">
							<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Adresse Email" required />
						</div>
						<div class="form-group m-b-15">
							<input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de Passe" required />
						</div>
						<div class="checkbox checkbox-css m-b-30">
							<input type="checkbox" id="remember_me_checkbox" value="" />
							<label for="remember_me_checkbox">
							Se souvenir de moi
							</label>
						</div>
						<div class="login-buttons">
							<button type="submit" class="btn btn-success btn-block btn-lg">Se connecter</button>
						</div>
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							Vous n'êtes pas encore membre ? Cliquez  <a href="register.php">ici</a> pour vous inscrire.
						</div>
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; SenLogis All Right Reserved 2026
						</p>
					</form>
				</div>
				<!-- end login-content -->
			</div>
			<!-- end right-container -->
		</div>
		<!-- end login -->
	
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/templates/TemplateAdmin//assets/js/app.min.js"></script>
	<script src="public/templates/TemplateAdmin//assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		document.getElementById('loginForm').addEventListener('submit', function(e) {
			e.preventDefault();

			const formData = new FormData(this);
			const messageDiv = document.getElementById('messageDiv');

			fetch('auth/login-process.php', {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
					setTimeout(function() {
						window.location.href = data.redirect;
					}, 1500);
				} else {
					messageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
				}
			})
			.catch(error => {
				console.error('Error:', error);
				messageDiv.innerHTML = '<div class="alert alert-danger">Une erreur est survenue</div>';
			});
		});
	</script>
</body>
</html>