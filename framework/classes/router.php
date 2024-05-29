<?php 
namespace framework\classes;

use framework\controllers\HomeController;
use framework\controllers\ErrorController;
use framework\controllers\PostsController;
use framework\controllers\UserPostsController;
use framework\controllers\auth\SessionController;
use framework\controllers\auth\RegisterController;

class Router {
  private $uri = '';

  public function __construct() {
  }

  public function dispatch() {
    $this->filter_request();

    $controller = $this->get_controller();
    $action = $this->get_action();
    $params = $this->get_params();

    switch($controller) {
      case 'HomeController':
        $controller = new HomeController();
        break;
      case 'PostsController':
        $controller = new PostsController();
        break;
      case 'SessionController':
        $controller = new SessionController();
        break;
      case 'RegisterController':
        $controller = new RegisterController();
        break;
      case 'UserpostsController':
        $controller = new UserPostsController();
        break;
      default:
        $controller = new ErrorController();
        $action = 'error404';
        break;
    }
    $controller->$action($params);

    return;
  }

  private function filter_request() {
    $request = filter_input_array(INPUT_GET);
    if (isset($request['uri'])) {
      $this->uri = $request['uri'];
      $this->uri = rtrim($this->uri, '/');
      $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
      $this->uri = explode('/', ucfirst(strtolower($this->uri)));
      return;
    }
  }

  private function get_controller() {
    if (isset($this->uri[0])) {
      $controller = $this->uri[0];
      unset($this->uri[0]);
    } else {
      $controller = 'Home';
    }
    $controller = ucfirst($controller) . 'Controller';

    return $controller;
  }

  private function get_action() {
    if (isset($this->uri[1])) {
      $action = $this->uri[1];
      unset($this->uri[1]);
    } else {
      $action = 'index';
    }

    return $action;
  }

  private function get_params() {
    $params = [];

    if (!empty($this->uri)) {
      $params = $this->uri;
    }

    return $params;
  }
}
?>
