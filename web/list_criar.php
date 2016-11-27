<?php
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_filme.php";
include "classes/class_midia.php";
include "classes/class_pc_midiafilme.php";
include "classes/class_movieList.php";

session_start(); 

if(!isset($_SESSION["perf_logado"]) or !$_SESSION["perf_logado"]){
	header("Location: index.php");
	exit();
}


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$perfId = $perfil->getIdPerfil();

$sql = "SELECT * FROM movielist WHERE idCriador =". $perfil->getIdPerfil() ."";
$listas = MovieList::__querySQL($sql, $conn);

$sql = "SELECT * FROM movielist WHERE idList IN (SELECT ml.idList FROM movielist ml, seguelist sl WHERE ml.idList = sl.idList AND sl.idPerfil = $perfId)";
$seguidas = MovieList::__querySQL($sql, $conn);
if(isset($_SESSION["search_list_result"])){
    $result = $_SESSION["search_list_result"];
}
$conn->close();
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
<link href="css/table.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/cliente.css" rel="stylesheet" type="text/css" media="all" />
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
					<li><a href="home.php"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a class="active" href="videos.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a href="genero.php"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<li><a href="list_main.php"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<li><a href="contact.php"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
				</ul>
			</div>
		<div class="main">
		<div class="header">
			<div class="top-header">
				<div class="logo">
					<p><?php echo "Usuario: ".$_SESSION["user"]; ?> </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				<p>Criar MovieList </p>
				<div class="contact-form">
					<form id="formCliente" action="list_create_bd.php" method="post">
						<div class="col-md-6 contact-left">
							<input name = "nome" type = "text" placeholder="Nome"/>
                            <input name = "descricao" type = "text" placeholder= "Breve Descrição">
                            <div class = "containerMax">
				                <ul>
						            <li><input type = 'radio' name = 'tipo' id = 'publica' value = 1 checked><label for = 'publica'> Publica </label><div class = 'check'><div class = 'inside'></div></div></li>
                                    <li><input type = 'radio' name = 'tipo' id = 'privada' value = 0><label for = 'privada'> Privada </label><div class = 'check'><div class = 'inside'></div></div></li>
                                </ul>
                            </div>
							<div class = "clearfix"></div>
							<div class = "sep">
							<input type="submit" value="Criar"/>
							</div>
						</div>
						
						<div class="clearfix"></div>
					</form>
				</div>
		 
			</div>

			<br><br>
		
		</div>
		
		
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
