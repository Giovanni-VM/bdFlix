<?php session_start();
if(!isset($_SESSION["perf_logado"]) || !$_SESSION["perf_logado"]){
	header('Location: index.php');
	exit();
}
include "classes/class_perfil.php";
include "bd.php";

if(!isset($_GET['nomeSerie'])){
	header('Location: home.php');
	exit();
}

$nomeSerie = $_GET["nomeSerie"];

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$idPerfil = $perfil->getIdPerfil();

$sqlSerie = "SELECT s.faixa, s.nome, s.timestamp, s.capa, s.descricao, g.nome as Gen FROM Serie s, GeneroSerie gs, Genero g WHERE";
$sqlSerie .= " s.nome = '$nomeSerie' AND gs.idGenero = g.idGenero AND s.idSerie = gs.idSerie";
$r = mysqli_query($conn, $sqlSerie);


$serie = mysqli_fetch_assoc($r);
if (mysqli_num_rows($r) > 0) $generos[] = $serie["nome"];
while($lin = mysqli_fetch_assoc($r)){
	$generos[] = $lin["Gen"];
}

?>
<!DOCTYPE html>
<html>
<head>
<title>BdFlix | <?php echo $serie["nome"]; ?> </title>
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
<script>
function atualizaView(idPerfil, idMidia){
	$.ajax({
				url: "atualizaView.php",
				type: "POST",
				data: {idPerfil: idPerfil, idMidia: idMidia}
		});
}
</script>
</head>
<body>
	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				<ul>
					<li><a href="home.php"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a class="active" href="reviews.html"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<li><a href="list_main.php"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<li><a href="contact.php"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
				</ul>
			</div>
		<div class="main">
		<div class="single-content">
			<div class="top-header span_top">
				<div class="logo">
					<p><?php echo "Usuario: ".$_SESSION["user"]; ?> </p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Pesquise.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Pesquise..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
			<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
			 <script>
					$(document).ready(function() {
					$('.popup-with-zoom-anim').magnificPopup({
						type: 'inline',
						fixedContentPos: false,
						fixedBgPos: true,
						overflowY: 'auto',
						closeBtnInside: true,
						preloader: false,
						midClick: true,
						removalDelay: 300,
						mainClass: 'my-mfp-zoom-in'
					});
					});
			</script>
			<div class="reviews-section">
					<div class="reviews-grids">
						<div class="review">
							<div class="movie-pic">
								<img src="<?php echo $serie["capa"];?>" alt="capa"/>
							</div>
							<div class="review-info">
								<a class="span" href="single.html"><?php echo $serie["nome"]; ?></a>
								<p class="dirctr"><?php echo $serie["timestamp"]; ?></p>
								<div class="clearfix"></div>
								<div class="yrw">
									<!-- <div class="wt text-center">
										<a class = "button play-icon popup-with-zoom-anim" href="#small-dialog">ASSISTIR</a>
									</div>
									<div id="small-dialog" class="mfp-hide">
										<iframe  src="</?php echo $serie["trailer"];?>" frameborder="0" allowfullscreen></iframe>
									</div> -->
									<div class="clearfix"></div>
								</div>
								<p class="info">Idade: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $serie["faixa"];?></p>
								<p class="info">Gênero:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($generos)) foreach($generos as $g) echo " [".$g."] "  ?> </p>
								<!-- <p class="info">Duração:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</?php echo $serie["duracao"]; ?></p> -->
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="single">
							<h3>DESCRIÇÃO</h3>
							<p><i><?php echo $serie["descricao"]; ?> </i></p>
							<hr />
							<div class="content-grids">
							<?php

							$sql = "SELECT * FROM Episodio e, Midia m, Serie s WHERE s.nome = '$nomeSerie' AND e.idMidia = m.idMidia AND e.idSerie = s.idSerie";

							$r = mysqli_query($conn, $sql);
							$cont = 0;

							while ($ep = mysqli_fetch_assoc($r)) {
								$idMid = $ep["idMidia"];
								$cont++;
								$sqlVisto = "SELECT contador FROM Historico WHERE idPerfil = '$idPerfil' AND idMidia = '$idMid'";
								$viu = mysqli_fetch_row(mysqli_query($conn, $sqlVisto))[0];
								if($viu) $viu = "Sim";
								else $viu = "Nao";
								if($cont%4 != 0){
									echo "
									<div class=\"content-grid\">
										<a onclick = \"atualizaView(".$idPerfil.", ".$idMid.")\" class=\"play-icon popup-with-zoom-anim\" href=\"#small-dialog".$idMid."\"><img src=\"".$ep["capa"]."\" title=\"allbum-name\" /></a>
										<h3>".$ep["titulo"]."</h3>
										<h4> (TEMP: ".$ep["temporada"]." - Ep: ".$ep["episodio"].")</h3>
										<h5> Assistido: ".$viu."</h5>
										<a onclick = \"atualizaView(".$idPerfil.", ".$idMid.")\" class=\"button play-icon popup-with-zoom-anim\" href=\"#small-dialog".$idMid."\">Assistir</a>
									</div>
									<div id=\"small-dialog$idMid\" class=\"pop_up_play mfp-hide\">
										<iframe  src=\" ".$ep["video"]."\" frameborder=\"0\" allowfullscreen></iframe>
									</div>
									";
								} else { // to cansado
									echo "
									<div class=\"content-grid last-grid\">
									<a onclick = \"atualizaView(".$idPerfil.", ".$idMid.")\" class=\"play-icon popup-with-zoom-anim\" href=\"#small-dialog\"><img src=\"".$ep["capa"]."\" title=\"allbum-name\" /></a>
									<h3>".$ep["titulo"]."</h3>
									<h4> (TEMP: ".$ep["temporada"]." - Ep: ".$ep["episodio"].")</h3>
									<h5> Assistido: ".$viu."</h5>
									<a onclick = \"atualizaView(".$idPerfil.", ".$idMid.")\" class=\"button play-icon popup-with-zoom-anim\" href=\"#small-dialog\">Assistir</a>
								</div>
								<div id=\"small-dialog\" class=\"mfp-hide\">
									<iframe  src=\" ".$ep["video"]."\" frameborder=\"0\" allowfullscreen></iframe>
								</div>
									";
								}
							}

							?>
						</div>

						</div>

	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>
