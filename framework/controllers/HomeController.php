<?php
namespace framework\controllers;

use framework\classes\view;
use framework\controllers\auth\SessionController;

class HomeController extends BaseController {
  public function __construct() {
    parent::__construct();    
  }

  public function index($params = null) {
    
    $response = [
      'title' => 'Home',
      'code' => '200',
      'session' => SessionController::sessionCheck() ?? ['valid' => false]
    ];

    View::render('home', $response);
  }
}
?>
