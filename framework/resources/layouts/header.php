<?php
function setHeader($args){
  $session = as_obj($args->session);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/assets/imgs/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/stylesheets/app.css">
  <title><?= $args->title ?></title>
</head>
<body>
  <div id="app" class="container-fluid p-0 sticky-top">
    <header class="row m-0 bg-dark bg-gradient" data-bs-theme="dark">
      <div class="col-9">
        <h1 class="ml-3 mt-2">Framework PHP</h1>                    
      </div>
      <div class="col-3 mt-2">
        <form class="d-flex" role="search">
          <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-success" onclick="" type="button"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </header>
    <nav class="navbar navbar-expand-lg bg-dark bg-gradient mb-3" data-bs-theme="dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/">Inicio</a>
            </li>                        
            <?php if(isset($session->valid) && $session->valid): ?>
              <li class="nav-item">
                <a class="nav-link btn btn-link" type="button" aria-current="page" href="/UserPosts">
                  Mis publicaciones
                </a>
              </li>
            <?php endif; ?>
          </ul>
          <ul class="navbar-nav me-5 mb-2 d-flex">
            <?php if(!$session->valid): ?>
              <li class="nav-item">
                <a href="/Session/initSession" class="nav-link btn btn-link">
                  Inicar sesión
                </a>
              </li>
            <?php else: ?>
              <li class="nav-item dropdown me-5">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?= isset($session->name) ? $session->name : '' ?>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item btn btn-link" href="/User/userprofile">
                      Mi perfil
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item btn btn-link" href="\Session\logout">
                      Cerrar sesión
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
<?php } ?>
