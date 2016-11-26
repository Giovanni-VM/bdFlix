    <?php class Episodio{
		private $idSerie;
        private $idMidia;
        private $temporada;
		private $episodio;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Episodio($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,$con){
		
        if($query = $con->query($sql)){
            return Episodios::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
			$this->idSerie = $tuple[0];
            $this->idMidia = $tuple[1];
			$this->temporada = $tuple[2];
			$this->episodio = $tuple[3];
        } else {
            $this->idSerie = NULL;
			$this->idMidia = NULL;
        }
    }

	public function save($con){
        $sql = "INSERT INTO episodio(idSerie, idMidia, temporada, episodio) VALUES ($this->idSerie,$this->idMidia,$this->temporada,$this->episodio)";
		
		$con->query($sql);
    }
	
	public function edit($con){
        $sql = "UPDATE episodio SET temporada=$this->temporada,`episodio` = $this->episodio WHERE idMidia = $this->idMidia";
        
		$con->query($sql);
    }

	public function remove($con){
		if($this->idMidia == NULL){
			return ;
		}
		$sql = "DELETE FROM episodio WHERE idMidia = $this->idMidia";
		$con->query($sql);
	}
	
    public function getIdMidia(){
		return $this->idMidia;
	}

	public function setIdMidia($idMidia){
		$this->idMidia = $idMidia;
	}
	
	 public function getIdSerie(){
		return $this->idSerie;
	}

	public function setIdSerie($idSerie){
		$this->idSerie = $idSerie;
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
	
};

?>