<?php 
namespace app\classes;

class Router {
  private $uri = '';

  public function __construct() {
  }

  public function dispatch() {
    $this->filterRequest();
  }

  private function filterRequest() {
    $request = filter_input_array(INPUT_GET);
    if (isset($request['uri'])) {
      $this->uri = $request['uri'];
      $this->uri = rtrim($this->uri, '/');
      $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
      $this->uri = explode('/', ucfirst(strtolower($this->uri)));
      print_r($this->uri);
      return;
    }
  }
}
?>
