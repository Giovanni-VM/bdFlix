    <?php class Midia{
        private $idMidia;
        private $duracao;
		private $titulo;
		private $tipo;

		private $url; //SÓ ESTA AQUI PARA SER USADA NA PARTE DE MOVIELIST, IGNOREM
		
        
    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Midia($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
		
        if($query = $con->query($sql)){
            return Midia::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idMidia = $tuple[0];
            $this->duracao = $tuple[1];
			$this->titulo = $tuple[2];
			$this->tipo = $tuple[3];
        } else {
            $this->idMidia = NULL;
        }
    }

	public function save($con){
        if($this->idMidia == NULL){
            $sql = "INSERT INTO midia VALUES (NULL,$this->duracao,'$this->titulo',$this->tipo)";
			
            $con->query($sql);
        } else {
            $sql = "UPDATE midia SET duracao=$this->duracao,titulo='$this->titulo' WHERE idMidia=$this->idMidia";
			
            $con->query($sql);
        }
    }

	public function remove($con){
		if($this->idMidia == NULL){
			return ;
		}
		$sql = "DELETE FROM midia WHERE idMidia = $this->idMidia";
		$con->query($sql);
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
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
		
	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}
};

?>