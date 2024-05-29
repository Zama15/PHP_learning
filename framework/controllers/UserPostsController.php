<?php 
namespace framework\controllers;

use framework\classes\csrf;
use framework\classes\redirect;
use framework\classes\view;
use framework\controllers\auth\SessionController;
use framework\models\posts;

class UserPostsController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $session = SessionController::sessionCheck();

    $response = [
      'title' => 'Home',
      'code' => 200,
      'session' => $session ?? ['valid' => false]
    ];

    if (is_null($session)) {
      View::render('home', $response);
      exit();
    }

    $data['title'] = 'My Posts';
    $data['message'] = 'My Posts';

    View::render('myposts', $response);
  }

  public function getMyPosts($params = null) {
    $posts = new Posts();
    $result = $posts->getUserPosts($params);

    echo $result;
  }

  public function newPost() {
    $csrf = new Csrf();
    $session = SessionController::sessionCheck() ?? ['valid' => false];
    
    $response = [
      'title' => 'New Post',
      'code' => 200,
      'session' => $session,
      'csrf' => $csrf->get_token()
    ];

    view::render('newpost', $response);
  }

  public function saveNewPost() {
    $post = new Posts();
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    if (!isset($data['csrf']) || !Csrf::validate($data['csrf'])) {
      $session = new SessionController();
      $session->logout();

      return;
    }

    if (!isset($data['title']) || !isset($data['body'])) {
      echo json_encode(['r' => false, 'code' => 1]);
      exit();
    }

    $data['user_id'] = SessionController::sessionCheck()['id'];
    
    $post->savePost($data);
    Redirect::to('home');
  }
}
?>
