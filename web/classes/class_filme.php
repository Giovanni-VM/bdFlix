    <?php class Filme{
        private $idMidia;
        private $faixa;
		private $trailer;
		private $pesquisas;
		private $timestamp;
		private $capa;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Filme($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Filme::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->faixa = $tuple[1];
			$this->trailer = $tuple[2];
			$this->pesquisas = $tuple[3];
			$this->timestamp = $tuple[4];
			$this->capa = $tuple[5];
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
		return $this->Trailer;
	}

	public function setTrailer($trailer){
		$this->trailer = $trailer;
	}
		
	public function getPesquisas(){
		return $this->pesquisas;
	}

	public function setPesquisas($pesquisas){
		$this->pesquisas = $pesquisas;
	}
	
	public function getTimestamp(){
		return $this->timestamp;
	}

	public function setTimestamp($timestamp){
		$this->timestamp = $timestamp;
	}
	
	public function getCapa(){
		return $this->capa;
	}

	public function setCapa($capa){
		$this->capa = $capa;
	}
};

?>