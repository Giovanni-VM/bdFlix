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

  <script type="text/javascript">
    <?php if(isset($_GET['email'])) { ?>
      $(function(){
        $('#recSenhaModal').modal('show');
      });
    <?php } ?>
  </script>

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
    <?php if(isset($_GET['email'])){
      include 'bd.php';
      include 'valida_campos.php';
      if(valida_email($_GET['email'])){
        $con = new mysqli($host, $username, $password, $dbname);
        $email = $_GET['email'];
        $sql = " SELECT * FROM Cliente WHERE email = '$email' ";
        $r = mysqli_query($con, $sql);
        if(mysqli_num_rows($r) == 1) {
          $novaSenhaDesc = substr(str_shuffle(MD5(MD5(microtime()))), 0, 15);
          $novaSenha = MD5($novaSenhaDesc);
          $sql2 = "UPDATE Cliente SET senha = '$novaSenha' WHERE email = '$email'";
          mysqli_query($con, $sql2);

          $msg = "Sua nova senha é\n $novaSenhaDesc \n Lembre-se de alterá-la imediatamente!\n";
          // wordwrap() se linha > 70 carac
          $msg = wordwrap($msg,70);

          if (!mail($email,"Nova senha", $msg)){
            echo "Erro ao enviar a senha. Verifique se a máquina conta com um servidor de emails.\n";
          }

          echo '
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Senha Resetada</h1>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="text-center">
                        <p>Sua nova senha foi enviada para seu email</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <div class="col-md-12">
                <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
              </div>
            </div>
          </div>
        </div>
          '; exit();
        }
      }

      echo '
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h1 class="text-center">Informações incorretas</h1>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="text-center">
                    <p>O email preenchido não é válido</p>
                    <p> Lembre-se que o email preenchido deve ser do Cliente! </p>
                    <p> Caso queira modificar senha do perfil, acesse a conta do cliente </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <div class="col-md-12">
            <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
          </div>
        </div>
      </div>
    </div>
      ';

    } else {
      echo '
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
                    <form method = "GET" action = "##">
                      <fieldset>
                        <div class="form-group">
                          <input class="form-control input-lg" placeholder="E-mail" name="email" type="email">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit"> Resetar senha </button>
                      </fieldset>
                    </form>
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
  '; }?>
</div>

</body>
</html>
