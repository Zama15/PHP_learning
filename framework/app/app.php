<?php 
namespace Framework;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class App {
  public function __construct() {
    $this->init();
  }

  private function init() {
    echo '<h1>HOLA MUNDO</h1>';
  }

  public static function run() { // static because we don't need to create an instance of the class to use this method
    $app = new self();
    return;
  }
}
?>
