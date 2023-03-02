<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $descTarefaErro = null;
    $statusErro = null;

    $descricao_tarefa = $_POST['descricao_tarefa'];
    $status_tarefa = $_POST['status_tarefa'];

    //Validação
    $validacao = true;

    if (empty($descricao_tarefa)) {
        $descTarefaErro = 'Por favor preencha o campo descrição da tarefa!';
        $validacao = false;
    }

    if (empty($status_tarefa)) {
        $statusErro = 'Por favor preenche o campo status de andamento!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tarefa  set descricao_tarefa = ?, status_tarefa = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($descricao_tarefa, $status_tarefa, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tarefa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $descricao_tarefa = $data['descricao_tarefa'];
    $status_tarefa = $data['status_tarefa'];
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
          <h3 class="well"> Atualizar tarefa </h3>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

            <div class="control-group <?php echo !empty($descTarefaErro) ? 'error' : ''; ?>">
              <label class="control-label">Descrição tarefa:</label>
              <div class="controls">
                <input name="descricao_tarefa" class="form-control" size="80" type="text" placeholder="Endereço" value="<?php echo !empty($descricao_tarefa) ? $descricao_tarefa : ''; ?>">
                <?php if (!empty($descTarefaErro)): ?>
                <span class="text-danger">
                  <?php echo $descTarefaErro; ?>
                </span>
                <?php endif; ?>
              </div>
            </div>
            <br/>
            <div class="control-group <?php echo !empty($statusErro) ? 'error' : ''; ?>">
              <label class="control-label">Status tarefa:</label>
              <div class="controls">
                <div class="form-check">
                  <p class="form-check-label">
                    <input class="form-check-input" type="radio" name="status_tarefa" id="status_tarefa" value="Pendente" <?php echo ($status_tarefa=="Pendente" ) ? "checked" : null; ?>/> Pendente
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status_tarefa" id="status_tarefa" value="Feito" <?php echo ($status_tarefa=="Feito" ) ? "checked" : null; ?>/> Feito
                </div>
                </p>
                <?php if (!empty($statusErro)): ?>
                <span class="text-danger">
                  <?php echo $statusErro; ?>
                </span>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-success">Atualizar</button>
              <a href="index.php" type="btn" class="btn btn-dark">Voltar</a>
            </div>
            <br/>
          </form>
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