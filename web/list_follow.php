<?php
session_start();

include "bd.php";
include "classes/class_perfil.php";
$conn = new mysqli($host, $username, $password, $dbname);

$idFollow = $_GET["idList"];
$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];
$idPerf = $perfil->getIdPerfil();

$conn->query("INSERT INTO seguelist VALUES ($idPerf, $idFollow)");
header("Location: search_list_name.php");
exit();

?>