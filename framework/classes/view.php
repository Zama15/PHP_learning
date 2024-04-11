<?php 
namespace framework\classes;

class View {
  public static function render($view, $data = []) {
    $d = as_obj($data);
    require_once VIEWS . $view . '.view.php';
    exit();
  }
}
?>
