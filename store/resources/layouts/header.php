<?php
function setHeader($args){
  $ua = isset($args->ua) ? as_obj($args->ua) : as_obj([]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <title><?= $args->title ?></title>
</head>
<body>
  <div id="store">
    <header>
      <h1>Tienda en linea</h1>                    
    </header>
    <nav>
      <ul>
        <li>
          <a href="#">Tienda</a>
        </li>                        
        <?php if(isset($ua->sv) && $ua->sv): ?>
          <li>
            <a href="/UserCarrito">
              Mi carrito
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <ul>
        <?php if(isset($ua->sv) && $ua->sv): ?>
          <li>
            <a href="\Session\logout">
              Cerrar sesión
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
<?php } ?>
