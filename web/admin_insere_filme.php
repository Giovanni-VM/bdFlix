<?php 

session_start(); 

if(!isset($_SESSION["adm_logado"]) or !$_SESSION["adm_logado"]){
	header("Location: admin_login.php");
	exit();
}
include "bd.php";
include "classes/class_filme.php";
include "classes/class_genero.php";
include "classes/class_genero_filme.php";
include "classes/class_midia.php";
include "classes/class_pc_midiafilme.php";

$sql2 = "SELECT m.idMidia, f.faixa, f.trailer, f.capa, m.duracao, m.titulo FROM midia as m, filme as f";

$conn = new mysqli($host, $username, $password, $dbname);


$sqlG = "SELECT * FROM genero ORDER BY nome";
$generos = Genero::__querySQL($sqlG, $conn);

$sqlGF = "SELECT * FROM generofilme";
$gfs = GeneroFilme::__querySQL($sqlGF, $conn);

$sql2 = "SELECT m.idMidia, f.faixa, f.trailer, f.capa, m.duracao, m.titulo FROM midia as m, filme as f WHERE m.idMidia = f.idMidia";
$midias = PCMidiaFilme::__querySQL($sql2, $conn);
$midia = new Midia(NULL);
$filme = new Filme(NULL);
if (isset($_GET["acao"])){
	if ($_GET["acao"] == "inserir" && $_GET["idMidia"] != NULL) {
		$aux = $_GET["idMidia"];
		$sql4 = "SELECT * FROM Midia WHERE idMidia = $aux";
		$sql5 = "SELECT * FROM Filme WHERE idMidia = $aux";
		$sql6 = "SELECT * FROM generofilme WHERE idMidia = $aux";
		$res = $conn->query($sql4);
		$m = Midia::__generate($res);
		$midia = $m[0];
		$res = $conn->query($sql5);
		$f = Filme::__generate($res);
		$filme = $f[0];
		$res = $conn->query($sql6);
		$generofilme = GeneroFilme::__querySQL($sql6, $conn);
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
			<div class="main-contact">
				<?php 
					if (isset($_GET["acao"])){
						if ($_GET["acao"] == "inserir" && $_GET["idMidia"] != NULL) {
							echo "<p>Editar filme</p>";
						}
					} else {
						echo "<p>Inserir filme</p>";
					}	
				?>
				<div class="contact-form">
					<form id="formCliente" action="filme_view.php?acao=inserir" method="post">
						<div class="col-md-6 contact-left">
							<input name = "idMidia" type = "hidden" value='<?=$midia->getIdMidia()?>' />
							<input name = "titulo" type = "text" placeholder="T&iacute;tulo do Filme" value='<?= $midia->getTitulo(); ?>'/>
							<input name = "duracao" type = "text" placeholder="Dura&ccedil;&atilde;o" value='<?= $midia->getDuracao(); ?>'/>
							<input name = "faixa" type = "text" placeholder="Faixa et&aacute;ria" value='<?= $filme->getFaixa(); ?>'/>
							<input name = "trailer" type = "text" placeholder="Link do Trailer" value='<?= $filme->getTrailer(); ?>'/>
							<input name = "capa" type = "text" placeholder="Capa do filme" value='<?= $filme->getCapa(); ?>'/>
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
															if($objeto->getIdGenero() == $fqweg->getIdGenero() && $fqweg->getIdMidia() == $midia->getIdMidia()) {
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
								<th></th>
                                <th>Id</th>
                                <th>T&iacute;tulo do Filme</th>                             
                                <th>Dura&ccedil;&atilde;o</th>                              
                                <th>Faixa et&aacute;ria</th>                             
                                <th>Link do Trailer</th>                             
                                <th>Capa do filme</th>      
								<th>G&ecirc;neros relacionados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
								if (!isset($_GET["acao"])){
									foreach ($midias as $objeto) {
										echo '<tr>';
										echo '<td> <a href="admin_insere_filme.php?acao=inserir&idMidia=' . $objeto->getIdMidia() . '" title="Editar"><img src="images/editar.png" /></a>';
										echo '&nbsp;&nbsp;<a href="filme_view.php?acao=excluir&idMidia=' . $objeto->getIdMidia() . '" title="Excluir"><img src="images/excluir.png" /></a></td>';
										 
										echo '<td>' . $objeto->getIdMidia() . '</td>';
										echo '<td>' . $objeto->getTitulo() . '</td>';
										echo '<td>' . $objeto->getDuracao() . '</td>';
										echo '<td>' . $objeto->getFaixa() . '</td>';
										echo '<td>' . $objeto->getTrailer() . '</td>';
										echo '<td>' . $objeto->getCapa() . '</td>';
										echo '<td>';
										
										foreach ($gfs as $gf) {
											if ($gf->getIdMidia() == $objeto->getIdMidia()) {
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
