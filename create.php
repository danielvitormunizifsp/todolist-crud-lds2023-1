<?php
require 'banco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descTarefaErro = null;
    $statusErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;

        if (!empty($_POST['descricao_tarefa'])) {
            $descricao_tarefa = $_POST['descricao_tarefa'];
        } else {
            $descTarefaErro = 'Por favor digite a descricao da tarefa!';
            $validacao = False;
        }

        if (!empty($_POST['status_tarefa'])) {
            $status_tarefa = $_POST['status_tarefa'];
        } else {
            $statusErro = 'Por favor informe o status de andamento da tarefa!';
            $validacao = False;
        }
    }

    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tarefa (descricao_tarefa, status_tarefa) VALUES(?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($descricao_tarefa, $status_tarefa));
        Banco::desconectar();
        header("Location: index.php");
    }
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
    <div clas="span10 offset1">
      <div class="card">
        <div class="card-header text-white bg-dark">
          <h3 class="well">Nova tarefa</h3>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="create.php" method="post">

            <div class="control-group <?php echo !empty($descTarefaErro) ? 'error ' : ''; ?>">
              <label class="control-label">Descrição tarefa:</label>
              <div class="controls">
                <input size="80" class="form-control" name="descricao_tarefa" type="text" placeholder="Adicione uma nova tarefa" value="<?php echo !empty($descricao_tarefa) ? $descricao_tarefa : ''; ?>">
                <?php if (!empty($descTarefaErro)): ?>
                <span class="text-danger">
                  <?php echo $descTarefaErro; ?>
                </span>
                <?php endif; ?>
              </div>
            </div>
            <br/>
            <div class="control-group <?php !empty($statusErro) ? 'echo($statusErro)' : ''; ?>">
              <div class="controls">
                <label class="control-label">Status tarefa:</label>
                <div class="form-check">
                  <p class="form-check-label">
                    <input class="form-check-input" type="radio" name="status_tarefa" id="status_tarefa" value="Pendente" <?php isset($_POST["status_tarefa"]) && $_POST["status_tarefa"]=="Pendente" ? "checked" : null; ?>/>
                    Pendente
                  </p>
                </div>

                <div class="form-check">
                  <p class="form-check-label">
                    <input class="form-check-input" id="status_tarefa" name="status_tarefa" type="radio" value="Feito" <?php isset($_POST["status_tarefa"]) && $_POST["status_tarefa"]=="Feito" ? "checked" : null; ?>/>
                    Feito
                  </p>
                </div>
                <?php if (!empty($statusErro)): ?>
                <span class="help-inline text-danger">
                  <?php echo $statusErro; ?>
                </span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-actions">
              <br/>
              <button type="submit" class="btn btn-success">Criar</button>
              <a href="index.php" type="btn" class="btn btn-dark">Voltar</a>
            </div>
            <br/>
          </form>
        </div>
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