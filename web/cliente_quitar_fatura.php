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
include "classes/class_fatura.php";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

$sql = "SELECT * FROM cliente WHERE user = '$cli'";

$res = $conn->query($sql);

$p = Cliente::__generate($res);

$cliente = $p[0];

$res->close();

$fat = $_GET["nFat"];

$sql = "SELECT * FROM fatura WHERE nFat = $fat";
$ff = Fatura::__querySQL($sql, $conn);
$fatura = $ff[0];

if($fatura->getPaga() == 0){
    //PAGA FATURA
    $fatura->setPaga(1);
    $fatura->save($conn);
}
$conn->close();

header("Location: cliente_lista_fatura.php");
?>