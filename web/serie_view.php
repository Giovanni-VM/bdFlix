<?php
session_start();
include "bd.php";
include "classes/class_serie.php";
include "classes/class_episodio.php";
include "classes/class_genero.php";
include "classes/class_genero_serie.php";
$conn = new mysqli($host, $username, $password, $dbname);
$acao = $_GET["acao"];
if ($acao == "inserir") {
	if ($_POST["idSerie"] == NULL) {
		$serie = new Serie(NULL);
		$gf = new GeneroSerie(NULL);
		$serie->setNome($_POST["nome"]);
		$serie->setCapa($_POST["capa"]);
		$serie->setFaixa($_POST["faixa"]);
		$serie->setTrailer($_POST["trailer"]);
		$serie->save($conn);
		$serie->setIdSerie($conn->insert_id);
		$sqlG = "SELECT * FROM genero ORDER BY nome";
		$generos = Genero::__querySQL($sqlG, $conn);
		foreach($generos as $objeto) {
			$gf->setIdGenero($objeto->getIdGenero());
			$gf->setIdSerie($serie->getIdSerie());
			if (isset($_POST["". $objeto->getIdGenero() .""])) {
				$gf->save($conn);
			} else {
				$gf->remove($conn);
			}
		}
		$conn->close();
		// header("Location: admin_insere_serie.php");
		// exit();
	} else if ($_POST["idSerie"] != NULL){
		$serie = new Serie(NULL);
		$gf = new GeneroSerie(NULL);
		$serie->setIdSerie($_POST["idSerie"]);	
		$serie->setNome($_POST["nome"]);
		$serie->setCapa($_POST["capa"]);
		$serie->setFaixa($_POST["faixa"]);
		$serie->setTrailer($_POST["trailer"]);
		$serie->save($conn);
		$sqlG = "SELECT * FROM genero ORDER BY nome";
		$generos = Genero::__querySQL($sqlG, $conn);
		foreach($generos as $objeto) {
			$gf->setIdGenero($objeto->getIdGenero());
			$gf->setIdSerie($serie->getIdSerie());
			if ($_POST["". $objeto->getIdGenero() .""] == 'on') {
				$gf->save($conn);
			} else {
				$gf->remove($conn);
			}
		}
		$conn->close();
		header("Location: admin_insere_serie.php");
		exit();
	}
} else if($acao == "excluir") {
	$serie = new Serie(NULL);
	$gf = new GeneroSerie(NULL);
	$serie->setIdSerie($_GET["idSerie"]);		
	$sqlG = "SELECT * FROM genero ORDER BY nome";
	$generos = Genero::__querySQL($sqlG, $conn);
	foreach($generos as $objeto) {
		$gf->setIdGenero($objeto->getIdGenero());
		$gf->setIdSerie($serie->getIdSerie());
		if ($_POST["". $objeto->getIdGenero() .""] != 'on') {
			$gf->remove($conn);
		}
	}
	$serie->remove($conn);
	$conn->close();
	// header("Location: admin_insere_serie.php");
	// exit();
} 
?>
