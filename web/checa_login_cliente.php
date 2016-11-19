<?php

session_start();

include 'bd.php';
include 'valida_campos.php';

$_SESSION['cli_logado'] = false; //Verifica se esta logado como cliente
$_SESSION['login_fail'] = true;

$user = $_POST["user"];
$pass = $_POST["passwd"];

if(valida_login($user) and valida_senha($pass)){
    $conn = new mysqli($host, $username, $password, $dbname);

    $passwd = md5($pass);

    if($query = $conn->query("SELECT * FROM cliente WHERE user = '$user' AND senha = '$passwd'")){

        if($query->num_rows == 1){
            $res = $query->fetch_assoc();
            $_SESSION['cli_logado'] = true;
            $_SESSION['cliente'] = $res["nome"];
            $_SESSION['login_fail'] = false;
        }

        $query->close();
    }
}

$conn->close();

if($_SESSION["cli_logado"]){
    header("Location: home_cliente.php");
} else {
   header("Location: index.php");
}



?>