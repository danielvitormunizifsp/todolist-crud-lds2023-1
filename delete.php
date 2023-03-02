<?php
require 'banco.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM tarefa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");
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
          <h3 class="well">Excluir tarefa?</h3>
        </div>
        <br/>
        <div class="container">
          <form class="form-horizontal" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>" />
            <div class="alert alert-danger"> Deseja mesmo excluir essa tarefa?
            </div>
            <div class="form actions">
              <button type="submit" class="btn btn-danger">Sim</button>
              <a href="index.php" type="btn" class="btn btn-dark">Não</a>
            </div>
          </form>
          <br/>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="componentes/js/bootstrap.min.js"></script>
</body>

</html>