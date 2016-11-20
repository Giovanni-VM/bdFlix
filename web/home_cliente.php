<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();
setlocale(LC_MONETARY, 'pt_BR');

if(!isset($_SESSION["cli_logado"]) or !$_SESSION["cli_logado"]){
	header("Location: index.php");
	exit();
}

$cli = $_SESSION['cliente'];

include "bd.php";
include "classes/class_cliente.php";
include "classes/class_plano.php";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$sql = "SELECT * FROM plano";

$planos = Plano::__querySQL($sql, $conn);

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
		<div class = "form-cli">
			<form action = "cliente_view.php" method = "POST">
				<p>Nome:</p> <input type = "text" name = "nome" value = '<?=$cliente->getNome()?>' required>
				<p>CPF: </p><br><input type = "text" name = "cpf" value = '<?=$cliente->getCpf()?>' required>
				<p>Email:</p> <input type = "text" name = "email" value = '<?=$cliente->getEmail()?>' required>
				<p>Senha:</p> <input type = "password" name = "senha" value = '' required>
				<p>Confirme a Senha: </p><input type = "password" name = "senha2" value = '' required>
				<p>Num Cartao:</p> <input type = "text" name = "numCartao" value = '<?=$cliente->getNCartao()?>' required>
				<p>Cod Cartao: </p><input type = "text" name = "codCartao" value = '<?=$cliente->getCodCartao()?>' required>
				<p>Val. Cartao:</p> <input type = "date" name = "valCartao" value = '<?=$cliente->getValCartao()?>' required>
				<p>Estado: </p><input type = "text" name = "estado" value = '<?=$cliente->getEstado()?>' required>
				<p>Cidade:</p> <input type = "text" name = "cidade" value = '<?=$cliente->getCidade()?>' required>
				<p>Bairro: </p><input type = "text" name = "bairro" value = '<?=$cliente->getBairro()?>' required>
				<p>Rua:</p> <input type = "text" name = "rua" value = '<?=$cliente->getRua()?>' required>
				<p>Numero:<p> <input type = "text" name = "numero" value = '<?=$cliente->getNumero()?>' required>
				<p>Complemento:</p> <input type = "text" name = 'complemento' value = '<?=$cliente->getComplemento()?>' required>
				<p>Plano: </p>
				<div class = "containerMax">
				<ul>
				<?php
					foreach($planos as $key=>$value){
						echo "<li><input type = 'radio' name = 'idPlano' id = 'plano".$value->getIdPlano()."' value = '" . $value->getIdPlano() . "'";
						if($value->getIdPlano() == $cliente->getIdPlano()){
							echo "checked";
						}
						echo ">";
						echo " <label for = 'plano".$value->getIdPlano()."'> Plano " . $value->getNomePlano() . "<br>";
						echo "Quantidade Perfil: " . $value->getQtdPerfis() . "<br>";
						echo "Valor: R$" . number_format($value->getValor(), 2, ',', '.')  . "<br>";
						echo "</label><div class = 'check'><div class = 'inside'></div></div></li>";
					}

				?>
				</ul>
				</div>
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
