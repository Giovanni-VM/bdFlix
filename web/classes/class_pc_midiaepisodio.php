<?php
class PCMidiaEpisodio{
	private $idMidia;
	private $temporada;
	private $episodio;
	private $capa;
	private $duracao;
	private $titulo;
	private $idSerie;
	
	public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new PCMidiaEpisodio($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,  $con){
        if($query = $con->query($sql)){
            return PCMidiaEpisodio::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->temporada = $tuple[1];
			$this->episodio = $tuple[2];
			$this->duracao = $tuple[3];
			$this->titulo = $tuple[4];
            $this->idSerie = $tuple[5];
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

	public function getTemporada(){
		return $this->temporada;
	}

	public function setTemporada($temporada){
		$this->temporada = $temporada;
	}
	
	public function getEpisodio(){
		return $this->episodio;
	}

	public function setEpisodio($episodio){
		$this->episodio = $episodio;
	}
	
	public function getCapa(){
		return $this->capa;
	}

	public function setCapa($capa){
		$this->capa = $capa;
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
	
	public function getIdSerie(){
		return $this->idSerie;
	}

	public function setIdSerie($idSerie){
		$this->idSerie = $idSerie;
	}
	
};
?>