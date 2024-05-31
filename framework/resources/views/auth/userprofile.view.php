<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
  $d = as_obj($d);
?>

<div class="mx-auto w-75 mt-5 shadow bg-body-tertiary rounded">
  <div class="bg-body-secondary text-center rounded">
    <h1 class="display-4">Mi perfil</h1>
  </div>
  <div class="p-4" id="profile">
  </div>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'app.js', 'userprofile.js');
?>
<?php closeFooter(); ?>
