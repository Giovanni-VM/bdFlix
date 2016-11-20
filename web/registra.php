<!doctype html>
<html>

  <head>
    <meta charset="UTF-8">
    <title> Registre-se </title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleReg.css">
  </head>

  <body>
    <div class="container">
      <form class="form-horizontal" role="form">
        <h2>Faça seu cadastro</h2>
          <div class="form-group">
            <label for="nomeComp" class="col-sm-3 control-label">Nome completo</label>
            <div class="col-sm-9">
              <input type="text" id="nomeComp" placeholder="Nome completo" class="form-control" autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" id="email" placeholder="Email" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="senha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-9">
              <input type="password" id="senha" placeholder="Senha" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="dtNasc" class="col-sm-3 control-label">Data Nascimento</label>
            <div class="col-sm-9">
                <input type="date" id="dtNasc" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="plano" class="col-sm-3 control-label">Plano</label>
              <div class="col-sm-9">
                <select id="plano" class="form-control">
                  <option>Plano1</option>
                  <option>Plano2</option>
                  <option>Plano3</option>
                  <option>Plano4</option>
                  <option>Plano5</option>
                </select>
              </div>
          </div> <!-- /.form-group -->
          <div class="form-group">
            <label class="control-label col-sm-3">Sexo</label>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-4">
                  <label class="radio-inline">
                    <input type="radio" id="feminino" value="Feminino">Feminino
                  </label>
                </div>
                <div class="col-sm-4">
                  <label class="radio-inline">
                    <input type="radio" id="masculino" value="Masculino">Masculino
                  </label>
                </div>
              </div>
            </div>
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
              <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
          </div>
    </form> <!-- /form -->
    </div> <!-- ./container -->
  </body>
</html>
