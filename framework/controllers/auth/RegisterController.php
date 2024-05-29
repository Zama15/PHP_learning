<?php 
namespace framework\controllers\auth;

use framework\classes\view;
use framework\controllers\BaseController;
use framework\models\user;

class RegisterController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function index($param = null) {
    $response = [
      'title' => 'Register',
      'code' => 200,
      'message' => 'Register',
      'session' => SessionController::sessionCheck() ?? ['valid' => false]
    ];

    View::render('auth/register', $response);
  }

  public function register() {
    $user = new User();
    $response = $user->newUser(filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS));

    echo json_encode(['r' => $response]);
  }
}
?>
