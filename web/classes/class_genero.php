    <?php class Genero{
        private $idGenero;
        private $nome;
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Genero($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            return Genero::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->nome = $tuple[1];
        } else {
            $this->idGenero = NULL;
        }
    }
	
	public function save($con){
        if($this->idGenero == NULL){
            $sql = "INSERT INTO genero VALUES (NULL, '$this->nome');";
            $con->query($sql);
        } else {
            $sql = "UPDATE genero SET nome = '$this->nome' WHERE idGenero = $this->idGenero";
            $con->query($sql);
        }
    }

	public function remove($con){
		if($this->idGenero == NULL){
			return ;
		}
		$sql = "DELETE FROM genero WHERE idGenero = $this->idGenero";
		$con->query($sql);
	}
	
    public function getIdGenero(){
		return $this->idGenero;
	}

	public function setIdGenero($idGenero){
		$this->idGenero = $idGenero;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
};

?>