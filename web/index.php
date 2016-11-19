<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login bdFlix</title>

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="css/styleLogin.css">

</head>

<body>
	<form action = "checa_login_perfil.php" method = "POST">
	  <div class="login-form">
	     <h1>LOGIN <?php if(isset($_SESSION["cont"])) echo $_SESSION["cont"]; ?></h1>
	     <div class="form-group ">
	       <input type="text" class="form-control" placeholder="Id Usuario" name="user">
	       <i class="fa fa-user"></i>
	     </div>
	     <div class="form-group log-status">
	       <input type="password" class="form-control" placeholder="Senha" name="passwd">
	       <i class="fa fa-lock"></i>
	     </div>
			 <?php
			 	if(isset($_SESSION['login_fail']) && $_SESSION['login_fail'])
	      	echo '<span class="alert">Dados incorretos!</span>';
				?>
	     <a class="link" href="recupera.php">Esqueceu a senha?</a>
	     <button type="submit" class="log-btn">Acessar perfil</button>
			 <button style = "margin-top: 10px; background-color:#30926f;" formaction="checa_login_cliente.php" type="submit" class="log-btn">Entrar como cliente</button>
			 <button style = "margin-top: 10px; background-color:#a23a3a;" formaction="registrar.php" type="submit" class="log-btn">Registrar</button>
		</div>
	</form>

</body>
</html>
