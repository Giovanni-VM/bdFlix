<?php
class PCMidiaFilme{
	private $idMidia;
    private $faixa;
	private $trailer;
	private $duracao;
	private $titulo;
	
	public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new PCMidiaFilme($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,  $con){
        if($query = $con->query($sql)){
            return PCMidiaFilme::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->faixa = $tuple[1];
			$this->trailer = $tuple[2];
			$this->duracao = $tuple[3];
			$this->titulo = $tuple[4];
        } else {
            $this->idMidia = NULL;
        }
    }
	
	public function getIdMidia(){
		return $this->idMidia;
	}

	public function setIdMidia($idMidia){
		$this->idMidia = $idMidia;
	}

	public function getFaixa(){
		return $this->faixa;
	}

	public function setFaixa($faixa){
		$this->faixa = $faixa;
	}
	
	public function getTrailer(){
		return $this->trailer;
	}

	public function setTrailer($trailer){
		$this->trailer = $trailer;
	}
	
	public function getDuracao(){
		return $this->duracao;
	}

	public function setDuracao($duracao){
		$this->duracao = $duracao;
	}
	
	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
};
?>