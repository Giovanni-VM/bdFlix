<?php
session_start();

include "classes/class_movieList.php";
include "classes/class_perfil.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

$idPerf = $perfil->getIdPerfil();

$lista = new MovieList(NULL);

$lista->setIdCriador($idPerf);
$lista->setNome($_POST["nome"]);
$lista->setDescricao($_POST["descricao"]);
$lista->setPublic($_POST["tipo"]);
$lista->setSeguidores(0);
$lista->save($conn);

$conn->close();
header("Location: list_main.php");
exit();


?>