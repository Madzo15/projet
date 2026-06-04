<?php require_once __DIR__ . '/config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>SenLogis | Page d'inscription</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="public/templates/TemplateAdmin/assets/css/default/app.min.css" rel="stylesheet" />
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
		<!-- begin register -->
		<div class="register register-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(public/templates/TemplateAdmin/assets/img/login-bg/login-bg-15.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>SenLogis</b></h4>
					<p>
						Bienvenue sur la page d'inscription.
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin register-header -->
				<h1 class="register-header">
					Inscrivez-vous
					<small></small>
				</h1>
				<!-- end register-header -->
				<!-- begin register-content -->
				<div class="register-content">
					<div id="messageDiv"></div>
					<form id="registerForm" class="margin-bottom-0">
						<label class="control-label">Nom <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" id="firstname" name="firstname" class="form-control" placeholder="Prénom(s)" required />
							</div>
							<div class="col-md-6 m-b-15">
								<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Nom" required />
							</div>
						</div>
						<label class="control-label">Email <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="email" id="email" name="email" class="form-control" placeholder="Adresse Email" required />
							</div>
						</div>
						<label class="control-label">Confirmez votre email <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="email" id="email_confirm" name="email_confirm" class="form-control" placeholder="Confirmez votre email" required />
							</div>
						</div>					<label class="control-label">Téléphone <span class="text-danger">*</span></label>
					<div class="row m-b-15">
						<div class="col-md-12">
							<input type="tel" id="phone" name="phone" class="form-control" placeholder="Téléphone (ex: +221771234567)" required />
						</div>
					</div>						<label class="control-label">Mot de passe <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe (min 6 caractères)" required />
							</div>
						</div>
						<div class="register-buttons">
							<button type="submit" class="btn btn-primary btn-block btn-lg">S'inscrire</button>
						</div>
						<div class="m-t-30 m-b-30 p-b-30">
							Vous êtes déjà inscris ? Cliquez <a href="login.php">ici</a> pour vous connecter.
						</div>
						<hr />
						<p class="text-center mb-0">
							&copy; SenLogis All Right Reserved 2026
						</p>
					</form>
				</div>
				<!-- end register-content -->
			</div>
			<!-- end right-content -->
		</div>
		<!-- end register -->
	
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/templates/TemplateAdmin/assets/js/app.min.js"></script>
	<script src="public/templates/TemplateAdmin/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		document.getElementById('registerForm').addEventListener('submit', function(e) {
			e.preventDefault();

			const formData = new FormData(this);
			const messageDiv = document.getElementById('messageDiv');

			fetch('auth/register-process.php', {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
					setTimeout(function() {
						window.location.href = 'login.php';
					}, 2000);
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