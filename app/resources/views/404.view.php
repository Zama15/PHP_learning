<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
?>

<div>
  <h1><?= $d->code ?></h1>
  <h2>Pagina no encontrada</h2>
  <p>La pagina que buscas no existe o ha sido movida.</p>
  <a href="/">Volver al inicio</a>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d);
?>
<?php closeFooter(); ?>
