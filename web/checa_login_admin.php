<?php

session_start();

include 'bd.php';
include 'valida_campos.php';

$_SESSION['adm_logado'] = false; //Verifica se esta logado como cliente
$_SESSION['login_fail'] = true;
$_SESSION['admin'] = "";

$user = $_POST["user"];
$pass = $_POST["passwd"];

if(valida_login($user) and valida_senha($pass)){
    $conn = new mysqli($host, $username, $password, $dbname); $conn->set_charset("utf8");

    $passwd = md5($pass);

    if($query = $conn->query("SELECT * FROM admin WHERE user = '$user' AND senha = '$passwd'")){

        if($query->num_rows == 1){
            $res = $query->fetch_assoc();
            $_SESSION['adm_logado'] = true;
            $_SESSION['admin'] = $res["user"];
            $_SESSION['login_fail'] = false;
        }

        $query->close();
    }
}

$conn->close();

if($_SESSION["adm_logado"]){
    header("Location: admin.php");
} else {
   header("Location: admin_login.php");
}



?>