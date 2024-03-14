<?php 
namespace app\classes;

class Autoloader {
  public static function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  public static function autoload($class) {
    $classname = CLASSES_PATH . str_replace('\\', DS, $class) . '.php';
    if (file_exists($classname)) {
      require_once $classname;
    } else {
      die('Class ' . $class . ' not found');
    }

    return;
  }
}
?>
