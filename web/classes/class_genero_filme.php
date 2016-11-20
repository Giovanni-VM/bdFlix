    <?php class GeneroFilme{
        private $idFilme;
        private $idGenero;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new GeneroFilme($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return GeneroFilme::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->idFilme = $tuple[1];
        } else {
            $this->idGenero = NULL;
			$this->idFilme = NULL;
        }
    }

    public function getIdFilme(){
		return $this->idFilme;
	}

	public function setIdFilme($idFilme){
		$this->idFilme = $idFilme;
	}
	
	public function getIdGenero(){
		return $this->idGenero;
	}

	public function setIdGenero($idGenero){
		$this->idGenero = $idGenero;
	}

	
};

?>