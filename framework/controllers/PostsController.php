<?php 
namespace framework\controllers;

use framework\models\posts;


class PostsController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function getPosts() {
    $posts = new Posts();
    $result = $posts->getAllPosts();
    // $this->view->render('posts', $result);

  }
}
?>
