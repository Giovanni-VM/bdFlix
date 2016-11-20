<?php
session_start();

if(!isset($_SESSION["cli_logado"]) or !$_SESSION["cli_logado"]){
	header("Location: index.php");
	exit();
}

$cli = $_SESSION['cliente'];

include "bd.php";
include "classes/class_cliente.php";
include "classes/class_plano.php";
include "classes/class_perfil.php";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$sql = "SELECT * FROM perfil WHERE idPerfil = '". $_POST["idPerfil"]."'";

$perfis = PERFIL::__querySQL($sql, $conn);

$perfil = $perfis[0];

if($_POST["senha"] != $_POST["senha2"]){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senhas não conferem";
    $conn->close();
    header("Location: cliente_perfil_lista.php");
    exit();
}

if(md5($_POST["senha"]) != $cliente->getSenha()){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senha Incorreta";
    $conn->close();
    header("Location: cliente_perfil_lista.php");
    exit();
}

if($perfil->delete($conn)){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Perfil Deletado";
} else {
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Problema em Deletar Perfil";
}

$conn->close();
header("Location: cliente_perfil_lista.php");
exit();


?>