    <?php class Filme{
        private $idMidia;
        private $faixa;
		private $trailer;
		private $pesquisas;
		private $timestamp;
		private $capa;
		private $descricao;
		public static $nAtr = 6;


    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Filme($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){

        if($query = $con->query($sql)){
            $p = Filme::__generate($query);
			$query->close();
			return $p;
        } else {
            return NULL;
        }
    }

	public function convertArray(){
		$array = [
			"Id Midia" => $this->idMidia,
			"Faixa" => $this->faixa,
			"Trailer" => $this->trailer,
			"Pesquisas" => $this->pesquisas,
			"Ultima alt" => $this->timestamp,
			"Capa" => $this->capa
		];

		return $array;
	}

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->faixa = $tuple[1];
			$this->pesquisas = $tuple[2];
			$this->timestamp = $tuple[3];
			$this->capa = $tuple[4];
			$this->descricao = $tuple[5];
        } else {
            $this->idMidia = NULL;
        }
    }


	public function save($con){
        $sql = "INSERT INTO filme(idMidia, faixa, pesquisas, capa,descricao, contador) ";
		$sql .= "VALUES ($this->idMidia,$this->faixa,$this->pesquisas,'$this->capa','$this->descricao', 0)";

		$con->query($sql);
    }

	public function edit($con){
        $sql = "UPDATE filme SET faixa=$this->faixa,capa='$this->capa',descricao='$this->descricao' WHERE  idMidia=$this->idMidia";

		$con->query($sql);
    }

	public function remove($con){
		if($this->idMidia == NULL){
			return ;
		}
		$sql = "DELETE FROM filme WHERE idMidia = $this->idMidia";
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

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

};

?>
