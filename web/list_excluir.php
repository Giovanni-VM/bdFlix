<?php
session_start();

include "bd.php";
include "classes/class_perfil.php";
include "classes/class_movieList.php";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$idDelete = $_GET["idList"];
$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$idPerf = $perfil->getIdPerfil();

$sql = "SELECT * FROM movielist WHERE idList = $idDelete";
$l = MovieList::__querySQL($sql, $conn);
$lista = $l[0];

if($lista->getIdCriador() != $idPerf){
    $conn->close();
    header("Location: search_list_name.php");
    exit();
}

$conn->query("DELETE FROM movielist WHERE idList = $idDelete");
$conn->close();
header("Location: search_list_name.php");
exit();
?>