<?php 
namespace framework\controllers\auth;

use framework\classes\view;
use framework\controllers\BaseController;
use framework\models\user;

class UserController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function userprofile($param = null) {
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

    $data['title'] = 'My Profile';
    $data['message'] = 'My Profile';

    View::render('auth/userprofile', $response);
  }

  public function getMyUser($params = null) {
    $user = new User();
    $result = $user->getUser($params);

    echo $result;
  }

  public function upsert($params = null) {
    $params = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    $user = new User();
    $result = $user->upsertUser($params);

    echo $result;
  }
}
?>
