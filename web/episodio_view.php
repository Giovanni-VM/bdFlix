<?php
session_start();
include "bd.php";
include "classes/class_midia.php";
include "classes/class_episodio.php";
include "classes/class_serie.php";
$conn = new mysqli($host, $username, $password, $dbname);
$acao = $_GET["acao"];
if ($acao == "inserir") {
	if ($_POST["idMidia"] == 0) {
		$midia = new Midia(NULL);
		$episodio = new Episodio(NULL);
		$midia->setTitulo($_POST["titulo"]);
		$midia->setDuracao($_POST["duracao"]);
		$midia->setTipo(1);
		$midia->save($conn);
		$midia->setIdMidia($conn->insert_id);
		$episodio->setIdMidia($midia->getIdMidia());
		$episodio->setIdSerie($_POST["idSerie"]);
		$episodio->setTemporada($_POST["temporada"]);
		$episodio->setEpisodio($_POST["episodio"]);
		$episodio->save($conn);
		$conn->close();
		header("Location: admin_insere_episodio.php?idSerie=".$_POST["idSerie"]);
		exit();
	} else if ($_POST["idMidia"] != NULL){
		$midia = new Midia(NULL);
		$episodio = new Episodio(NULL);
		$midia->setIdMidia($_POST["idMidia"]);		
		$episodio->setIdMidia($midia->getIdMidia());
		$midia->setTitulo($_POST["titulo"]);
		$midia->setDuracao($_POST["duracao"]);
		$episodio->setIdSerie($_POST["idSerie"]);
		$episodio->setTemporada($_POST["temporada"]);
		$episodio->setEpisodio($_POST["episodio"]);
		$midia->save($conn);
		$episodio->edit($conn);
		$conn->close();
		header("Location: admin_insere_episodio.php?idSerie=".$_POST["idSerie"]);
		exit();
	}
} else if($acao == "excluir") {
	$midia = new Midia(NULL);
	$episodio = new Episodio(NULL);
	$midia->setIdMidia($_GET["idMidia"]);			
	$episodio->setIdMidia($midia->getIdMidia());
	$episodio->remove($conn);
	$midia->remove($conn);
	$conn->close();
	header("Location: admin_insere_episodio.php?idSerie=".$_GET["idSerie"]);
	exit();
} 
?>
