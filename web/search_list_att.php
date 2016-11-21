<?php
session_start();

$_SESSION["search_list"] = $_POST["nome"];
header("Location: search_list_name.php");
?>