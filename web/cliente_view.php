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
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

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
$idCli = $cliente->getIdCliente();
$sql = "SELECT COUNT(*) FROM perfil WHERE idCliente = $idCli";
$res = $conn->query($sql);
$aux = $res->fetch_row();
$qtdAtual = $aux[0];

$sql = "SELECT * FROM plano WHERE idPLano = ".$_POST["idPlano"]."";
$pp = Plano::__querySQL($sql, $conn);
$plano = $pp[0];

if($qtdAtual > $plano->getQtdPerfis()){
    $dif = $qtdAtual - $plano->getQtdPerfis();
    $_SESSION["error_form_cli"] = true;
    $_SESSION["err_cli"] = "Você possui mais perfis do que o plano selecionado permite. Por favor, delete $dif perfis antes de reduzir seu plano.";
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