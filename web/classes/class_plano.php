    <?php class Plano{
        private $idPlano;
        private $nomePlano;
        private $qtdPerfis;
        private $valor;


    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Plano($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            $p = Plano::__generate($query);
            $query->close();
            return $p;
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idPlano = $tuple[0];
            $this->nomePlano = $tuple[1];
            $this->qtdPerfis = $tuple[2];
            $this->valor = $tuple[3];
        } else {
            $this->idPlano = NULL;
        }
    }

    public function save($con){
        if($this->idPlano == NULL){
            $sql = "INSERT INTO Plano VALUES (NULL, '$this->nomePlano', $this->qtdPerfis, $this->valor)";
            $con->query($sql);
			$q = $con->query("SELECT FROM Plano WHERE user = '$this->user'");
			$temp = $q->fetch_row();
			$this->setIdPlano($temp[0]);
        } else {
            $sql = "UPDATE Plano SET nomePlano = '$this->nomePlano', qtdPerfis = $this->qydPerfis, valor = $this->valor WHERE idPlano = $this->idPlano";
            $con->query($sql);
        }
    }

	public function remove($con){
		if($this->idPlano == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM plano WHERE idPlano = $this->idPlano");
		return TRUE;
	}

    public function getIdPlano(){
		return $this->idPlano;
	}

	public function setIdPlano($idPlano){
		$this->idPlano = $idPlano;
	}

	public function getNomePlano(){
		return $this->nomePlano;
	}

	public function setNomePlano($nomePlano){
		$this->nomePlano = $nomePlano;
	}

	public function getQtdPerfis(){
		return $this->qtdPerfis;
	}

	public function setQtdPerfis($qtdPerfis){
		$this->qtdPerfis = $qtdPerfis;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}


};

?>