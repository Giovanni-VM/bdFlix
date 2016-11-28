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
$perfId = $perfil->getIdPerfil();

$sql = "SELECT * FROM movielist WHERE idCriador =". $perfil->getIdPerfil() ."";
$listas = MovieList::__querySQL($sql, $conn);

$sql = "SELECT * FROM movielist WHERE idList IN (SELECT ml.idList FROM movielist ml, seguelist sl WHERE ml.idList = sl.idList AND sl.idPerfil = $perfId)";
$seguidas = MovieList::__querySQL($sql, $conn);
if(isset($_SESSION["search_list_result"])){
    $result = $_SESSION["search_list_result"];
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
					<li><a  href="videosG.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
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
				<p>Editar MovieList </p>
				<div class="contact-form">
					<form id="formCliente" action="search_list_att.php" method="post">
						<div class="col-md-6 contact-left">
							<input name = "nome" type = "text" placeholder="Busca por MovieList" value = ""/>
							<input type="submit" value="Search"/>
						</div>

						<div class="clearfix"></div>
					</form>
				</div>

			</div>

			<br><br>
			<div>
				<center>
                <?php
                if(isset($_SESSION["search_list_result"])){
                    if(count($result) != 0){
                    echo '<h2>Resultados Encontrados</h2>
					<table cellpadding = "0"  cellspacing = "100" class = "display" id="tabelaCliente">
                                     <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Descri&ccedil;&atilde;o</th>
                                        <th>Tipo</th>
                                        <th>Seguidores</th>
                                    </tr>
                                </thead>
                                <tbody>';
	                                foreach ($result as $objeto) {
                                        echo '<tr>';
                                        echo '<td> <a href= "list_follow.php?idList='.$objeto->getIdList().'" title="Seguir"><img src="images/novo.png" /></a>';
                                        echo '<a href= "list_play.php?idList='.$objeto->getIdList().'" title="Assistir"><img src="images/views.png" /></a></td>';
                                        echo '<td>' . $objeto->getIdList() . '</td>';
                                        echo '<td>' . $objeto->getNome() . '</td>';
                                        echo '<td>' . $objeto->getDescricao() . '</td>';
                                        if($objeto->getPublic() == 0){
                                            echo '<td> Privada </td>';
                                        } else {
                                            echo '<td> Publica </td>';
                                        }
                                        echo '<td>' . $objeto->getSeguidores() . '</td>';
                                        echo '</tr>';
                                    }
                                echo '</tbody>
                                    </table>';
                                } else {
                                    echo "<h2> Pesquisa sem Resultados </h2>";
                                }

                        }
                ?>
                </center>
                </div>
                <br><br>
                        <div>
                        <center>
                            <h2>Listas Gerenciadas por Você</h2>
                            <table cellpadding = '0'  cellspacing = '100' class = 'display' id='tabelaCliente'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Descri&ccedil;&atilde;o</th>
                                        <th>Tipo</th>
                                        <th>Seguidores</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                foreach ($listas as $objeto) {
                                    echo '<tr>';
                                    echo '<td> <a href= "list_lista_perfil.php?idList='.$objeto->getIdList().'" title="Editar"><img src="images/editar.png" /></a>';
                                    echo ' <a href= "list_excluir.php?idList='.$objeto->getIdList().'" title="Excluir"><img src="images/excluir.png" /></a>';
                                    echo '<a href= "list_play.php?idList='.$objeto->getIdList().'" title="Assistir"><img src="images/views.png" /></a></td>';

                                    echo '<td>' . $objeto->getIdList() . '</td>';
                                    echo '<td>' . $objeto->getNome() . '</td>';
                                    echo '<td>' . $objeto->getDescricao() . '</td>';
                                    if($objeto->getPublic() == 0){
                                        echo '<td> Privada </td>';
                                    } else {
                                        echo '<td> Publica </td>';
                                    }
                                    echo '<td>' . $objeto->getSeguidores() . '</td>';
                                    echo '</tr>';
                                }

                            ?>
                                <tr><td> <a href= "list_criar.php" title="Criar Nova MovieList"><img src="images/novo.png" /></a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </center>
                    </div>

            <br><br>

                <?php
                    if(count($seguidas) != 0){
                        echo
                        "<div>
                        <center>
                            <h2>Listas Seguidas por Você</h2>
                            <table cellpadding = '0'  cellspacing = '100' class = 'display' id='tabelaCliente'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Descri&ccedil;&atilde;o</th>
                                        <th>Tipo</th>
                                        <th>Seguidores</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";
                                foreach ($seguidas as $objeto) {
                                    echo '<tr>';
                                    echo ' <td><a href= "list_unfollow.php?idList='.$objeto->getIdList().'" title="Deixar de Seguir"><img src="images/excluir.png" /></a>';
                                    echo '<a href= "list_play.php?idList='.$objeto->getIdList().'" title="Assistir"><img src="images/views.png" /></a></td>';
                                    echo '<td>' . $objeto->getIdList() . '</td>';
                                    echo '<td>' . $objeto->getNome() . '</td>';
                                    echo '<td>' . $objeto->getDescricao() . '</td>';
                                    if($objeto->getPublic() == 0){
                                        echo '<td> Privada </td>';
                                    } else {
                                        echo '<td> Publica </td>';
                                    }
                                    echo '<td>' . $objeto->getSeguidores() . '</td>';
                                    echo '</tr>';
                                }

                            echo "</tbody>
                            </table>
                        </center>
                    </div>";
                }else {
                    echo "<div><center><h2>Você Não Segue Nenhuma MovieList</h2></center></div>";
                }
            ?>
		</div>


	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
