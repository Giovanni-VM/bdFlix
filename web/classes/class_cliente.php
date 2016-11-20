    <?php class Cliente{
        private $idCliente;
        private $user;
        private $nome;
        private $cpf;
        private $email;
        private $senha;
        private $nCartao;
        private $codCartao;
        private $valCartao;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $numero;
        private $complemento;
        private $idPlano;

    public static function __generate(MySQLi_Result $query){
        $objetos = [];
        while($res = $query->fetch_row()){
            $objetos[] = new Cliente($res);
        }
        return $objetos;
    }

    public static function __querySQL($sql, $con){
        if($query = $mysqli->query($sql)){
            $p = Cliente::__generate($query);
            $query->close();
            return $p;
        } else {
            return NULL;
        }
    }

    public function __construct($tuple){
        if(!empty($tuple)){
            $this->idCliente = $tuple[0];
            $this->user = $tuple[1];
            $this->nome = $tuple[2];
            $this->cpf = $tuple[3];
            $this->email = $tuple[4];
            $this->senha = $tuple[5];
            $this->nCartao = $tuple[6];
            $this->codCartao = $tuple[7];
            $this->valCartao = $tuple[8];
            $this->estado = $tuple[9];
            $this->cidade = $tuple[10];
            $this->bairro = $tuple[11];
            $this->rua = $tuple[12];
            $this->numero = $tuple[13];
            $this->complemento = $tuple[14];
            $this->idPlano = $tuple[15];
        } else {
            $this->idCliente = NULL;
        }
    }

    public function save($con){
        if($this->idCliente == NULL){
            $sql = "INSERT INTO cliente VALUES (NULL, '$this->user', '$this->nome', $this->cpf, '$this->email', '$this->senha', '$this->nCartao',";
            $sql .= "$this->codCartao, '$this->valCartao', '$this->estado', '$this->cidade', '$this->bairro', '$this->rua', $this->numero,";
            $sql .= "'$this->complemento', $this->idPlano)";
            if($result = $con->query($sql)){
				$q = $con->query("SELECT * FROM cliente WHERE user = '$this->user'");
				$temp = $q->fetch_row();
				$this->setIdCliente($temp[0]);
				return TRUE;
			} else {
				return FALSE;
			}
        } else {
            $sql = "UPDATE cliente SET nome = '$this->nome', cpf = $this->cpf, email = '$this->email', senha = '$this->senha', nCartao = '$this->nCartao',";
            $sql .= " codCartao = $this->codCartao, valCartao = '$this->valCartao', estado = '$this->estado', cidade = '$this->cidade', bairro = '$this->bairro', rua = '$this->rua', numero = $this->numero,";
            $sql .= "complemento = '$this->complemento', idPlano = $this->idPlano WHERE idCliente = $this->idCliente";
            if($result = $con->query($sql)){
				return TRUE;
			} else {
				return FALSE;
			}
        }
    }

	public function remove($con){
		if($this->idCliente == NULL){
			return FALSE;
		}
		$con->query("DELETE FROM cliente WHERE idCliente = $this->idCliente");
		return TRUE;
	}

    public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = md5($senha);
	}

	public function getNCartao(){
		return $this->nCartao;
	}

	public function setNCartao($nCartao){
		$this->nCartao = $nCartao;
	}

	public function getCodCartao(){
		return $this->codCartao;
	}

	public function setCodCartao($codCartao){
		$this->codCartao = $codCartao;
	}

	public function getValCartao(){
		return $this->valCartao;
	}

	public function setValCartao($valCartao){
		$this->valCartao = $valCartao;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getRua(){
		return $this->rua;
	}

	public function setRua($rua){
		$this->rua = $rua;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getComplemento(){
		return $this->complemento;
	}

	public function setComplemento($complemento){
		$this->complemento = $complemento;
	}

	public function getIdPlano(){
		return $this->idPlano;
	}

	public function setIdPlano($idPlano){
		$this->idPlano = $idPlano;
	}



};

?>