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

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return GeneroSerie::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->idSerie = $tuple[1];
        } else {
            $this->idGenero = NULL;
			$this->idSerie = NULL;
        }
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