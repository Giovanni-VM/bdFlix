<?php
session_start();
unset($_SESSION["search_list_result"]);

include "classes/class_midia.php";
include "classes/class_movieList.php";
include "classes/class_perfil.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

$idPerf = $perfil->getIdPerfil();

$pesquisa = $_SESSION["search_list"];

if($pesquisa == ""){
    $dest = "Location: list_main.php";
    $conn->close();
    header($dest);
    exit();
}

$sql = "SELECT * FROM movielist WHERE (publica = 1 OR (publica = 0 AND idCriador = $idPerf))AND idList NOT IN(SELECT ml.idList FROM movielist ml, seguelist sl WHERE ml.idList = sl.idList AND idPerfil = $idPerf) AND (nome LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%' OR idCriador IN (SELECT idPerfil FROM perfil WHERE nome LIKE '%$pesquisa%'))";

$listas = MovieList::__querySQL($sql, $conn);

$_SESSION["search_list_result"] = $listas;

$conn->close();
echo $sql;
header("Location: list_main.php");
?>