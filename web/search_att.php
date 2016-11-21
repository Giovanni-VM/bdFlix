<?php
session_start();

$_SESSION["search_titulo"] = $_POST["titulo"];

header("Location: search_midia_name.php");
?>