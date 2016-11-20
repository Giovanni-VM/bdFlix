<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();

if(!isset($_SESSION["cli_logado"]) or !$_SESSION["cli_logado"]){
	header("Location: index.php");
	exit();
}

$cli = $_SESSION['cliente'];

include "bd.php";
include "classes/class_cliente.php";
include "classes/class_plano.php";
include "classes/class_perfil.php";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$sql = "SELECT * FROM plano WHERE idPlano = ".$cliente->getIdPlano()."";

$planos = Plano::__querySQL($sql, $conn);

$plano = $planos[0];

$sql = "SELECT * FROM perfil WHERE idPerfil = ". $_GET["idPerfil"]. "";

$perfis = Perfil::__querySQL($sql, $conn);

$perfil = $perfis[0];

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
<title>BdFlix</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />





<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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
	<div class="full-cli">
			<div class="menu-cli">
				<ul>
					<div class = "nav-button-cli">
						<li><a class = "button-cli" href = "home_cliente.php">Meus Dados</a></li>
					</div>
					<div class = "nav-button-cli">
						<li><a class = "button-cli" href = "cliente_perfil_lista.php">Meus Perfis</a></li>
					</div>
					<div class = "nav-button-cli">
						<li><a class = "button-cli">Relatórios</a></li>
					</div>
					<div class = "nav-button-cli">
						<li><a class = "button-cli">Sair</a></li>
					</div>
				</ul>
			</div>
		<div class="main-cli">
		<div>
			<div class="top-header">
				<div class="logo">
					<a href="index.php"><img src="images/logo.png" alt="" /></a>
					<p>Cinema em casa - BEM VINDO <?php echo $cliente->getNome(); ?></p>
				</div>
				<div class="clearfix">
				</div>
			</div>
		</div>
		<div class = "body-cli">
		<?php 
			if(isset($_SESSION["error_form_cli"])){
				echo "<h2>". $_SESSION["err_cli"] . "</h2>";
				$_SESSION["error_form_cli"] = FALSE;
				$_SESSION["err_cli"] = "";
			}
		?>
		<br>
		<h3>Edite abaixo as informações de <?=$perfil->getNome()?></h3>
		<div class = "form-cli">
			<form action = "cliente_altera_perfil.php" method = "POST">
				<input type = "hidden" name = "idPerfil" value = '<?=$perfil->getIdPerfil()?>'>
				<p>Senha: </p><br><input type = "password" name = "senha" value = '' required>
				<p>Confirmar Senha:</p> <input type = "password" name = "senha2" value = '' required>
				<p>Foto:</p> <input type = "text" name = "ftPerfil" value = '<?=$perfil->getFtPerfil()?>' required>
				<p>Idade: </p><input type = "text" name = "idade" value = '<?=$perfil->getIdade()?>' required>
				<input type = 'submit' value = 'Enviar'>
			</form>
		</div>
		</div>

		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
		</div>
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
