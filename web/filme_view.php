<?php
session_start();
include "bd.php";
include "classes/class_genero.php";
$conn = new mysqli($host, $username, $password, $dbname);
$acao = $_GET["acao"];
if ($acao == "inserir") {
	if (!isset($_POST["idGenero"])) {
		$genero = new Genero(NULL);
		$genero->setNome($_POST["nome"]);
		$genero->save($conn);
		$conn->close();
		header("Location: admin_insere_genero.php");
		exit();
	} else if (isset($_POST["idGenero"])){
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
