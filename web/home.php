<?php session_start();
include "classes/class_perfil.php";
include "classes/class_filme.php";
include "classes/class_serie.php";
include "classes/class_pc_midiafilme.php";
include "bd.php";


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

//$sql = "SELECT * FROM filme ORDER BY timestamp";
$sql = "SELECT F.idMidia, F.faixa, F.trailer, F.pesquisas, F.timestamp, F.capa, F.descricao FROM filme AS F, historico AS H WHERE H.idMidia = F.idMidia ORDER BY H.timestamps";
$filmes = Filme::__querySQL($sql, $conn);

//ULTIMAS SÉRIES ADICIONADAS
$sql = "SELECT * FROM serie ORDER BY timestamp";
$series = Serie::__querySQL($sql, $conn);

//ULTIMOS FILMES ADICIONADOS
$sql = "SELECT F.idMidia, F.faixa, M.video, F.capa, M.duracao, M.titulo FROM filme AS F, midia AS M WHERE F.idMidia = M.idMidia && M.tipo = 0 ORDER BY F.timestamp";
$ultimos_filmes = PCMidiaFilme::__querySQL($sql, $conn);

//FILMES MAIS VISTOS
$sql = "SELECT F.idMidia, F.faixa, F.pesquisas, F.timestamp, F.capa, F.descricao FROM filme AS F, historico AS H WHERE F.idMidia = H.idMidia ORDER BY H.contador";
$filmes_mais_vistos = Filme::__querySQL($sql, $conn);

//SERIES MAIS VISTAS
$sql = "SELECT * FROM serie WHERE idSerie IN( SELECT E.idSerie FROM episodio AS E, historico AS H WHERE E.idMidia = H.idMidia ORDER BY H.contador)";
$series_mais_vistas = Serie::__querySQL($sql, $conn);

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
<body background= >
	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				<ul>
					<li><a class="active" href="home.php"><i class="home"></i></a></li>
					<li><a href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
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
				<div class="search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
		 		</div>
				<div class="clearfix"></div>
			</div>

			<!-- LISTA ÚLTIMOS FILMES CADASTRADOS -->
			
			<div class="right-content-heading-left">
				<h3 class="head">&Uacute;ltimos lancamentos de filmes</h3>
			</div>
			
			<div class="more-reviews">
			
					<div class="content-grid">
						<?php
							$cont = 0;
							foreach($ultimos_filmes as $ult_filme){
								if($cont < 2){
									echo "<div class = 'content-grid'><a class='play-icon' href = \"filme.php?idMidia=".$ult_filme->getIdMidia()."\"><img src = '" . $ult_filme->getCapa() . "' alt = ''/></a></div>";
									$cont = $cont + 1;
								}
							}
						?>
					</div>
			</div>
			<div class = "clearfix"></div>
			
			
				
			
			<!-- LISTA ÚLTIMOS SERIES CADASTRADOS -->
			

			<div class="right-content-heading-left">
				<h3 class="head">&Uacute;ltimos lancamentos de series</h3>
			</div>
			
			<div class="more-reviews">
			
					<div class="content-grid">
						<?php
							$cont = 0;
							foreach($series as $serie){
								if($cont < 2){
									echo "<div class = 'content-grid'><a class='play-icon' href = \"serie.php?nomeSerie=".$serie->getNome()."\"><img src = '" . $serie->getCapa() . "' alt = ''/></a></div>";
									$cont = $cont + 1;
								}
							}
						?>
					</div>
			</div>
			<div class = "clearfix"></div>
			
			
					
			<div class="right-content-heading-left">
				<h3 class="head">Filmes mais assistidos</h3>
			</div>
			
			<div class="more-reviews">
					<div class="content-grid">
						<?php
							$cont = 0;
							foreach($filmes_mais_vistos as $filme_mv){
								if($cont < 2){
									echo "<div class = 'content-grid'><a class='play-icon' href = \"filme.php?idMidia=".$filme_mv->getIdMidia()."\"><img src = '" . $filme_mv->getCapa() . "' alt = ''/></a></div>";
									$cont = $cont + 1;
								}
							}
						?>
					</div>
			</div>
			<div class = "clearfix"></div>

			
			
			<div class="right-content-heading-left">
				<h3 class="head">Series mais assistidas</h3>
			</div>
			
			<div class="more-reviews">
			
					<div class="content-grid">
						<?php
							$cont = 0;
							foreach($series_mais_vistas as $serie_mv){
								if($cont < 2){
									echo "<div class = 'content-grid'><a class='play-icon' href = \"serie.php?nomeSerie=".$serie_mv->getNome()."\"><img src = '" . $serie_mv->getCapa() . "' alt = ''/></a></div>";
									$cont = $cont + 1;
								}
							}
						?>
					</div>
			</div>
			<div class = "clearfix"></div>
			
			<div class="right-content-heading-left">
				<h3 class="head">Filmes mais procurados nos seus g&ecirc;neros favoritos</h3>
			</div>
		</div>

		<!-- <div class="video">
			<iframe  src="https://www.youtube.com/embed/2LqzF5WauAw" frameborder="0" allowfullscreen></iframe>
		</div> -->


	<div class="footer">
		<h6 class="claim">Desemvolvido por:</h6>
		<ul>
			<p class="claim">Giovanni Moreira - 85284</p>
			<p class="claim">Gustavo Uliana - 85248</p>
			<p class="claim">Fábio Martins - 85282</p>
			<p class="claim">Igor Cardoso - 85265</p>
		</ul>
		<div class="copyright">
			<p> Template by  <a href="http://w3layouts.com">  W3layouts</a></p>
		</div>
	</div>
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
