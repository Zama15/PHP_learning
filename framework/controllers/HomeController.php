<?php
namespace framework\controllers;

use framework\classes\view;

class HomeController extends BaseController {
  public function __construct() {
    parent::__construct();    
  }

  public function index($params = null) {
    
    $response = [
      'title' => 'Home',
      'code' => '200'
    ];

    View::render('home', $response);
  }
}
?>
