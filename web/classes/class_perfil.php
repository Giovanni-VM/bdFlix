<?php
class Perfil{
    private $idPerfil;
    private $idCliente;
    private $nome;
    private $senha;
    private $ftPerfil;
    private $idade;

    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Perfil($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $con->query($sql)){
            return Perfil::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idPerfil = $tuple[0];
            $this->idCliente = $tuple[1];
            $this->nome = $tuple[2];
            $this->senha = $tuple[3];
            $this->ftPerfil = $tuple[4];
            $this->idade = $tuple[5];
        } else {
            $this->idPerfil = NULL;
        }
    }

    public function save($con){
        if($this->idPerfil == NULL){
            $sql = "INSERT INTO perfil VALUES (NULL, '$this->idCliente', '$this->nome', '$this->senha', '$this->ftPerfil', $this->idade)";
            echo $sql;
            if($result = $con->query($sql)){
				$this->setIdCliente($con->insert_id);
				return TRUE;
			} else {
				return FALSE;
			}
        } else {
            $sql = "UPDATE perfil SET senha = '$this->senha', ftPerfil = '$this->ftPerfil', idade = $this->idade WHERE idPerfil = $this->idPerfil";
            if($result = $con->query($sql)){
				return TRUE;
			} else {
				return FALSE;
			}
        }
    }

    public function delete($con){
		if($this->idPerfil == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM perfil WHERE idPerfil = $this->idPerfil");
		return TRUE;
	}


    public function getIdPerfil(){
        return $this->idPerfil;
    }

    public function setIdPerfil($value){
        $this->idPerfil = $value;
    }

    public function getCliente(){
        return $this->idCliente;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getFtPerfil(){
        return $this->ftPerfil;
    }

    public function getIdade(){
        return $this->idade;
    }

    public function setIdCliente($value){
        $this->idCliente = $value;
    }

    public function setNome($value){
        $this->nome = $value;
    }

    public function setSenha($value){
        $this->senha = md5($value);
    }

    public function setFtPerfil($value){
        $this->ftPerfil = $value;
    }

    public function setIdade($value){
        $this->idade = $value;
    }
};
?>