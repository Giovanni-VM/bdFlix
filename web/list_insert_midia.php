<?php
session_start();

include "bd.php";

$idInserido = $_GET["idMidia"];
$lista = $_SESSION["lista_atual"];

$conn = new mysqli($host, $username, $password, $dbname);

$conn->query("INSERT INTO midiaslist VALUES ($idInserido, $lista)");
header("Location: search_midia_name.php");
exit();


?>