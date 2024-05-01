<?php 
namespace framework\controllers;

use framework\classes\view;
use framework\controllers\auth\SessionController;

class ErrorController extends BaseController {
  public function __construct() {
    parent::__construct();    
  }

  public function error404($params = null) {
    
    $response = [
      'title' => 'Error: 404 Not Found',
      'code' => '404',
      'session' => SessionController::sessionCheck() ?? ['valid' => false]
    ];

    View::render('404', $response);
  }
}
?>
