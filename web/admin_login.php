<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login admin</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/styleLogin.css">

  <script type="text/javascript">
    <?php if(isset($_GET['email'])) { ?>
      $(function(){
        $('#recSenhaModal').modal('show');
      });
    <?php } ?>
  </script>

</head>

<body>
	<form action = "checa_login_admin.php" method = "POST">
	  <div class="login-form">
	     <h1>LOGIN ADMIN</h1>
	     <div class="form-group ">
	       <input type="text" class="form-control" placeholder="User" name="user">
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
       
	     <button type="submit" class="log-btn">Acessar</button>
			</div>
	</form>

</body>
</html>
