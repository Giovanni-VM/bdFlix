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
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$cliente->setNome($_POST["nome"]);
$cliente->setCpf($_POST["cpf"]);
$cliente->setCodCartao($_POST["codCartao"]);
$cliente->setNumero($_POST["numero"]);



$cliente->save($conn);

$conn->close();


?>