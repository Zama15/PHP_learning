<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
  //$ua = as_object($_SESSION);
?>

<!-- <div class="row mx-auto">
  <div class="col-2">
    <div id="prev-posts" class="list-group small-font">
    </div>
  </div>
  <div class="col-8">
    <div id="content" class="content">
    </div>
  </div>
  <div class="col">
    <div id="dates" class="list-group">
    </div>
  </div>
</div> -->

<form action="#" method="POST" accept-charset="utf-8">
  <label for="name">name</label>
  <input type="text" name="name" id="name" placeholder="Nombre" required>
  <button type="submit">Iniciar Compra</button>
</form>
<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d);
?>
<?php closeFooter(); ?>
