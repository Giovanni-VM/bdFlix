<?php session_start();
if(!isset($_SESSION["perf_logado"]) || !$_SESSION["perf_logado"]){
	header('Location: index.php');
	exit();
}
include "classes/class_perfil.php";
include "bd.php";

if(!isset($_GET['idMidia'])){
	header('Location: home.php');
	exit();
}
$idMidia = $_GET["idMidia"];

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$idPerfil = $perfil->getIdPerfil();

$sqlFilme = "SELECT * FROM Filme f, Midia m, GeneroFilme gf, Genero g WHERE ";
$sqlFilme .= "m.idMidia = '$idMidia' AND f.idMidia = m.idMidia AND gf.idFilme = m.idMidia";
$sqlFilme .= " AND g.idGenero = gf.idGenero";
$r = mysqli_query($conn, $sqlFilme);

$filme = mysqli_fetch_assoc($r);
if (mysqli_num_rows($r) > 0) $generos[] = $filme["nome"];
while($lin = mysqli_fetch_assoc($r)){
	$generos[] = $lin["nome"];
}


$sqlJaViu = "SELECT * FROM Historico h WHERE h.idPerfil = '$idPerfil' AND h.idMidia = '$idMidia'";
$r = mysqli_query($conn, $sqlJaViu);
$jaViu = mysqli_num_rows($r);

?>


<!DOCTYPE html>
<html>
<head>
<title>BdFlix | <?php echo $filme["titulo"]; ?></title>
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
					<li><a class="active" href="filme.php"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
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
								<img src="<?php echo $filme["capa"];?>" alt="capa"/>
							</div>
							<div class="review-info">
								<a class="span" href="single.html"><?php echo $filme["titulo"]; ?></a>
								<p class="dirctr"><?php echo $filme["timestamp"]; ?></p>
								<div class="clearfix"></div>
								<div class="yrw">
									<div class="wt text-center">
										<a onclick ="atualizaView(<?php echo $idPerfil.", ".$idMidia ?>)" class = "button play-icon popup-with-zoom-anim" href="#small-dialog">ASSISTIR</a>
									</div>
									<div id="small-dialog" class="mfp-hide">
										<iframe  src="<?php echo $filme["video"];?>" frameborder="0" allowfullscreen></iframe>
									</div>
									<div class="clearfix"></div>
								</div>
								<p class="info">Já assistido:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($jaViu)?"Sim":"Nao"; ?></p>
								<p class="info">Idade: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $filme["faixa"];?></p>
								<p class="info">Gênero:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($generos)) foreach($generos as $g) echo " [".$g."] " ?>  </p>
								<p class="info">Duração:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $filme["duracao"]; ?></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="single">
							<h3>DESCRIÇÃO</h3>
							<p><i><?php echo $filme["descricao"]; ?> </i></p>
						</div>

	</div>
	<div class="clearfix"></div>
	</div>
</body>
</html>
