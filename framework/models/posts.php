<?php 

namespace framework\models;

use framework\models\model;

class Posts extends Model {
  protected $table;
  protected $permitetd_params = ['userId', 'title', 'body'];

  public $values = [];

  public function getAllPosts() {
    $result = $this->all()->get();

    return $result;
  }
}

?>
