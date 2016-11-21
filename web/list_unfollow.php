<?php
session_start();

include "bd.php";
include "classes/class_perfil.php";
$conn = new mysqli($host, $username, $password, $dbname);

$idUnfollow = $_GET["idList"];
$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$idPerf = $perfil->getIdPerfil();

$sql = "SELECT * FROM movielist WHERE idList = $idFollow";
$l = MovieList::__querySQL($sql, $conn);
$lista = $l[0];
$lista->followMinus();
$lista->save($conn);


$conn->query("DELETE FROM seguelist WHERE idPerfil = $idPerf AND idList = $idUnfollow");
$conn->close();
header("Location: search_list_name.php");
exit();

?>