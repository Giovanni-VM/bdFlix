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

    public function getPerfil(){
        return $this->idPerfil;
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

    public function getFoto(){
        return $this->ftPerfil;
    }

    public function getIdade(){
        return $this->idade;
    }

    public function setCliente($value){
        $this->idCliente = $value;
    }

    public function setNome($value){
        $this->nome = $value;
    }

    public function setSenha($value){
        $this->senha = md5($value);
    }

    public function setFoto($value){
        $this->ftPerfil = $value;
    }

    public function setIdade($value){
        $this->idade = $value;
    }
};
?>