<?php
session_start(); 

if(!isset($_SESSION["adm_logado"]) or !$_SESSION["adm_logado"]){
	header("Location: admin_login.php");
	exit();
}

include "bd.php";
include "classes/class_fatura.php";
include "classes/class_cliente.php";
include "classes/class_plano.php";

$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM cliente";

$clientes = Cliente::__querySQL($sql, $conn);

$sql = "SELECT * FROM plano";

$pp = Plano::__querySQL($sql, $conn);

$planos = [];

foreach($pp as $pla){
    $id = $pla->getIdPlano();
    $valor = $pla->getValor();
    $planos[$id] = $valor;
}

foreach($clientes as $cli){
    $pla = $cli->getIdPlano();
    $id = $cli->getIdCliente();
    $fatura = new Fatura(NULL);
    $fatura->setDataIni(date("Y-m-d"));
    $fatura->setDataFim(date("Y-m-d", strtotime("+1 month")));
    $fatura->setPaga(0);
    $fatura->setValor($planos[$pla]);
    $fatura->setIdCliente($id);
    $fatura->save($conn);
}

$conn->close();

header("Location: admin_cadastros.php");
?>