<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php session_start(); 
include "classes/class_perfil.php";
include "classes/class_genero.php";
include "bd.php";

if(!isset($_SESSION["perf_logado"]) or !$_SESSION["perf_logado"]){
	header("Location: index.php");
	exit();
}


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$perfId = $perfil->getIdPerfil();

$sql = "SELECT * FROM genero WHERE idGenero NOT IN (SELECT idGenero FROM preferencia WHERE idPerfil = $perfId) ORDER BY nome";
$generosLivres = Genero::__querySQL($sql, $conn);
$sql = "SELECT * FROM genero WHERE idGenero IN (SELECT idGenero FROM preferencia WHERE idPerfil = $perfId) ORDER BY nome";
$generosPref = Genero::__querySQL($sql, $conn);
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Cinema A Entertainment Category Flat Bootstarp Resposive Website Template | Reviews :: w3layouts</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/table.css" rel="stylesheet" type="text/css" media="all" />
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
					<li><a href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a class="active" href="genero.php"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<li><a href="list_main.php"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<li><a  href="contact.php"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
				</ul>
			</div>
		<div class="main">
			<div class = "header">
			<div class="top-header">
				<div class="logo">
					<p><?php echo "Usuario: ".$_SESSION["user"]; ?> </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				<p>Editar Preferencias </p>
			</div>
			<div class="review-content">
				 <div>
                    <center>
						<h2>Seus Generos Preferidos</h2>
						<table cellpadding = '0'  cellspacing = '100' class = 'display' id='tabelaCliente'>
							<thead>
								<tr>
									<th></th>
									<th>Nome</th>
								</tr>
							</thead>
							<tbody>
						<?php
							foreach ($generosPref as $objeto) {
								echo '<tr>';
								echo '<td> <a href= "genero_unlike.php?idGenero='.$objeto->getIdGenero().'" title="Remover Preferencia"><img src="images/excluir.png" /></a></td>';
								echo '<td>' . $objeto->getNome() . '</td>';
								echo '</tr>';
							}

						?>
							</tbody>
						</table>
					</center>
				</div>

				<br><br><br><br>
				<center><h2>Outros Generos</h2></center>
				<div style = "overflow-y: scroll; height: 300px; width: 100%;">
 					<center>
						<table cellpadding = '0'  cellspacing = '100' class = 'display' id='tabelaCliente'>
							<thead>
								<tr>
									<th></th>
									<th>Nome</th>
								</tr>
							</thead>
							<tbody>
						<?php
							foreach ($generosLivres as $objeto) {
								echo '<tr>';
								echo '<td> <a href= "genero_like.php?idGenero='.$objeto->getIdGenero().'" title="Adicionar Preferencia"><img src="images/novo.png" /></a></td>';
								echo '<td>' . $objeto->getNome() . '</td>';
								echo '</tr>';
							}

						?>
							</tbody>
						</table>
					</center>
				</div>
			</div>
			</div>
		</div>	
	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>