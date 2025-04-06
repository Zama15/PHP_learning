<?php 
namespace app\classes;

use app\controllers\HomeController;
use app\controllers\ErrorController;
// use app\controllers\PostsController;
// use app\controllers\UserPostsController;
// use app\controllers\auth\SessionController;
// use app\controllers\auth\RegisterController;
// use app\controllers\auth\UserController;

class Router {
  private $uri = '';

  public function __construct() {
  }

  public function dispatch() {
    $this->filter_request();

    $controllerName = $this->get_controller();
    $action = $this->get_action();
    $params = $this->get_params();

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    switch($controllerName) {
      case 'HomeController':
        $controller = new HomeController();
        $routes = $controller::$routes ?? [];
        break;
      // case 'PostsController':
      //   $controller = new PostsController();
      //   break;
      // case 'SessionController':
      //   $controller = new SessionController();
      //   break;
      // case 'RegisterController':
      //   $controller = new RegisterController();
      //   break;
      // case 'UserpostsController':
      //   $controller = new UserPostsController();
      //   break;
      // case 'UserController':
      //   $controller = new UserController();
      //   break;
      default:
        $controller = new ErrorController();
        $action = 'error404';
        $controller->$action($params);
        return;
    }

    // if (property_exists($controller, 'routes') || property_exists($controllerName, 'routes')) {
    //   $routes = $controller::$routes;
      if (isset($routes[$action]) && !in_array($requestMethod, $routes[$action])) {
        $controller = new ErrorController();
        $action = 'error405';
        $controller->$action($params);
        return;
      }
    // }

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
