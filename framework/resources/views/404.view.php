<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
?>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="mt-5"><?= $d->code ?></h1>
      <h2>Page not found</h2>
      <p>The page you are looking for does not exist or has been moved.</p>
      <a href="/" class="btn btn-primary">Go to Home</a>
    </div>
  </div>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d);
?>
<?php closeFooter(); ?>
