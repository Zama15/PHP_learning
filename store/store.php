<?php 
namespace Store;

use store\classes\Autoloader;
use store\classes\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Store {
  public function __construct() {
    $this->init();
  }

  public static function run() {
    $store = new self();
    return;
  }

  private function init() {
    $this->load_config();
    $this->load_helpers();
    $this->init_autoloader();
    $this->init_router();
  }

  private function load_config() {
    if (!file_exists(__DIR__ . '/config.php')) {
      die('Config file not found');
    }

    require_once __DIR__ . '/config.php';
  }

  private function load_helpers() {
    if (!file_exists(HELPERS . 'store_helper.php')) {
      die('Helper file not found');
    }

    require_once HELPERS . 'store_helper.php';
  }

  private function init_autoloader() {
    if (!file_exists(CLASSES . 'autoloader.php')) {
      die('Autoloader file not found');
    }

    require_once CLASSES . 'autoloader.php';
    Autoloader::register();
    return;
  }

  private function init_router() {
    if (!file_exists(CLASSES . 'router.php')) {
      die('Router file not found');
    }

    require_once CLASSES . 'router.php';
    $router = new Router();
    $router->dispatch();
  }
}
?>
