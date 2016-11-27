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

$sql = "SELECT * FROM plano WHERE idPlano = ".$cliente->getIdPlano()."";

$planos = Plano::__querySQL($sql, $conn);

$plano = $planos[0];

$sql = "SELECT * FROM perfil WHERE idCliente = ". $cliente->getIdCliente() . "";

$perfis = Perfil::__querySQL($sql, $conn);

$perfil = $perfis[0];

$sql = "SELECT * FROM perfil WHERE idCliente = ". $cliente->getIdCliente(). "";

$perfis = Perfil::__querySQL($sql, $conn);

$cadastrados = count($perfis);

if($cadastrados >= $plano->getQtdPerfis()){
	header("Location: cliente_perfil_lista.php");
	exit();
}

$sql = "SELECT * FROM perfil WHERE nome = ".$_POST["nome"]."";
$verNome = Perfil::__querySQL($sql, $conn);
if(count($verNome >= 1)){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Username já Cadastrado";
    $conn->close();
    header("Location: cliente_novo_perfil.php");
    exit();
}

if($_POST["senha"] != $_POST["senha2"]){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senhas não conferem";
    $conn->close();
    header("Location: cliente_novo_perfil.php");
    exit();
}

$perfil = new Perfil(NULL);

$perfil->setNome($_POST["nome"]);
$perfil->setIdCliente($cliente->getIdCliente());
$perfil->setSenha($_POST["senha"]);
$perfil->setFtPerfil($_POST["ftPerfil"]);
$perfil->setIdade($_POST["idade"]);

if(!$perfil->save($conn)){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Impossivel Modificar Banco de Dados - Entre em contato com a central"; 
    $conn->close();
    header("Location: cliente_novo_perfil.php");
    exit();
}

header("Location: cliente_novo_perfil.php");
exit();

?>