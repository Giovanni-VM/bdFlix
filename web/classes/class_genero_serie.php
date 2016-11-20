    <?php class GeneroSerie{
        private $idSerie;
        private $idGenero;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new GeneroSerie($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,$con){
        if($query = $con->query($sql)){
            return GeneroSerie::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->idSerie = $tuple[1];
        } else {
            $this->idGenero = NULL;
			$this->idSerie = NULL;
        }
    }
	
	public function save($con){
        $sql = "INSERT INTO generoserie VALUES($this->idGenero, $this->idSerie)";
		echo $sql;
		$con->query($sql);
    }

	public function remove($con){
		if($this->idSerie == NULL){
			return ;
		}
		$sql = "DELETE FROM generoserie WHERE idSerie = $this->idSerie AND idGenero = $this->idGenero";
		$con->query($sql);
		echo $sql;
	}

    public function getIdSerie(){
		return $this->idSerie;
	}

	public function setIdSerie($idSerie){
		$this->idSerie = $idSerie;
	}
	
	public function getIdGenero(){
		return $this->idGenero;
	}

	public function setIdGenero($idGenero){
		$this->idGenero = $idGenero;
	}

	
};

?>