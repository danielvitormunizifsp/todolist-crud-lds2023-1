<?php
require 'banco.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tarefa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Projeto Task ToDo</title>
  <link rel="icon" type="image/svg+xml" href="./componentes/img/favicon.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./componentes/css/bootstrap.min.css">
</head>

<body>
  <header>
    <div class="p-5 text-center bg-dark">
      <h1 class="mb-3">
        <img src="./componentes/img/logo.svg" height="50" alt="Logo Site" loading="lazy" />
      </h1>
    </div>
  </header>
  <br/>
  <div class="container">
    <div class="span10 offset1">
      <div class="card">
        <div class="card-header text-white bg-dark">
          <h3 class="well">Informações das tarefas</h3>
        </div>
        <br/>
        <div class="container">
          <div class="form-group row">
            <label for="staticID" class="col-sm-2 col-form-label">ID tarefa:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticID" value="<?php echo $data['id']; ?>">
            </div>
          </div>


          <div class="form-group row">
            <label for="staticDescTarefa" class="col-sm-2 col-form-label">Descrição tarefa:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticDescTarefa" value="<?php echo $data['descricao_tarefa']; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="staticDtCriacao" class="col-sm-2 col-form-label">Data criação:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticDtCriacao" value="<?php echo $data['data_criacao']; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="staticDtAteracao" class="col-sm-2 col-form-label">Data alteração:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticDtAteracao" value="<?php echo $data['data_alteracao']; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="staticStatus" class="col-sm-2 col-form-label">Status tarefa:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="staticStatus" value="<?php echo $data['status_tarefa']; ?>">
            </div>
          </div>

          <br/>
          <div class="form-actions">
            <a href="index.php" type="btn" class="btn btn-dark">Voltar</a>
          </div>
          <br/>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="componentes/js/bootstrap.min.js"></script>
</body>

</html>