    <?php class Serie{
        private $idSerie;
		private $pesquisas;
        private $faixa;
		private $nome;
		private $timestamp;
		private $capa;
		private $trailer;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Serie($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,$con){
		
        if($query = $con->query($sql)){
            return Serie::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idSerie = $tuple[0];
			$this->pesquisas = $tuple[1];
            $this->faixa = $tuple[2];
			$this->nome = $tuple[3];
			$this->timestamp = $tuple[4];
			$this->capa = $tuple[5];
			$this->trailer = $tuple[6];
        } else {
            $this->idSerie = NULL;
        }
    }
	
	public function save($con){
        if($this->idSerie == NULL){
            $sql = "INSERT INTO serie(faixa, nome,capa,trailer) VALUES ($this->faixa,'$this->nome','$this->capa','$this->trailer');";
            
			$con->query($sql);
        } else {
            $sql = "UPDATE serie SET faixa= $this->faixa, nome='$this->nome', capa = '$this->capa', trailer = '$this->trailer' WHERE idSerie = $this->idSerie";
            
			$con->query($sql);
        }
    }

	public function remove($con){
		if($this->idSerie == NULL){
			return ;
		}
		$sql = "DELETE FROM serie WHERE idSerie = $this->idSerie";
		$con->query($sql);
	}

    public function getIdSerie(){
		return $this->idSerie;
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
	
	public function getTrailer(){
		return $this->trailer;
	}

	public function setTrailer($trailer){
		$this->trailer = $trailer;
	}
	
};

?>