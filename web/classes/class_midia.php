    <?php class Midia{
        private $idMidia;
        private $duracao;
		private $titulo;
		private $tipo;
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Midia($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Midia::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->duracao = $tuple[1];
			$this->titulo = $tuple[2];
			$this->tipo = $tuple[3];
        } else {
            $this->idMidia = NULL;
        }
    }

    public function getIdMidia(){
		return $this->idMidia;
	}

	public function setIdMidia($idMidia){
		$this->idMidia = $idMidia;
	}

	public function getDuracao(){
		return $this->duracao;
	}

	public function setDuracao($duracao){
		$this->duracao = $duracao;
	}
	
	public function getTitulo(){
		return $this->Titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
		
	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($duracao){
		$this->tipo = $tipo;
	}
};

?>