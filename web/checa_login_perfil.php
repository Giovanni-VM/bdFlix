<?php
session_start();

include 'valida_campos.php';
include 'bd.php';

$_SESSION['logado'] = false; // Session para verificar login em qualquer pagina
$_SESSION['login_fail'] = true;

$user = $_POST['user'];
$passwd = $_POST['passwd'];

if(valida_login($user) && valida_senha($passwd)){

  // **LEMBRAR DE POR SUA SENHA**
  $con = new mysqli($host, $username, $password, $dbname);

  $sql = "SELECT * FROM perfil WHERE nome = '$user' AND senha = '$passwd' ";
  $r = mysqli_query($con, $sql);
  $_SESSION["cont"] = mysqli_num_rows($r);
  if(mysqli_num_rows($r) == 1) {
    $_SESSION['logado'] = true;
    $_SESSION['tp_login'] = "perfil";
    $_SESSION['user'] = $user;
    $_SESSION['login_fail'] = false;
    header('Location: home.php');
  }
}

header('Location: index.php');

?>
