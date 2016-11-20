<!-- // ESQUECEU SENHA: substr(str_shuffle(MD5(MD5(microtime()))), 0, 15); -->

<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login bdFlix</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/styleLogin.css">
</head>

<body>
	<form action = "checa_login_perfil.php" method = "POST">
	  <div class="login-form">
	     <h1>LOGIN</h1>
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
       <div class = "esqSenha">
	      <a class="link" href="#" data-target="#recSenhaModal" data-toggle="modal">Esqueceu a senha?</a>
      </div>
	     <button type="submit" class="log-btn">Acessar perfil</button>
			 <button style = "margin-top: 10px; background-color:#30926f;" formaction="checa_login_cliente.php" type="submit" class="log-btn">Entrar como cliente</button>
			 <button style = "margin-top: 10px; background-color:#a23a3a;" formaction="registrar.php" type="submit" class="log-btn">Registrar</button>
		</div>
	</form>

  <div id="recSenhaModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Resetar Senha</h1>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <p>Uma nova senha provisória será enviada para seu e-mail</p>
                  <div class="panel-body">
                      <fieldset>
                        <div class="form-group">
                          <input class="form-control input-lg" placeholder="E-mail" name="email" type="email">
                        </div>
                        <input class="btn btn-lg btn-primary btn-block" value="Resetar senha" type="submit">
                      </fieldset>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		    </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
