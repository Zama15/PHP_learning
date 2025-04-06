<?php 
namespace app\controllers;

use app\classes\view;
// use app\controllers\auth\SessionController;

class ErrorController extends BaseController {
  public function __construct() {
    parent::__construct();    
  }

  public function error404($params = null) {
    
    $response = [
      'title' => 'Error: 404 Not Found',
      'code' => '404',
      // 'session' => SessionController::sessionCheck() ?? ['valid' => false]
    ];

    View::render('404', $response);
  }

  public function error405($params = null) {
    
    $response = [
      'title' => 'Error: 405 Method Not Allowed',
      'code' => '405',
      // 'session' => SessionController::sessionCheck() ?? ['valid' => false]
    ];

    View::render('405', $response);
  }
}
?>
