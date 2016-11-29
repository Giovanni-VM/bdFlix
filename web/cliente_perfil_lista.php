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
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$sql = "SELECT * FROM plano WHERE idPlano = ".$cliente->getIdPlano()."";

$planos = Plano::__querySQL($sql, $conn);

$plano = $planos[0];

$sql = "SELECT * FROM perfil WHERE idCliente = ". $cliente->getIdCliente(). "";

$perfis = Perfil::__querySQL($sql, $conn);

$cadastrados = count($perfis);

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
						<li><a class = "button-cli" href = "cliente_lista_fatura.php">Faturas</a></li>
					</div>
					<div class = "nav-button-cli">
						<li><a class = "button-cli" href = "cliente_logout.php">Sair</a></li>
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
			<div class = "perf-body">
				<ul>
				<?php
                    foreach($perfis as $perfil){
                        echo "<li><a class = 'button-cli' name = 'perfil' id = 'perfil".$perfil->getIdPerfil()."' href = 'cliente_edita_perfil.php?idPerfil=".$perfil->getIdPerfil()."'";
						echo ">";
						echo "Username: " . $perfil->getNome() . "<br>";
						echo "Idade: " . $perfil->getIdade() . "<br>";
						echo "</a></li>";
                    }
                    if($cadastrados < $plano->getQtdPerfis()){
                        echo "<li>
                            <a class = 'button-cli' name = 'novo' id = 'novo' href = 'cliente_novo_perfil.php'>Cadastrar Novo Perfil</a>
                        </li>";
                    }
                ?>
                </ul>
			</div>
		</div>

		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
		</div>
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
