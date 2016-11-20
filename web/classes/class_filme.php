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

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            return Filme::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
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
	
	
	public function save($con){
        $sql = "INSERT INTO filme(idMidia, faixa, trailer, pesquisas, capa) ";
		$sql .= "VALUES ($this->idMidia,$this->faixa,'$this->trailer',$this->pesquisas,'$this->capa')";
		$con->query($sql);
    }
	
	public function edit($con){
        $sql = "UPDATE filme SET faixa=$this->faixa,trailer='$this->trailer', capa='$this->capa' WHERE  idMidia=$this->idMidia";
        $con->query($sql);
    }

	public function remove($con){
		if($this->idMidia == NULL){
			return ;
		}
		$sql = "DELETE FROM filme WHERE idMidia = $this->idMidia";
		echo $sql;
		$con->query($sql);
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