<?php
session_start();
$_SESSION["error_form_cli"] = false;
$_SESSION["err_cli"] = "";

if(!isset($_SESSION["cli_logado"]) or !$_SESSION["cli_logado"]){
	header("Location: index.php");
	exit();
}

$cli = $_SESSION['cliente'];
$idPerf = $_POST['idPerfil'];

include "bd.php";
include "classes/class_perfil.php";
include "valida_campos.php";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM perfil WHERE idPerfil = '$idPerf'";

$res = $conn->query($sql);

$p = Perfil::__generate($res);

$perfil = $p[0];

$res->close();

if($_POST["senha"] != $_POST["senha2"]){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senhas não conferem";
    $conn->close();
    header("Location: cliente_perfil_lista.php");
    exit();
}

$perfil->setSenha($_POST["senha"]);
$perfil->setFtPerfil($_POST["ftPerfil"]);
$perfil->setIdade($_POST["idade"]);

if(!$perfil->save($conn)){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Impossivel Modificar Banco de Dados - Entre em contato com a central"; 
    $conn->close();
    header("Location: cliente_perfil_lista.php");
    exit();
}

$conn->close();
header("Location: cliente_perfil_lista.php");
exit();


?>