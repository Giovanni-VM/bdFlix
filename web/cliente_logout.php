<?php
session_start();

$_SESSION["cli_logado"] = false;
$_SESSION["cliente"] = "";

header("Location: index.php");

?>