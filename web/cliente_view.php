<?php
session_start();
$_SESSION["error_form_cli"] = false;
$_SESSION["err_cli"] = "";

if(!isset($_SESSION["cli_logado"]) or !$_SESSION["cli_logado"]){
	header("Location: index.php");
	exit();
}

$cli = $_SESSION['cliente'];

include "bd.php";
include "classes/class_cliente.php";
include "classes/class_plano.php";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

if($_POST["senha"] != $_POST["senha2"]){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senhas não conferem";
    $conn->close();
    header("Location: home_cliente.php");
    exit();
}

$cliente->setNome($_POST["nome"]);
$cliente->setCpf($_POST["cpf"]);
$cliente->setEmail($_POST["email"]);
$cliente->setSenha($_POST["senha"]);
$cliente->setNCartao($_POST["numCartao"]);
$cliente->setCodCartao($_POST["codCartao"]);
$cliente->setValCartao($_POST["valCartao"]);
$cliente->setEstado($_POST["estado"]);
$cliente->setCidade($_POST["cidade"]);
$cliente->setBairro($_POST["bairro"]);
$cliente->setRua($_POST["rua"]);
$cliente->setNumero($_POST["numero"]);
$cliente->setComplemento($_POST["complemento"]);  
$cliente->setIdPlano($_POST["idPlano"]);

if(!$cliente->save($conn)){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Impossivel Modificar Banco de Dados - Entre em contato com a central"; 
    $conn->close();
    header("Location: home_cliente.php");
    exit();
}

$conn->close();
header("Location: home_cliente.php");
exit();


?>