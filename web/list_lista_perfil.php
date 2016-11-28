<?php
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_filme.php";
include "classes/class_midia.php";
include "classes/class_pc_midiafilme.php";
include "classes/class_movieList.php";

session_start();

if(!isset($_SESSION["perf_logado"]) or !$_SESSION["perf_logado"]){
	header("Location: index.php");
	exit();
}


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$_SESSION["lista_atual"] = $_GET["idList"];
$listaAtual = $_GET["idList"];

$sql = "SELECT * FROM midia WHERE idMidia IN (SELECT m.idMidia FROM midia m, midiaslist ml WHERE ml.idList = $listaAtual AND m.idMidia = ml.id)";

$naLista = Midia::__querySQL($sql, $conn);

$sql = "SELECT * FROM movielist WHERE idList = $listaAtual";
$movies = MovieList::__querySQL($sql, $conn);
if($movies == NULL){
	header("Location: 404.html");
	exit();
}
$list = $movies[0];

if($list->getIdCriador() != $perfil->getIdPerfil()){
    header("Location: list_main.php");
    exit();
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
					<li><a href="home.php"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
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
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				<p>Editar Playlist </p>
				<div class="contact-form">
					<form id="formCliente" action="search_att.php" method="post">
						<div class="col-md-6 contact-left">
                            <input name = "idList" type = "hidden" value = "<?=$_GET['idList']?>">
							<input name = "titulo" type = "text" placeholder="Título Filme/Série/Episódio/Palavra Chave" value = ""/>
							<input type="submit" value="Search"/>
						</div>

						<div class="clearfix"></div>
					</form>
				</div>

			</div>
            <?php
                if(isset($_SESSION["search_result"])){
                    $midias = $_SESSION["search_result"];
                    if(count($midias) != 0){
                        echo
                        "<div>
                        <center>
                            <h2>Resultado Pesquisa</h2>
                            <table cellpadding = '0'  cellspacing = '100' class = 'display' id='tabelaCliente'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>T&iacute;tulo</th>
                                        <th>Dura&ccedil;&atilde;o</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";
                                foreach ($midias as $objeto) {
                                    echo '<tr>';
                                    echo '<td> <a href= "list_insert_midia.php?idMidia='.$objeto->getIdMidia().'" title="Editar"><img src="images/novo.png" /></a></td>';

                                    echo '<td>' . $objeto->getIdMidia() . '</td>';
                                    echo '<td>' . $objeto->getTitulo() . '</td>';
                                    echo '<td>' . $objeto->getDuracao() . '</td>';
                                    if($objeto->getTipo() == 0){
                                        echo '<td> Filme </td>';
                                    } else {
                                        echo '<td> Serie </td>';
                                    }
                                    echo '</tr>';
                                }

                            echo "</tbody>
                            </table>
                        </center>
                    </div>";
                }else {

                    echo "<div><center><h2>Nenhum item encontrado</h2></center></div>";
                }
                unset($_SESSION["search_result"]);
                }

            ?>
			<br><br>
			<div>
				<center>
                <?php
                    if(count($naLista) != 0){
                    echo '<h2>Atualmente na MovieList </h2>
					<table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
                        <thead>
                            <tr>
								<th></th>
                                <th>Id</th>
                                <th>T&iacute;tulo</th>
                                <th>Dura&ccedil;&atilde;o</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>';
									foreach ($naLista as $objeto) {
										echo '<tr>';
										echo '<td>&nbsp;&nbsp;<a href="list_remove_midia.php?idMidia=' . $objeto->getIdMidia() . '" title="Excluir"><img src="images/excluir.png" /></a></td>';

										echo '<td>' . $objeto->getIdMidia() . '</td>';
										echo '<td>' . $objeto->getTitulo() . '</td>';
										echo '<td>' . $objeto->getDuracao() . '</td>';
                                        if($objeto->getTipo() == 0){
                                            echo "<td> Filme </td>";
                                        } else {
                                            echo "<td> Serie </td>";
                                        }
										echo '</tr>';
									}
                                } else {
                                    echo "<h2> MovieList Vazia </h2>";
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
