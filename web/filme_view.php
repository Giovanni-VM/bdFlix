<?php
session_start();
include "bd.php";
include "classes/class_midia.php";
include "classes/class_filme.php";
$conn = new mysqli($host, $username, $password, $dbname);
$acao = $_GET["acao"];
if ($acao == "inserir") {
	if ($_POST["idMidia"] == NULL) {
		$midia = new Midia(NULL);
		$filme = new Filme(NULL);
		$midia->setTitulo($_POST["titulo"]);
		$midia->setDuracao($_POST["duracao"]);
		$midia->setTipo(0);
		$midia->save($conn);
		$midia->setIdMidia($conn->insert_id);
		$filme->setIdMidia($midia->getIdMidia());
		$filme->setFaixa($_POST["faixa"]);
		$filme->setTrailer($_POST["trailer"]);
		$filme->setCapa($_POST["capa"]);
		$filme->setPesquisas(0);
		$filme->save($conn);
		$conn->close();
		header("Location: admin_insere_filme.php");
		exit();
	} else if ($_POST["idMidia"] != NULL){
		$midia = new Midia(NULL);
		$filme = new Filme(NULL);
		$midia->setIdMidia($_POST["idMidia"]);		
		$filme->setIdMidia($midia->getIdMidia());
		$midia->setTitulo($_POST["titulo"]);
		$midia->setDuracao($_POST["duracao"]);
		$filme->setFaixa($_POST["faixa"]);
		$filme->setTrailer($_POST["trailer"]);
		$filme->setCapa($_POST["capa"]);
		$midia->save($conn);
		$filme->edit($conn);
		$conn->close();
		header("Location: admin_insere_filme.php");
		exit();
	}
} else if($acao == "excluir") {
	$midia = new Midia(NULL);
	$filme = new Filme(NULL);
	$midia->setIdMidia($_GET["idMidia"]);			
	$filme->setIdMidia($midia->getIdMidia());
	$filme->remove($conn);
	$midia->remove($conn);
	$conn->close();
	header("Location: admin_insere_filme.php");
	exit();
} 
?>
