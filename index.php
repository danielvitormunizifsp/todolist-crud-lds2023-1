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
  <div class="container">
    <br/>
    <div class="table-responsive-md">
      <div class="row">
        <p>
          <a href="create.php" class="btn btn-dark">Criar</a>
        </p>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Descrição Tarefa</th>
              <th scope="col">Status</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php
        include 'banco.php';
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM tarefa ORDER BY id DESC';

        foreach($pdo->query($sql)as $row)
        {
            echo '<tr>';
            echo '<td>'. $row['descricao_tarefa'] . '</td>';
            echo '<td>'. $row['status_tarefa'] . '</td>';
            echo '<td width=250>';
            echo '<a class="btn btn-dark" href="read.php?id='.$row['id'].'"><i class="material-icons">info_outline</i></a>';
            echo ' ';
            echo '<a class="btn btn-dark" href="update.php?id='.$row['id'].'"><i class="material-icons">mode_edit</i></a>';
            echo ' ';
            echo '<a class="btn btn-dark" href="delete.php?id='.$row['id'].'"><i class="material-icons">delete</i></a>';
            echo '</td>';
            echo '</tr>';
        }
        Banco::desconectar();
        ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="componentes/js/bootstrap.min.js"></script>
</body>

</html>