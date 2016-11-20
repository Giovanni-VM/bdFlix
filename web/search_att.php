<?php
session_start();

$_SESSION["search_titulo"] = $_POST["titulo"];

header("Location: list_insert_midia.php");
?>