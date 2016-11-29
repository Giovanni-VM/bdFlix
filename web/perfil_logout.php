<?php
session_start();
$_SESSION["perf_logado"] = false;
$_SESSION["user"] = "";
header('Location: index.php');
exit();

?>