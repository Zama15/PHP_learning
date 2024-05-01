<?php
namespace framework\controllers\auth;

use framework\classes\redirect;
use framework\classes\view;
use framework\controllers\BaseController;
use framework\models\user;

class SessionController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function initSession($param = null) {
    $response = [
      'code' => 200,
      'message' => 'Session started',
      'session' => self::sessionCheck() ?? ['valid' => false]
    ];

    View::render('auth/initsession', $response);
  }

  public function userAuth() {
    $user = new User();
    $response = $user->authUser(filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS));

    if ( count(json_decode($response)) > 0 ) {
      echo $this->sessionRegister($response);
    } else {
      echo json_encode(['r' => false]);
    }
  }

  public function sessionRegister($r) {
    $data = json_decode($r);
    $data = $data[0];

    session_start();

    $_SESSION['valid'] = true;
    $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['id'] = $data->id;
    $_SESSION['name'] = $data->name;
    $_SESSION['passwd'] = $data->passwd;
    $_SESSION['tipo'] = $data->tipo;
    session_write_close();

    echo json_encode(['r' => true]);
  }

  public function logout() {
    $this->sessionDestroy();
    Redirect::to('Home');
    exit();
  }

  public static function sessionCheck() {
    $user = new User();
    session_start();

    if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
      $data = $_SESSION;

      $respose = $user->authUser([
        'name' => $data['name'],
        'passwd' => $data['passwd']
      ], true);

      if (count(json_decode($respose)) > 0 && $_SESSION['IP'] == $_SERVER['REMOTE_ADDR']) {
        session_write_close();

        return [
          'name' => $data['name'],
          'valid' => $data['valid'],
          'id' => $data['id'],
          'tipo' => $data['tipo']
        ];
      } else {
        session_write_close();

        self::sessionDestroy();
        return null;
      }
    }

    session_write_close();

    self::sessionDestroy();
    return null;
  }

  private static function sessionDestroy() {
    session_start();
    $_SESSION = [];
    $_SESSION['valid'] = false;
    session_destroy();
    session_write_close();

    return;
  }
}
?>
