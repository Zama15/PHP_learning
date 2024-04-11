<?php 
namespace framework\controllers;

use framework\classes\view;

class ErrorController extends BaseController {
  public function __construct() {
    parent::__construct();    
  }

  public function error404($params = null) {
    
    $response = [
      'title' => 'Error: 404 Not Found',
      'code' => '404'
    ];

    View::render('404', $response);
  }
}
?>
