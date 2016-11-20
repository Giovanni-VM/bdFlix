<?php
require_once ("classes/class_genero.php");
include "bd.php";
session_start(); 
			

class genero_view {
    
	static $con = new mysqli($host, $username, $password, $dbname);
	public function __construct() {
        if(isset($_GET["acao"])) {
            $acao = $_GET["acao"];
            switch ($acao) {
                case "salvar":
                    $this->salvar($con);
                    break;
                case "excluir":
                    $id = $_GET["idCliente"];               
                    $this->excluir($id);
                    break;

            }
        }
    }
	
    public function salvar($con) {
        $objeto = new Genero(NULL);
        $objeto->setNome($_POST["nome"]);
		$objeto->save($con);
    }
    
    public function excluir($id) {
        $teste = $this->controle->excluir($id);
        if($teste == 1) {
            echo "<script>alert('Registro excluido com sucesso!');document.location='CadastrarClienteListar.php'</script>";
        } else {
            echo "<script>alert('Erro ao excluir registro!');history.back()</script>";
        }
    }
}
new genero_view();
?>
