    <?php class GeneroFilme{
        private $idMidia;
        private $idGenero;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new GeneroFilme($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql,$con){
        if($query = $con->query($sql)){
            return GeneroFilme::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->idMidia = $tuple[1];
        } else {
            $this->idGenero = NULL;
			$this->idMidia = NULL;
        }
    }
	
	public function save($con){
        $sql = "INSERT INTO generofilme VALUES($this->idGenero, $this->idMidia)";
		echo $sql;
		$con->query($sql);
    }

	public function remove($con){
		if($this->idMidia == NULL){
			return ;
		}
		$sql = "DELETE FROM generofilme WHERE idFilme = $this->idMidia AND idGenero = $this->idGenero";
		$con->query($sql);
		echo $sql;
	}
	
    public function getIdMidia(){
		return $this->idMidia;
	}

	public function setIdMidia($idMidia){
		$this->idMidia = $idMidia;
	}
	
	public function getIdGenero(){
		return $this->idGenero;
	}

	public function setIdGenero($idGenero){
		$this->idGenero = $idGenero;
	}

	
};

?>