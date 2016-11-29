<?php 
session_start(); 

if(!isset($_SESSION["adm_logado"]) or !$_SESSION["adm_logado"]){
	header("Location: admin_login.php");
	exit();
}

?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>BdFlix</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				<ul>
					<li><a href="admin_cadastros.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a href="admin_gera_relatorio.php"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
					<li><a href="admin_gera_faturas.php">Faturas</a></li>
					<li><a href="admin_logout.php" > Sair.</a></li>
				</ul>
			</div>
		<div class="main"> 
		<div class="header">
			
		</div>
		
		

	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
