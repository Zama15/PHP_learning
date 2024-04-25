<?php
namespace framework\controllers\auth;

use framework\controllers\BaseController;
use framework\classes\view;

class SessionController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function initSession($param = null) {
    $response = [
      'code' => 200,
      'message' => 'Session started'
    ];

    View::render('auth/initsession', $response);
  }
}
?>
