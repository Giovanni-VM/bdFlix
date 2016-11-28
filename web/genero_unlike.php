<?php
session_start();

include "classes/class_preferencia.php";
include "classes/class_perfil.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname);

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

$sql = "SELECT * FROM preferencia WHERE idGenero = $genero AND idPerfil = $idPerf";

$prefs = Preferencia::__querySQL($sql, $conn);
$pref = $prefs[0];

$pref->remove($conn);

$conn->close();
header("Location: genero.php");
exit();


?>