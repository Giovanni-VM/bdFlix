<?php

class Fatura{
	private $nFat;
	private $dataIni;
	private $dataFim;
	private $paga;
	private $valor;
	private $idCliente;
	
	public static $nAtr = 6;
	
	
	public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Fatura($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
		
        if($query = $con->query($sql)){
            $p = Fatura::__generate($query);
            $query->close();
            return $p;
        } else {
            return NULL;
        }
    }
	
	public function convertArray(){
		$array = [
			"Id Fatura" => $this->nFat,
			"Data Inicio" => $this->dataIni,
			"Data Fim" => $this->dataFim,
			"Paga" => $this->paga,
			"Valor" => $this->valor,
			"Id Cliente" => $this->idCliente
		];
		
		return $array;
	}

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->nFat = $tuple[0];
            $this->dataIni = $tuple[1];
            $this->dataFim = $tuple[2];
            $this->paga = $tuple[3];
            $this->valor = $tuple[4];
            $this->idCliente = $tuple[5];
        } else {
            $this->nFat = NULL;
        }
    }

    public function save($con){
        if($this->nFat == NULL){
            $sql = "INSERT INTO fatura VALUES (NULL, '$this->dataIni', '$this->dataFim', '$this->paga', $this->valor, $this->idCliente)"; 
			if($result = $con->query($sql)){
				return TRUE;
			} else {
				return FALSE;
			}
        } else {
            $sql = "UPDATE fatura SET dataIni = '$this->dataIni', dataFim = '$this->dataFim', paga = '$this->paga', valor = $this->valor, idCliente = $this->idCliente WHERE nFat = $this->nFat";
			if($result = $con->query($sql)){
				return TRUE;
			} else {
				return FALSE;
			}
        }
    }

	public function delete($con){
		if($this->nFat == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM fatura WHERE nFat = $this->nFat");
		return TRUE;
	}
	
	
	
	
	public function getNFat(){
		return $this->nFat;
	}

	public function setNFat($nFat){
		$this->nFat = $nFat;
	}

	public function getDataIni(){
		return $this->dataIni;
	}

	public function setDataIni($dataIni){
		$this->dataIni = $dataIni;
	}

	public function getDataFim(){
		return $this->dataFim;
	}

	public function setDataFim($dataFim){
		$this->dataFim = $dataFim;
	}

	public function getPaga(){
		return $this->paga;
	}

	public function setPaga($paga){
		$this->paga = $paga;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}
};

?>