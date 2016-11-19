<?php
session_start();

if(isset($_SESSION['perf_logado']) && $_SESSION['perf_logado']){
  header('Location: home.php');
  exit();
}

include 'valida_campos.php';
include 'bd.php';

$_SESSION['perf_logado'] = false; // Session para verificar login em qualquer pagina
$_SESSION['login_fail'] = true;

$user = $_POST['user'];
$passwd = $_POST['passwd'];

if(valida_login($user) && valida_senha($passwd)){

  $con = new mysqli($host, $username, $password, $dbname);

  $passwd = md5($passwd);
  $sql = "SELECT * FROM perfil WHERE nome = '$user' AND senha = '$passwd' ";
  $r = mysqli_query($con, $sql);
  if(mysqli_num_rows($r) == 1) {
    $_SESSION['perf_logado'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['login_fail'] = false;
    header('Location: home.php');
    exit();
  }
}

header('Location: index.php');

?>
