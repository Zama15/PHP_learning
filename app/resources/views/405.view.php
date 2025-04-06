<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
?>

<div>
  <h1><?= $d->code ?></h1>
  <h2>Metodo no permitido</h2>
  <p>El metodo que intentas usar no es permitido en esta ruta.</p>
  <a href="/">Go to Home</a>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d);
?>
<?php closeFooter(); ?>
