<?php session_start(); 
include "classes/class_perfil.php";
include "classes/class_filme.php";
include "classes/class_serie.php";
include "bd.php";


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

//$sql = "SELECT * FROM filme ORDER BY timestamp";
$sql = "SELECT F.idMidia, F.faixa, F.trailer, F.pesquisas, F.timestamp, F.capa FROM filme AS F, historico AS H WHERE H.idMidia = F.idMidia ORDER BY H.timestamps";
$filmes = Filme::__querySQL($sql, $conn);

$sql = "SELECT * FROM serie ORDER BY timestamp";
$series = Serie::__querySQL($sql, $conn);

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
					<li><a href="videos.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
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
			
			<!-- LISTA ÚLTIMOS FILMES VISTOS -->
			<?php
				if(count($filmes) > 0){
					echo "<div class='right-content-heading-left'>
						<h3 class='head'>&Uacute;ltimos filmes assistidos</h3>
					</div>
					<div class='more-reviews'>
						<ul id='flexiselDemo2'>";
								$cont = 0;
								foreach($filmes as $filme){
									if($cont < 10){
										echo "<li><img src = '" . $filme->getCapa() . "' alt = ''/></li>";
										$cont = $cont + 1;
									}
								}
							
						echo "</ul>" ;
				}
			?>
				<script type="text/javascript">
					$(window).load(function() {

						$("#flexiselDemo2").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,
							pauseOnHover: false,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: {
								portrait: {
									changePoint:480,
									visibleItems: 2
								},
								landscape: {
									changePoint:640,
									visibleItems: 3
								},
								tablet: {
									changePoint:768,
									visibleItems: 3
								}
							}
						});
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>
			<?php
				if(count($filmes) > 0){
					echo "</div>";
				}
			?>
			
			<!-- LISTA ÚLTIMOS SÉRIES VISTOS -->
			<?php
				if(count($series) > 0){
					echo "<div class='right-content-heading-left'>
						<h3 class='head'>&Uacute;ltimas S&eacute;ries assistidas</h3>
					</div>
					<div class='more-reviews'>
					<ul id='flexiselDemo3'>";
					$cont = 0;
					foreach($series as $serie){
						if($cont < 10){
							echo "<li><img src = '" . $serie->getCapa() . "' alt = ''/></li>";
							$cont = $cont + 1;
						}
					}
				}
			
				echo "</ul>";
			?>
				<script type="text/javascript">
					$(window).load(function() {

						$("#flexiselDemo3").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,
							pauseOnHover: false,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: {
								portrait: {
									changePoint:480,
									visibleItems: 2
								},
								landscape: {
									changePoint:640,
									visibleItems: 3
								},
								tablet: {
									changePoint:768,
									visibleItems: 3
								}
							}
						});
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>
			
				<?php
					if(count($series) > 0){
						echo "</div>";
					}
				?>
			
			<div class="right-content-heading-left">
				<h3 class="head">&Uacute;ltimos lancamentos</h3>
			</div>
			<div class="right-content-heading-left">
				<h3 class="head">Filmes mais assistidos</h3>
			</div>
			<div class="right-content-heading-left">
				<h3 class="head">Filmes mais procurados nos seus g&ecirc;neros favoritos</h3>
			</div>
		</div>
		
		<div class="video">
			<iframe  src="https://www.youtube.com/embed/2LqzF5WauAw" frameborder="0" allowfullscreen></iframe>
		</div>
		
		
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
