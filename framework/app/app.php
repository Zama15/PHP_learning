<?php 
namespace Framework;

use app\classes\Autoloader;
use app\classes\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class App {
  public function __construct() {
    $this->init();
  }

  public static function run() {
    $app = new self();
    return;
  }

  private function init() {
    $this->loadConfig();
    $this->loadHelpers();
    $this->initAutoloader();
    $this->initRouter();
  }

  private function loadConfig() {
    if (!file_exists(__DIR__ . '/config.php')) {
      die('Config file not found');
    }

    require_once __DIR__ . '/config.php';
  }

  private function loadHelpers() {
    if (!file_exists(__DIR__ . '/resources/functions/app_helper.php')) {
      die('Helper file not found');
    }

    require_once __DIR__ . '/resources/functions/app_helper.php';
  }

  private function initAutoloader() {
    if (!file_exists(CLASSES . 'autoloader.php')) {
      die('Autoloader file not found');
    }

    require_once CLASSES . 'autoloader.php';
    Autoloader::register();
    return;
  }

  private function initRouter() {
    if (!file_exists(CLASSES . 'router.php')) {
      die('Router file not found');
    }

    require_once CLASSES . 'router.php';
    $router = new Router();
    $router->dispatch();
  }
}
?>
