<?php
session_start();
include "bd.php";
include "classes/class_genero.php";
$conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");
$acao = $_GET["acao"];
if ($acao == "inserir") {
	if ($_POST["idGenero"] == NULL) {
		$genero = new Genero(NULL);
		$genero->setNome($_POST["nome"]);
		$genero->save($conn);
		$conn->close();
		header("Location: admin_insere_genero.php");
		exit();
	} else if ($_POST["idGenero"] != NULL){
		$genero = new Genero(NULL);
		$genero->setIdGenero($_POST["idGenero"]);
		$genero->setNome($_POST["nome"]);
		$genero->save($conn);
		$conn->close();
		header("Location: admin_insere_genero.php");
		exit();
	}
} else if($acao = "excluir") {
	$genero = new Genero(NULL);
	$genero->setIdGenero($_GET["idGenero"]);
	$genero->remove($conn);
	$conn->close();
	header("Location: admin_insere_genero.php");
	exit();
} 
?>
