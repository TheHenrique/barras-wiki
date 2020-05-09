<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="_css/style.css">

  <!-- Social midia buttons online link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>barras wiki - noticias</title>
</head>

<body>
  <!-- nav bar menu-top -->
  <nav class="navbar navbar-expand-lg navbar-light bg-gradient-white">
    <div class="container">
      <a class="navbar-brand h1 mb-0 text-primary font-weight-bold" href="index.php">barras wiki</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Pagina Inicial <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-noticia.php">Adicionar Noticia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Termos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Noticias</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <a class="dropdown-item" href="#">Política</a>
              <a class="dropdown-item" href="#">Esporte</a>
              <a class="dropdown-item" href="#">Polícia</a>
              <a class="dropdown-item" href="#">Eventos</a>
              <a class="dropdown-item" href="#">Fotos Paisagem</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search">
        </form>
        <ul class="navbar-nav mr-0">
          <li style="color: transparent;">L</li>
          <li class="nav-item btn icon-link-login btn-primary">Login</li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- nav bar menu-top -->

  <!-- Begin apresentation -->
  <div class="jumbotron text-info rounded bg-gradient-light">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="font-weight-bold icon-h1-objective">Compartilhe você também acontecimentos e histórias</h1>
          <p class="lead my-3 text-secondary">A princípio o intuito é fazer com que pessoas comuns compartilhem de uma forma mais prática e simples notícias, experiências e lazer do dia a dia,
            sem nenhum vinculo com politica ou meio de se obter lucro. Porém, as mesmas passaram por uma availação até serem indexadas no site.</p>
          <p class="mb-0"><a href="#" class="text-primary font-weight-bold">Ler mais sobre..</a></p>
        </div>
        <div class="col">
          <h1 class="text-primary font-weight-bold mt-3">Crie sua conta</h1>
          <p class="lead my-3 text-secondary">Para começar a publicar faça um breve cadastro usando sua conta do <strong class="text-info">facebook</strong> ou <strong class="text-info">instagram</strong>.</p>
          <a class="btn btn-success mb-3 btn-lg align-content-center" href="#">Criar conta</a>
          <p>Me siga nas redes sociais, e veja o projeto do site no Github: </p>
          <a href="https://www.facebook.com/fabricio.schiffer" target="_blank" class="fa fa-facebook"></a>
          <a href="https://www.instagram.com/fabricio_patrocinio_/?hl=pt-br" target="_blank" class="fa fa-instagram"></a>
          <a href="https://www.youtube.com/channel/UCZSB3-asIKR4ywZTnlvbZ3Q?view_as=subscriber" target="_blank" class="fa fa-youtube"></a>
          <a href="https://github.com/FabricioPatrocinio" target="_blank" class="fa fa-github"></a>
        </div>
      </div>
    </div>
  </div>
  <!-- End apresentation -->

  <!-- PHP begin notice type big -->
  <?php
  // Get scripts
  require_once('components/connectvars.php');
  require_once('components/appvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $query = "SELECT Year(reg_data) as ano, MONTH(reg_data) as mes, DAY(reg_data) as dia, barraswiki.* FROM barraswiki ORDER BY aprovam DESC, reg_data DESC";
  $data = mysqli_query($dbc, $query);

  echo '<div class="container">';
  echo '<h3 class="text-primary icon-h3-destack">Destaques</h3>';
  echo '<div class="row mb-2">';
  
  $i = 0; // For math duo notice

  while ($row = mysqli_fetch_array($data)) {
    $i++;  // Math
    $long_time_y = date('Y') - $row['ano'];
    $long_time_m = date('n') - $row['mes'];
    $long_time_d = date('d') - $row['dia'];

    if ($long_time_y > 0) { // For Year
      if ($long_time_y == 1) {
        $long_time = $long_time_y . ' ano';
      } else {
        $long_time = $long_time_y . ' anos';
      }
    }

    if ($long_time_y <= 0 && $long_time_m > 0) { // For month
      if ($long_time_m == 1) {
        $long_time = $long_time_m . ' mês';
      } else {
        $long_time = $long_time_m . ' mêses';
      }
    }

    if ($long_time_y <= 0 && $long_time_m <= 0 && $long_time_d > 0) { // For day
      if ($long_time_d == 1) {
        $long_time = $long_time_d . ' dia';
      } else {
        $long_time = $long_time_d . ' dias';
      }
    }

    if ($long_time_y <= 0 && $long_time_m <= 0 && $long_time_d <= 0) { // For Hours            
      $long_time = ' algumas horas';
    }

    if ($i <= 2) { // Two first boxs         
      echo '<div class="col-md-6">';
      echo '<div class="card flex-md-row mb-4 box-shadow h-md-250">';
      echo '<div class="card-body d-flex flex-column align-items-start">';
      echo '<strong class="d-inline-block mb-3 text-primary ' . $row['type_notice'] . '">' . $row['type_notice'] . '</strong>';
      echo '<h3 class="mb-0">';
      echo '<a class="text-dark" href="#">' . substr($row['title'], 0, 35) . '</a>';
      echo '</h3>';
      echo '<div class="mb-1 text-muted">Há ' . $long_time . '</div>';
      echo '<p class="card-text text-secondary mb-auto">' . substr($row['description'], 0, 70) . '...</p>';
      echo '<a href="#">Ler mais</a>';
      echo '<div class="btn-group mt-1">';
      echo '<span class="icon-like"></span>';
      echo '<small class="text-muted"><div class="mb-1 ml-1 text-muted">' . $row['aprovam'] . '</div></small>';
      echo '<span class="icon-dislike ml-2"></span>';
      echo '<small class="text-muted"><div class="mb-1 ml-1 text-muted">' . $row['desaprovam'] . '</div></small>';
      echo '</div>';
      echo '</div>';
      echo '<img class="card-img-right flex-auto d-none d-md-block" alt="' . $row['title'] . '" src="images/foto-cidade-cima.jpeg" data-holder-rendered="true" style="width: 200px; height: auto;">';
      echo '</div>';
      echo '</div>';
    }

    if ($i > 2) { // All boxs
      echo '<div class="col-md-4">';
      echo '<div class="card mb-4 box-shadow">';
      echo '<img class="card-img-top"  alt="' . $row['title'] . '" style="height: 225px; width: 100%; display: block;" src="images/foto-prefeitura.jpeg" data-holder-rendered="true">';
      echo '<div class="card-body">';
      echo '<strong class="d-inline-block m-4 btn btn-sm text-muted bg-white bg-notice ' . $row['type_notice'] . '">' . $row['type_notice'] . '</strong>';
      echo '<h3 class="">';
      echo '<a class="text-dark" href="#">' . substr($row['title'], 0, 35) . '</a>';
      echo '</h3>';
      echo '<p class="card-text text-secondary">' . substr($row['description'], 0, 75) . '...</p>';
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="btn-group">';
      echo '<span class="icon-like"></span>';
      echo '<small class="text-muted"><div class="mb-1 ml-1 text-muted">' . $row['aprovam'] . '</div></small>';
      echo '<span class="icon-dislike ml-2"></span>';
      echo '<small class="text-muted"><div class="mb-1 ml-1 text-muted">' . $row['desaprovam'] . '</div></small>';
      echo '</div>';
      echo '<small class="text-muted"><div class="mb-1 text-muted">Há ' . $long_time . '</div></small>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  }
  echo '</div>';
  echo '</div>';
  echo '</div>';

  mysqli_close($dbc);
  ?>

  <footer class="bg-light">
    <div class="container">
      <div class="footer-border">
        <p class="text-center text-secondary m-0 p-0">&copy; 2020 barras wiki todos os direitos reservados</p>
      </div>
    </div>
  </footer>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="node_modules/popper.js/dist/popper.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>