<?php session_start(); 
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_genero.php";


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

$sql2 = "SELECT * FROM genero";
$generos = Genero::__querySQL($sql2, $conn);
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
					<li><a href="admin_insere_filme.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
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
			<div>
				<center>
					<table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
                        <thead>
                            <tr>
                                <th>IdGenero</th>
                                <th>Nome</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($generos as $objeto) {
                                echo '<tr>';
                                /* echo '<td> <a href="MenuPrincipal.php?acao=editarUsuario&idUsuario=' . $objeto->getIdCliente() . '" title="Editar"><img src="../imagem/editar.png" /></a>';
                                echo '&nbsp;&nbsp;<a href="MenuPrincipal.php?acao=excluirUsuario&idUsuario=' . $objeto->getIdCliente() . '" title="Excluir"><img src="../imagem/excluir.png" /></a></td>';
                                 */
								echo '<td>' . $objeto->getIdGenero() . '</td>';
                                echo '<td>' . $objeto->getNome() . '</td>';
                                echo '</tr>';
                            }
                            ?>   
                        </tbody>
                    </table>
				</center>
			
			</div>
			<div class="main-contact">
				<p>Inserir genero.</p>
				<div class="contact-form">
					<form id="formCliente" action="genero_view.php?acao=salvar" method="post">
						<div class="col-md-6 contact-left">
							<input name = "nome" type="text" placeholder="Genero" required/>
							<input type="submit" value="SEND"/>
						</div>
						
						<div class="clearfix"></div>
					</form>
				</div>
		 
			</div>
		</div>
		
		
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
