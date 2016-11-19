    <?php class Descricao{
		private $id;
        private $idIdioma;
        private $descricao;
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Descricao($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Descricao::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
			$this->id = $tuple[0];
            $this->idIdioma = $tuple[1];
			$this->descricao = $tuple[2];
        } else {
            $this->id = NULL;
        }
    }

    public function getId(){
		return $this->id;
	}

	public function setId($idMidia){
		$this->id = $id;
	}
	
	 public function getIdIdioma(){
		return $this->idIdioma;
	}

	public function setIdIdioma($idIdioma){
		$this->idIdioma = $idIdioma;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
};

?>