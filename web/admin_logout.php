<?php

session_start();

$_SESSION["adm_logado"] = false;

header("Location: admin_login.php");


?>