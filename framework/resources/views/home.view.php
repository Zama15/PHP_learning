<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
?>

<div class="row mx-auto">
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
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'app.js');
?>
<?php closeFooter(); ?>
