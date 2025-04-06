<?php
function setFooter($args,...$scripts){
  $ua = isset($args->ua) ? as_obj($args->ua) : as_obj([]);
?>
  <!-- <script src="/assets/js/store.js"></script> -->
  <?php foreach($scripts as $script){ ?>
    <script src="/assets/js/<?=$script?>"></script>
  <?php } ?>
<?php } ?>

<?php function closeFooter(){ ?>
</body>
</html>
<?php } ?>
