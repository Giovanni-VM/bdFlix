<?php
session_start();
unset($_SESION["search_result"]);

include "classes/class_midia.php";
include "classes/class_movieList.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname);

$pesquisa = $_SESSION["search_titulo"];

if(isset($_SESSION["lista_atual"])){
    $lista = $_SESSION["lista_atual"];
} else {
    $lista = $_POST["idList"];
}

if($pesquisa == ""){
    $dest = "Location: list_lista_perfil.php?idList=".$lista."";
    $conn->close();
    header($dest);
    exit();
}


$sql = "SELECT * FROM midia WHERE idMidia IN (SELECT idMidia FROM midia WHERE titulo LIKE '%$pesquisa%' AND idMidia NOT IN(
        SELECT id FROM midiaslist WHERE idList = $lista))";

$midias = Midia::__querySQL($sql, $conn);

$_SESSION["search_result"] = $midias;
$dest = "Location: list_lista_perfil.php?idList=".$lista."";
$conn->close();
header($dest);
?>