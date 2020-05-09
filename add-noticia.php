<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
  <link rel="stylesheet" href="_css/style.css">
  <!-- iconic -->
  <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Pagina Inicial <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Adicionar Noticia</a>
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

  <!-- Alert onload -->
  <div class="container text-center fixed-top mt-5" id="load">
    <img src="_img/tenor.gif" class="rounded" alt="...">
  </div>

  <!-- container add noticia -->
  <div class="bg-light p-md-5 pb-3">
    <div class="container">
      <div class="row">
        <div class="col mb-3">
          <h1 class="text-primary font-weight-bold mt-3">Dicas e observações</h1>
          <p class="lead my-3 text-secondary">Por questão de armazenamentos use imagens de tamanho pequeno, converta-ás se necessário para 32KB.
            Use poucas palavras no seu Titulo. Vale lembrar que a primeira imagem será apresentada como capa na pagina inicial das noticias.</p>
          <p class="my-3 text-info">Está precisando reduzir o tamanho das imagens ? Acesse usando o link abaixo e reduza suas imagens para 320KB, é facil e rápido.</p>
          <a href="https://www.easy-resize.com/pt/" target="_blank" class="btn btn-primary">Link para diminuir imagem</a>
        </div>
        <div class="col">
          <h1 class="text-success font-weight-bold mt-3">Adicionar Publicação</h1>

          <?php
          date_default_timezone_set('America/Sao_Paulo');
          $date = date('Y-m-d H:i');

          // Share to scripts...
          require_once('_components_php/connectvars.php');
          require_once('_components_php/appvars.php');

          if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $name = 'Fabricio';
            $type_notice = $_POST['type-notice'];
            $description = $_POST['description'];

            // All VARS of IMG's...
            $img_capa = $_FILES['img-capa']['name'];
            $img_capa_type = $_FILES['img-capa']['type'];
            $img_capa_size = $_FILES['img-capa']['size'];

            if (!empty($title) && !empty($type_notice) && !empty($img_capa) && !empty($description)) {
              // Move img for paste and alter name with time()...
              $img_capa_rename = time() . $img_capa;
              $target_capa = GW_UPLOADPATH . $img_capa_rename;

              // Move files to folder target...
              if ($_FILES['img-capa']['error'] == 0) {

                // Now connect to database...
                if (($img_capa_type == 'image/png') || ($img_capa_type == 'image/gif') || ($img_capa_type == 'image/jpeg') || ($img_capa_type == 'image/jpg') && ($img_capa_size <= GW_MAXFILESIZE)) {

                  // Connect database...
                  if (move_uploaded_file($_FILES['img-capa']['tmp_name'], $target_capa)) {
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $query = "INSERT INTO barraswiki VALUES (DEFAULT, '$date', '$name', '$type_notice', '$title', '$description', '$img_capa_rename')";
                    mysqli_query($dbc, $query);

                    echo '<p class="alert alert-success">Noticia adicionada com sucesso, agora é só aguardar a verificação!</p>';

                    // Clear values from inputs

                    $title = "";
                    $type_notice = "";
                    $description = "";
                    $img_capa = "";

                    // Close database
                    mysqli_close($dbc);
                  }
                } else {
                  echo '<p class="alert alert-warning">A imagem precisa ser do tipo PNG, GIF, JPEG ou JPG e menor que 320BK. Se não for o caso experimente diminui-las usando o link acima ou do lado.</p>';
                }
              } else {
                echo '<p class="alert alert-danger">Erro ao salvar imagens!</p>';
              }
            } else {
              echo '<p class="alert alert-danger">Você precisa preencher todos os dados antes!</p>';
            }
          }
          ?>

          <!-- Form -->
          <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="form-group mt-3">
              <label>Título</label>
              <input type="text" class="form-control" maxleght="50" id="inputAddress" name="title" value="<?php if (!empty($title)) echo $title; ?>" placeholder="Use poucas palavras">
              <small class="form-text text-muted">
                Seu titulo deve conter no máximo 50 caracteres.
              </small>
            </div>

            <div class="form-group">
              <label for="inputState">Escolha um assunto</label>
              <select id="inputState" class="form-control bg-white" name="type-notice" value="<?php if (!empty($type_notice)) echo $type_notice; ?>">
                <option selected>Selecione</option>
                <option value="politica" class="Política">Política</option>
                <option value="esporte" class="Esporte">Esporte</option>
                <option value="policia" class="Polícia">Polícia</option>
                <option value="eventos" class="Eventos">Eventos</option>
                <option value="fotoscidade" class="Fotos">Fotos Cidade</option>
              </select>
            </div>

            <small id="passwordHelpBlock" class="form-text text-muted mb-1">
              Essa imagem será a capa da noticia
            </small>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <img src="_img/icons/landscape.svg" class="icon-input-img">
                </span>
              </div>
              <div class="custom-file">
                <input type="file" id="img-capa" class="custom-file-input" accept="image/*" name="img-capa" value="Selecione uma imagem" id="inputGroupFile01">
                <label id="file-name" class="custom-file-label no-after" for="inputGroupFile01">Selecione uma foto</label>
              </div>
            </div>

            <div class="form-group">
              <label>Descrição do assunto</label>
              <textarea class="form-control" maxleght="2000" aria-label="With textarea" name="description" placeholder="Escreva aqui os detalhes..."><?php if (!empty($description)) echo $description; ?></textarea>
              <small class="form-text text-muted" placeholder="Escreva aqui os detalhes, ou seja lá o que for">
                Sua descrição deve conter no máximo 2 mil caracteres.
              </small>
            </div>

            <input type="submit" class="btn btn-primary mb-3 btn-block" name="submit" value="Publicar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- container add noticia -->

  <footer class="bg-white">
    <div class="container">
      <div class="footer-border">
        <p class="text-center text-secondary m-0 p-0">&copy; 2020 barras wiki todos os direitos reservados</p>
      </div>
    </div>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="node_modules/popper.js/dist/popper.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <!-- Get image name and show -->

  <script>
    var $input = document.getElementById('img-capa'),
      $fileName = document.getElementById('file-name');

    $input.addEventListener('change', function() {
      $fileName.innerHTML = this.value;
    })

    // Where onload...
    var $load = document.getElementById('load');

    document.ready(function() {
      $load.show();
      window.load(function() {
        $load.fadeout('slow');
      })
    })
  </script>
</body>

</html>