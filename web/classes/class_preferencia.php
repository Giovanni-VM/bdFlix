<?php
class Preferencia{
    private $idGenero;
    private $idPerfil;

    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Preferencia($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            $p = Preferencia::__generate($query);
            $query->close();
            return $p;
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idGenero = $tuple[0];
            $this->idPerfil = $tuple[1];
        } else {
            $this->idGenero = NULL;
            $this->idPerfil = NULL;
        }
    }

    public function save($con){
        $sql = "INSERT INTO preferencia VALUES ($this->idGenero, $this->idPerfil)";
        if($con->query($sql)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

	public function remove($con){
		if($this->idGenero == NULL or $this->idPerfil == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM preferencia WHERE idGenero = $this->idGenero AND idPerfil = $this->idPerfil");
		return TRUE;
	}

    public function getIdPerfil(){
		return $this->idPerfil;
	}

	public function setIdPerfil($idPerfil){
		$this->idPerfil= $idPerfil;
	}

	public function getIdGenero(){
		return $this->idGenero;
	}

	public function setIdGenero($idGenero){
		$this->idGenero = $idGenero;
	}
};

?>