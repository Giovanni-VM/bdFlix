<?php
session_start();

include "bd.php";

$idRemovido = $_GET["idMidia"];
$lista = $_SESSION["lista_atual"];

$conn = new mysqli($host, $username, $password, $dbname);

$conn->query("DELETE FROM midiaslist WHERE id = $idRemovido AND idList = $lista");
header("Location: search_midia_name.php");
exit();

?>