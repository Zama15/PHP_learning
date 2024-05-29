<?php
  include_once LAYOUTS . 'header.php';
  
  setHeader($d);
?>

<div class="mx-auto w-75">
  <h1 class="text-center">
    My Posts
  </h1>
  <div class="row">
    <div class="col-10">
      <div class="input-group">
        <input type="text" class="form-control" id="text-filter" placeholder="The best post ever">
        <div class="input-group-append">
          <button class="btn btn-secondary" type="button" id="button-filter">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="col-2">
      <a href="userposts/newpost" class="btn btn-primary w-100" id="new-post">
        <i class="bi bi-plus"></i> New Post
      </a>
    </div>
  </div>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>Date</th>
        <th>Title</th>
        <th><i class="bi-gear"></i></th>
      </tr>
    </thead>
    <tbody id="tbl-my-posts">
    </tbody>
  </table>
</div>

<?php
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'app.js', 'myposts.js');
?>
<?php closeFooter(); ?>
