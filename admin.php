<?php require_once __DIR__ . '/config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

		<!-- ================== MENU HEAD ================== -->
		<?php require_once("view/sections/admin/head.php"); ?>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	

	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- ================== MENU HAUT ================== -->
		<?php require_once("view/sections/admin/menuHaut.php"); ?>
		
		<!-- ================== MENU GAUCHE ================== -->
		<?php require_once("view/sections/admin/menuGauche.php"); ?>		
		
		<!-- ================== SECTION BASE CONTENT ================== -->
		<?php require_once("view/sections/admin/baseContent.php"); ?>	
		
		<!-- ================== SECTION CONFIG ================== -->
		<?php require_once("view/sections/admin/config.php"); ?>	
		
		<!-- ================== SECTION SCROLL TO TOP================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	
	<!-- ================== SECTION JS ================== -->
		<?php require_once("view/sections/admin/script.php"); ?>	

</body>
</html>