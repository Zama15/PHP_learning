<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
  $d = as_obj($d);
?>

<div class="mx-auto w-75 mt-5 shadow bg-body-tertiary rounded">
  <div class="bg-body-secondary text-center rounded">
    <h1 class="display-4">New Post</h1>
  </div>
  <form action="/userposts/savenewpost" method="post" class="p-4">
    <input type="hidden" name="csrf" value="<?= $d->csrf ?>">
    <div class="form-group mb-3">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group mb-3">
      <label for="body">Body</label>
      <textarea class="form-control" id="body" name="body" rows="10" cols="30"></textarea>
    </div>
    <div class="mt-2 text-end">
      <a href="/userposts" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'myposts.js');
?>
<?php closeFooter(); ?>
