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

    public static function __querySQL(string $sql, mysqli $con){
        if($query = $mysqli->query($sql)){
            return Cliente::__generate($query);
        } else {
            return NULL;
        }
    }

    public function __construct(array $tuple){
        if(!empty($tuple)){
            $this->idCliente = $tuple["idCliente"];
            $this->user = $tuple["user"];
            $this->nome = $tuple["nome"];
            $this->cpf = $tuple["cpf"];
            $this->email = $tuple["email"];
            $this->senha = $tuple["senha"];
            $this->nCartao = $tuple["nCartao"];
            $this->codCartao = $tuple["codCartao"];
            $this->valCartao = $tuple["valCartao"];
            $this->estado = $tuple["estado"];
            $this->cidade = $tuple["cidade"];
            $this->bairro = $tuple["bairro"];
            $this->rua = $tuple["rua"];
            $this->numero = $tuple["numero"];
            $this->complemento = $tuple["complemento"];
            $this->idPlano = $tuple["idPlano"];
        } else {
            $this->idCliente = NULL;
        }
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
		$this->senha = $senha;
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