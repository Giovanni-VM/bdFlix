<?php
session_start();
$_SESSION["error_form_cli"] = false;
$_SESSION["err_cli"] = "";

include "bd.php";
include "classes/class_cliente.php";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT email FROM cliente WHERE email = '".$_POST["email"]."'";
$cadastrados = Cliente::__querySQL($sql, $conn);
if(count($cadastrados) >= 1){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "E-mail já cadastrado.";
    $conn->close();
    header("Location: registrar.php");
    exit();   
}

$sql = "SELECT email FROM cliente WHERE user = '".$_POST["user"]."'";
$cadastrados = Cliente::__querySQL($sql, $conn);
if(count($cadastrados) >= 1){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Username já em uso.";
    $conn->close();
    header("Location: registrar.php");
    exit();   
}

if($_POST["senha"] != $_POST["senha2"]){
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Senhas não conferem";
    $conn->close();
    header("Location: registrar.php");
    exit();
}

$cliente = new Cliente(NULL);
$cliente->setNome($_POST["nome"]);
$cliente->setUser($_POST["user"]);
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
    header("Location: registrar.php");
    exit();
}

$conn->close();
header("Location: index.php");
exit();


?>