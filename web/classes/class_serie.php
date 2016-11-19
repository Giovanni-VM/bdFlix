    <?php class Serie{
        private $idSerie;
		private $pesquisas;
        private $faixa;
		private $nome
		private $timestamp;
		private $capa;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Serie($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Serie::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idSerie = $tuple[0];
			$this->pesquisas = $tuple[1];
            $this->faixa = $tuple[2];
			$this->nome = $tuple[3];
			$this->timestamp = $tuple[4];
			$this->capa = $tuple[5];
        } else {
            $this->idSerie = NULL;
        }
    }

    public function getIdSerie(){
		return $this->idMidia;
	}

	public function setIdSerie($idSerie){
		$this->idSerie = $idSerie;
	}

	public function getFaixa(){
		return $this->faixa;
	}

	public function setFaixa($faixa){
		$this->faixa = $faixa;
	}
	
	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
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