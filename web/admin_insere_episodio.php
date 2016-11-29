<?php 

session_start(); 

if(!isset($_SESSION["adm_logado"]) or !$_SESSION["adm_logado"]){
	header("Location: admin_login.php");
	exit();
}
include "bd.php";
include "classes/class_episodio.php";
include "classes/class_midia.php";
include "classes/class_pc_midiaepisodio.php";

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["admin"]."'";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");


$idSerie = $_GET["idSerie"];
$sql2 = "SELECT m.idMidia, e.temporada, e.episodio, m.duracao, m.titulo, e.idSerie, m.video FROM midia as m, episodio as e WHERE m.idMidia = e.idMidia AND e.idSerie =  $idSerie";
$midias = PCMidiaEpisodio::__querySQL($sql2, $conn);
$midia = new Midia(NULL);
$episodio = new Episodio(NULL);
$episodio->setIdSerie($idSerie);
if (isset($_GET["acao"])){
	if ($_GET["acao"] == "inserir" && $_GET["idMidia"] != NULL) {
		$aux = $_GET["idMidia"];
		$sql4 = "SELECT * FROM Midia WHERE idMidia = $aux";
		$sql5 = "SELECT * FROM Episodio WHERE idMidia = $aux";
		$res = $conn->query($sql4);
		$m = Midia::__generate($res);
		$midia = $m[0];
		$res = $conn->query($sql5);
		$f = Episodio::__generate($res);
		$episodio = $f[0];
	}
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
			<div class="top-header">
				<div class="logo">
					<p><?php echo "Usuario: ".$_SESSION["admin"]; ?> </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				<?php 
					if (isset($_GET["acao"])){
						if ($_GET["acao"] == "inserir" && $_GET["idMidia"] != NULL) {
							echo "<p>Editar Epis&oacute;dio</p>";
						}
					} else {
						echo "<p>Inserir Epis&oacute;dio</p>";
					}	
				?>
				<div class="contact-form">
					<form id="formCliente" action="episodio_view.php?acao=inserir" method="post">
						<div class="col-md-6 contact-left">
							<input name = "idMidia" type = "hidden" value='<?=$midia->getIdMidia()?>' />
							<input name = "idSerie" type = "hidden" value='<?=$episodio->getIdSerie()?>' />
							<input name = "temporada" type = "text" placeholder="Temporada" value='<?= $episodio->getTemporada(); ?>'/>
							<input name = "episodio" type = "text" placeholder="Epis&oacute;dio" value='<?= $episodio->getEpisodio(); ?>'/>
							<input name = "duracao" type = "text" placeholder="Dura&ccedil;&atilde;o" value='<?= $midia->getDuracao(); ?>'/>
							<input name = "titulo" type = "text" placeholder="T&iacute;tulo" value='<?= $midia->getTitulo(); ?>'/>
							<input name = "trailer" type = "text" placeholder="Link do Trailer" value='<?= $midia->getTrailer(); ?>'/>

							<input type="submit" value="SEND"/>
						</div>
						<div class="clearfix"></div>
					</form>
				</div>
		 
			</div>
			<div class ="blank-line"></div>
			<div>
				<center>
					<table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
                        <thead>
                            <tr>
								<th></th>
                                <th>Id</th>
                                <th>T&iacute;tulo do Epis&oacute;dio</th>                             
                                <th>Dura&ccedil;&atilde;o</th>                              
                                <th>N&uacute;mero do Epis&oacute;dio</th>                             
                                <th>Temporada</th>                 
                                <th>Link do Trailer</th>                 
                            </tr>
                        </thead>
                        <tbody>
                            <?php								
								foreach ($midias as $objeto) {
									echo '<tr>';
									
									echo '<td> <a href="admin_insere_episodio.php?acao=inserir&idMidia=' . $objeto->getIdMidia() . '&idSerie=' . $objeto->getIdSerie() . '" title="Editar"><img src="images/editar.png" /></a>';
									echo '&nbsp;&nbsp;<a href="episodio_view.php?acao=excluir&idMidia=' . $objeto->getIdMidia() . '&idSerie=' . $objeto->getIdSerie() . '" title="Excluir"><img src="images/excluir.png" /></a></td>';
									 
									echo '<td>' . $objeto->getIdMidia() . '</td>';
									echo '<td>' . $objeto->getTitulo() . '</td>';
									echo '<td>' . $objeto->getDuracao() . '</td>';
									echo '<td>' . $objeto->getEpisodio() . '</td>';
									echo '<td>' . $objeto->getTemporada() . '</td>';
									echo '<td>' . $objeto->getTrailer() . '</td>';
									echo '<td>';
									
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
	<div class="clearfix"></div>
</body>
</html>
