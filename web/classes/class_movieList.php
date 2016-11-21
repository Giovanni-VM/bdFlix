<?php

class MovieList{
    private $idList;
    private $idCriador;
    private $nome;
    private $descricao;
    private $public;
    private $seguidores;

    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new MovieList($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            return MovieList::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idList = $tuple[0];
            $this->idCriador = $tuple[1];
            $this->nome = $tuple[2];
            $this->descricao = $tuple[3];
            $this->public = $tuple[4];
            $this->seguidores = $tuple[5];
        } else {
            $this->idList = NULL;
        }
    }

    public function save($con){
        if($this->idList == NULL){
            $sql = "INSERT INTO movielist VALUES (NULL, $this->idCriador, '$this->nome', '$this->descricao', $this->publica, $this->seguidores)";
            if($result = $con->query($sql)){
				$this->setIdList($con->insert_id);
				return TRUE;
			} else {
				return FALSE;
			}
        } else {
            $sql = "UPDATE movielist SET nome = '$this->nome', descricao = '$this->descricao', public = $this->public, seguidores = $this->seguidores";
            if($result = $con->query($sql)){
				return TRUE;
			} else {
				return FALSE;
			}
        }
    }

    public function delete($con){
		if($this->idList == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM movielist WHERE idList = $this->idList");
		return TRUE;
	}

    public function getIdList(){
		return $this->idList;
	}

	public function setIdList($idList){
		$this->idList = $idList;
	}

	public function getIdCriador(){
		return $this->idCriador;
	}

	public function setIdCriador($idCriador){
		$this->idCriador = $idCriador;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getPublic(){
		return $this->public;
	}

	public function setPublic($public){
		$this->public = $public;
	}

	public function getSeguidores(){
		return $this->seguidores;
	}

	public function setSeguidores($seguidores){
		$this->seguidores = $seguidores;
	}

	public function followPlus(){
		$this->seguidores++;
	}

	public function followMinus(){
		$this->seguidores--;
	}
};


?>