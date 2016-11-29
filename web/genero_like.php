<?php
session_start();

include "classes/class_preferencia.php";
include "classes/class_perfil.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";

$p = Perfil::__querySQL($sql,$conn);
$perfil = $p[0];

$idPerf = $perfil->getIdPerfil();

if(!isset($_GET["idGenero"])){
    $conn->close();
    header("Location: genero.php");
    exit();
}

$genero = $_GET["idGenero"];

$pref = new Preferencia(NULL);

$pref->setIdPerfil($idPerf);
$pref->setIdGenero($genero);

$pref->save($conn);

$conn->close();
header("Location: genero.php");
exit();

 ?>