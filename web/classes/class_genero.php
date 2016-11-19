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

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->nome = $tuple[1];
        } else {
            $this->idGenero = NULL;
        }
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