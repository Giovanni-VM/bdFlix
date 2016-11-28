<?php session_start(); 
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_serie.php";
include "classes/class_genero.php";
include "classes/class_genero_serie.php";
include "classes/class_midia.php";
include "classes/class_episodio.php";
include "classes/class_pc_midiaepisodio.php";


$conn = new mysqli($host, $username, $password, $dbname);


if(!isset($_SESSION["adm_logado"]) or !$_SESSION["adm_logado"]){
	header("Location: admin_login.php");
	exit();
}

$sqlG = "SELECT * FROM genero ORDER BY nome";
$generos = Genero::__querySQL($sqlG, $conn);

$sqlGF = "SELECT * FROM generoserie";
$gfs = GeneroSerie::__querySQL($sqlGF, $conn);

$sql2 = "SELECT m.idMidia, e.temporada, e.episodio, m.duracao, m.titulo, e.idSerie, m.video FROM midia as m, episodio as e WHERE m.idMidia = e.idMidia";
$midias = PCMidiaEpisodio::__querySQL($sql2, $conn);
$midia = new Midia(NULL);
$episodio = new Episodio(NULL);

$sql2 = "SELECT * FROM serie";
$series = Serie::__querySQL($sql2,$conn);
$serie = new Serie(NULL);
if (isset($_GET["acao"])){
	if ($_GET["acao"] == "inserir" && $_GET["idSerie"] != NULL) {
		$aux = $_GET["idSerie"];
		$sql3 = "SELECT m.* FROM Midia as m, Episodio as e WHERE e.idSerie = $aux and m.idMidia = e.idMidia";
		$sql5 = "SELECT * FROM Episodio WHERE idSerie = $aux";
		$sql4 = "SELECT * FROM Serie WHERE idSerie = $aux";
		$sql6 = "SELECT * FROM generoserie WHERE idSerie = $aux";
		$res = $conn->query($sql3);
		$m = Midia::__generate($res);
		// $midia = $m[0];
		$res = $conn->query($sql5);
		$e = Episodio::__generate($res);
		// $episodio = $e[0];
		$res = $conn->query($sql4);
		$s = Serie::__generate($res);
		$serie = $s[0];
		$res = $conn->query($sql6);
		$generoserie = GeneroSerie::__querySQL($sql6, $conn);
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
					<p><?php echo "Usuario: ".$_SESSION["user"]; ?> </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				<?php 
					if (isset($_GET["acao"])){
						if ($_GET["acao"] == "inserir" && $_GET["idSerie"] != NULL) {
							echo "<p>Editar s&eacute;rie</p>";
						}
					} else {
						echo "<p>Inserir s&eacute;rie</p>";
					}	
				?>
				<div class="contact-form">
					<form id="formCliente" action="serie_view.php?acao=inserir" method="post">
						<div class="col-md-6 contact-left">
							<input name = "idSerie" type = "hidden" value='<?=$serie->getIdSerie()?>' />
							<input name = "nome" type = "text" placeholder="Nome da S&eacute;rie" value='<?= $serie->getNome(); ?>'/>
							<input name = "capa" type = "text" placeholder="Capa da S&eacute;rie" value='<?= $serie->getCapa(); ?>'/>
							<input name = "faixa" type = "text" placeholder="Faixa et&aacute;ria" value='<?= $serie->getFaixa(); ?>'/>
							<input name = "trailer" type = "text" placeholder="Link do Trailer" value='<?= $serie->getTrailer(); ?>'/>
							<input name = "descricao" type = "text" placeholder="Descricao da S&eacute;rie" value='<?= $serie->getTrailer(); ?>'/>
							<input type="submit" value="SEND"/>
						</div>
						<div class="col-md-6 contact-right">
							<div style="overflow: auto; max-height:350px; max-width:500px" >
								<table table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
									<thead>
										<tr>
											<th></th>
											<th>Id</th>
											<th>G&ecirc;nero</th>                                  
										</tr>
									</thead>

									
									<tbody>
										<?php										
											foreach ($generos as $objeto) {
												echo '<tr>';
													echo '<td><input name = "'. $objeto->getIdGenero() .'" type = "checkbox" ';
													if(isset($_GET["acao"])) {
														foreach($gfs as $fqweg) {
															if($objeto->getIdGenero() == $fqweg->getIdGenero() && $fqweg->getIDSerie() == $serie->getIdSerie()) {
																echo 'checked';
																break;
															}
														}
													}
													echo '/> </td>';
													echo '<td>' . $objeto->getIdGenero() . '</td>';
													echo '<td>' . $objeto->getNome() . '</td>';
												echo '</tr>';
											}                             
										?>   
									</tbody>
								</table>
							</div>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
			<div>
				<center>					 
					
					<table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
                        <thead>
                            <tr>
								<?php
									if (!isset($_GET["acao"])){
										echo '  <th></th>
												<th>Id</th>
												<th>Nome da S&eacute;rie</th>                             
												<th>Capa da S&eacute;rie</th>                         
												<th>Faixa et&aacute;ria</th>                         
												<th>Link do Trailer</th>      
												<th>G&ecirc;neros relacionados</th> ';
									}   else {
										echo '  <th>';												
													if (isset($_GET["acao"])){
														echo '  <a href="admin_insere_episodio.php?idSerie=' . $serie->getIdSerie() . '" title="Inserir Epis&oacute;dio"><img src="images/novo.png" /></a>';
													}                          
												echo	'</th>
												<th>N&uacute;mero do Epis&oacute;dio</th>                           
												<th>Temporada</th>      
												<th>Nome do Epis&oacute;dio</th>                     
												<th>Dura&ccedil;&atilde;o</th>                    
												<th>Link do Trailer</th>      ';
									}                          
								?>  
								
                            </tr>
                        </thead>
                        <tbody>
                            <?php
								if (!isset($_GET["acao"])){
									foreach ($series as $objeto) {
										echo '<tr>';
										echo '<td> <a href="admin_insere_serie.php?acao=inserir&idSerie=' . $objeto->getIdSerie() . '" title="Editar"><img src="images/editar.png" /></a>';
										echo '&nbsp;&nbsp;<a href="serie_view.php?acao=excluir&idSerie=' . $objeto->getIdSerie() . '" title="Excluir"><img src="images/excluir.png" /></a></td>';
										 
										echo '<td>' . $objeto->getIdSerie() . '</td>';
										echo '<td>' . $objeto->getNome() . '</td>';
										echo '<td>' . $objeto->getCapa() . '</td>';
										echo '<td>' . $objeto->getFaixa() . '</td>';
										echo '<td>' . $objeto->getTrailer() . '</td>';
										echo '<td>';
										
										foreach ($gfs as $gf) {
											if ($gf->getIdSerie() == $objeto->getIdSerie()) {
												foreach ($generos as $genero) {
													if ($gf->getIdGenero() == $genero->getIdGenero()) {
														echo $genero->getNome();
														echo '<br>';
														break;
													}
												} 												
											}
										}
										echo '</td>';
										echo '</tr>';
									}
								} else {
									foreach ($midias as $objeto) {
										if ($objeto->getIdSerie() == $_GET["idSerie"]) {
											echo '<tr>';
											echo '<td> <a href="admin_insere_episodio.php?acao=inserir&idMidia=' . $objeto->getIdMidia() . '&idSerie=' . $objeto->getIdSerie() . '" title="Editar"><img src="images/editar.png" /></a>';
											echo '&nbsp;&nbsp;<a href="episodio_view.php?acao=excluir&idMidia=' . $objeto->getIdMidia() . '&idSerie=' . $objeto->getIdSerie() . '" title="Excluir"><img src="images/excluir.png" /></a></td>';
											 
											echo '<td>' . $objeto->getEpisodio() . '</td>';
											echo '<td>' . $objeto->getTemporada() . '</td>';
											echo '<td>' . $objeto->getTitulo() . '</td>';
											echo '<td>' . $objeto->getDuracao() . '</td>';
											echo '<td>' . $objeto->getTrailer() . '</td>';
											
											echo '</tr>';
										}
										
									}
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
