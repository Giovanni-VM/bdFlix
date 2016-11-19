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
            $objetos[] = new Cliente($res);
        }
        return $objetos;
    }

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Perfil::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idPerfil = $tuple["idPerfil"];
            $this->idCliente = $tuple["idCliente"];
            $this->nome = $tuple["nome"];
            $this->senha = $tuple["senha"];
            $this->ftPerfil = $tuple["ftPerfil"];
            $this->idade = $tuple["idade"];
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