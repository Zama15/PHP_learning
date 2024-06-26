<?php
function setFooter($args,...$scripts){ 
  $session = as_obj($args->session);
?>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js" integrity="sha256-O11zcGEd6w4SQFlm8i/Uk5VAB+EhNNmynVLznwS6TJ4=" crossorigin="anonymous"></script>
  
  <script>
    $(function() {
      app.user.session = <?= $session->valid ? 'true' : 'false' ?>;
      app.user.id = <?= $session->id ?? '' ?>;
      app.user.name = "<?= $session->name ?? '' ?>";
      app.user.tipo = <?= $session->tipo ?? '' ?>; 
    })
  </script>

  <?php foreach($scripts as $script){ ?>
    <script src="/assets/js/<?=$script?>"></script>
  <?php } ?>
<?php } ?>

<?php function closeFooter(){ ?>
</body>
</html>
<?php } ?>
