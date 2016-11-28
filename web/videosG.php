<?php session_start();
if(!isset($_SESSION["perf_logado"]) || !$_SESSION["perf_logado"]){
	header('Location: index.php');
	exit();
}
include "classes/class_perfil.php";
include "bd.php";

if(!isset($_GET['tpVid']))  $tpVid  = "filme";
else $tpVid  = $_GET['tpVid'];
if(!isset($_GET['genero'])) $genero = "qualquer";
else $genero = $_GET['genero'];

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
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
<title>Cinema em casa | Videos</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- header-section-starts -->
	<div class="full">
			<div class="menu">
				<ul>
					<li><a href="home.php"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a class="active" href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a href="genero.php"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<li><a href="list_main.php"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<li><a href="contact.php"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
				</ul>
			</div>
		<div class="main">
		<div class="video-content">
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
			<div class="right-content">
				<div class="right-content-heading">
					<div class="right-content-heading-left">
						<!-- <h3 class="head">Latest Colletcion of videos</h3> -->
					</div>
				</div>
				<!-- pop-up-box -->
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

		<!--//pop-up-box -->

				<div class="content-grids">

					<form method = "GET" action = "" style = "margin-bottom: 50px;">
						<div class="form-group">
	  					<label for="tpVid">Tipo de vídeo</label>
	  					<select class="form-control" id="tpVid" name = "tpVid">
	    					<option value = "filme"<?php if($tpVid == "filme") echo " selected"; ?>>Filme</option>
	    					<option value = "serie"<?php if($tpVid == "serie") echo " selected"; ?>>Série</option>
	  					</select>
						</div>
						<div class="form-group">
	  					<label for="genero">Gênero</label>
	  					<select class="form-control" id="genero" name = "genero">
								<option value = "qualquer"<?php if($genero == "qualquer") echo " selected"; ?>>Qualquer..</option>
								<?php
									$sql = "SELECT * FROM Genero";
									$r = mysqli_query($conn, $sql);
									while($g = mysqli_fetch_assoc($r)){
										echo "<option value = \"".$g["idGenero"]."\" ";
										if($genero == $g["idGenero"]) echo "selected";
										echo ">".$g["nome"]."</option>";
									}
								?>
	  					</select>
						</div>
						<div class = "form-group">
							<input type = "submit" value = "Aplicar">
						</div>
					</form>

					<?php
						$numFilmes = 0;

						if($genero != "qualquer"){
							$r1 = mysqli_query($conn, "SELECT COUNT(*) FROM GeneroFilme WHERE idGenero = '$genero'");
							$r2 = mysqli_query($conn, "SELECT COUNT(*) FROM GeneroSerie WHERE idGenero = '$genero'");
						} else {
							$r1 = mysqli_query($conn, "SELECT COUNT(*) FROM GeneroFilme");
							$r2 = mysqli_query($conn, "SELECT COUNT(*) FROM GeneroSerie");
						}
						$nL1 = mysqli_fetch_row($r1)[0];
						$nL2 = mysqli_fetch_row($r2)[0];

						if($tpVid == "filme"){
							$numFilmes = $nL1;
						} else {
							$numFilmes = $nL2;
						}

						$pagAtual = isset($_GET['pagAtual']) ? $_GET['pagAtual'] : 1;
						if($tpVid == "filme"){
							$sql = "SELECT DISTINCT f.capa, f.idMidia, f.timestamp, m.titulo FROM Filme f, GeneroFilme gf, Midia m WHERE f.idMidia = gf.idFilme";
							if($genero != "qualquer")
							 	$sql = $sql." AND idGenero = '$genero'";
							$sql = $sql." AND m.idMidia = f.idMidia ORDER BY `timestamp` DESC LIMIT 12 OFFSET ";
							$offsetSQL = ($pagAtual-1)*12;
							$sql = $sql.$offsetSQL;

							$r = mysqli_query($conn, $sql);
							$cont = 0;

							while ($filme = mysqli_fetch_assoc($r)) {
								$cont++;
								if($cont%4 != 0){
									echo "
									<div class=\"content-grid\">
										<a href=\"filme.php?idMidia=".$filme["idMidia"]."\"><img src=\"".$filme["capa"]."\" title=\"allbum-name\" /></a>
										<h3>".$filme["titulo"]."</h3>
										<a class=\"button\" href=\"filme.php?idMidia".$filme["idMidia"]."\">Assistir</a>
									</div>
									";
								} else { // to cansado
									echo "
									<div class=\"content-grid last-grid\">
										<a href=\"filme.php?idMidia=".$filme["idMidia"]."\"><img src=\"".$filme["capa"]."\" title=\"allbum-name\"/></a>
										<h3>".$filme["titulo"]."</h3>
										<a class=\"button\" href=\"filme.php?idMidia=".$filme["idMidia"]."\">Assistir</a>
									</div>
									";
								}
							}
						} else {
							$sql = "SELECT DISTINCT s.nome, s.capa, s.timestamp FROM Serie s, GeneroSerie gs WHERE s.idSerie = gs.idSerie";
							if($genero != "qualquer")
							 	$sql = $sql." AND s.idGenero = '$genero'";
							$sql = $sql." ORDER BY `timestamp` DESC LIMIT 12 OFFSET ";
							$offsetSQL = ($pagAtual-1)*12;
							$sql = $sql.$offsetSQL;

							$r = mysqli_query($conn, $sql);
							$cont = 0;

							while ($serie = mysqli_fetch_assoc($r)) {
								$cont++;
								if($cont%4 != 0){
									echo "
									<div class=\"content-grid\">
										<a href=\"serie.php?nomeSerie=".$serie["nome"]."\"><img src=\"".$serie["capa"]."\" title=\"allbum-name\" /></a>
										<h3>".$serie["nome"]."</h3>
										<a class=\"button\" href=\"serie.php?nomeSerie=".$serie["nome"]."\">Assistir</a>
									</div>
									";
								} else { // to cansado
									echo "
									<div class=\"content-grid last-grid\">
										<a href=\"serie.php?nomeSerie=".$serie["nome"]."\"><img src=\"".$serie["capa"]."\" title=\"allbum-name\" /></a>
										<h3>".$serie["nome"]."</h3>
										<a class=\"button\" ref=\"serie.php?nomeSerie=".$serie["nome"]."\">Assistir</a>
									</div>
									";
								}
							}
						}

					?>


					<div class="clearfix"> </div>
					<!---start-pagenation----->
					<div class="pagenation">
						<ul>
							<?php
								//$numPags = 5;
								$numPags = ($numFilmes/12 > intval($numFilmes/12)) ? intval($numFilmes/12)+1 : intval($numFilmes/12);
								for($i = 1; $i <= $numPags; $i++){
									if($i == $pagAtual)
										echo "<li><a href=\"?pagAtual=$i\" style = \"color:#FF8C00;\">$i</a></li>";
									else
										echo "<li><a href=\"?pagAtual=$i\">$i</a></li>";
								}
								$proximaPag = $pagAtual+1;
								echo "<li><a href=\"?pagAtual=$proximaPag\">Proxima</a></li>";
							?>
						</ul>
					</div>
					<div class="clearfix"> </div>
					<!---End-pagenation----->
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>
	<!-- <div class="footer">
		<h6>Disclaimer : </h6>
		<p class="claim">This is a freebies and not an official website, I have no intention of disclose any movie, brand, news.My goal here is to train or excercise my skill and share this freebies.</p>
		<a href="example@mail.com">example@mail.com</a>
		<div class="copyright">
			<p> Template by  <a href="http://w3layouts.com">  W3layouts</a></p>
		</div>
	</div> -->
	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>
