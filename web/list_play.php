<?php
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_filme.php";
include "classes/class_midia.php";
include "classes/class_pc_midiafilme.php";
include "classes/class_movieList.php";
include "classes/class_serie.php";

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

$idList = $_GET["idList"];

$sql = "SELECT * FROM movielist WHERE idList = $idList";
$listas = MovieList::__querySQL($sql, $conn);

$lista = $listas[0];
if($lista == NULL){
	header("Location: 404.html");
	exit();
}

$sql = "SELECT * FROM perfil WHERE idPerfil = ".$lista->getIdCriador()."";
$lisCria = Perfil::__querySQL($sql, $conn);
$objCriador = $lisCria[0];
$criador = $objCriador->getNome();

$sql = "SELECT * FROM midia WHERE idMidia IN (SELECT id FROM midiaslist WHERE idList = $idList)";
$midias = Midia::__querySQL($sql, $conn);

foreach($midias as $md){
    if($md->getTipo() == 0){
        $sql = "SELECT * FROM filme WHERE idMidia = ".$md->getIdMidia()."";
        $filmes = Filme::__querySQL($sql, $conn);
        $fil = $filmes[0];
        $md->setUrl($fil->getCapa());
    } else {
        $sql = "SELECT * FROM serie WHERE idSerie IN(SELECT idSerie FROM episodio WHERE idMidia = ".$md->getIdMidia().")";
        $series = Serie::__querySQL($sql, $conn);
        $ser = $series[0];
        $md->setUrl($ser->getCapa());
    }
}

$conn->close();
?>
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body background= >
	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				<ul>
					<li><a href="home.php"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a href="videos.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a href="genero.php"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<li><a class = "active" href="list_main.php"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
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
			<div class="right-content-heading-left">
				<h3 class="head">MovieList <?=$lista->getNome()?></h3>
			</div>
            <br>
            <div class="right-content-heading-left">
				<p>Criada Por <?=$criador?></h3>
			</div>
            <br>
            <div class="right-content-heading-left">
				<p>Descrição: <?=$lista->getDescricao()?></h3>
			</div>
			<div class="more-reviews">
				<ul id="flexiselDemo2">
					<?php
						$cont = 0;
						foreach($midias as $mid){
								echo "<li><a href = 'assistir.php' id = 'play$cont'><img src = '" . $mid->getUrl() . "' alt = ''/></a></li>";
                                $cont++;
						}
					?>
				</ul>
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
			</div>
			
		</div>
		


		
	<div class="footer">
		<h6>Disclaimer : </h6>
		<p class="claim">This is a freebies and not an official website, I have no intention of disclose any movie, brand, news.My goal here is to train or excercise my skill and share this freebies.</p>
		<a href="example@mail.com">example@mail.com</a>
		<div class="copyright">
			<p> Template by  <a href="http://w3layouts.com">  W3layouts</a></p>
		</div>
	</div>
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
