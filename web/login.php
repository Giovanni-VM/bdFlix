<?php
session_start();

$_SESSION['logado'] = false; // Session para verificar login em qualquer pagina

$user = $_POST['user'];
$passwd = $_POST['passwd'];

// **LEMBRAR DE POR SUA SENHA**
$con = new mysqli('localhost', 'root', 'int$mySql', 'bdFlix');

$sql = "SELECT * FROM perfil AS p WHERE p.idCliente = ? AND p.senha = ?";
$r = $con->query($sql, array($user, $passwd));

if($r->num_rows() == 1) {
  $_SESSION['logado'] = true;
  $_SESSION['user'] = $user;
}

header('Location: index.php');

?>
