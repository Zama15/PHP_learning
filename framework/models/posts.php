<?php 

namespace framework\models;

use framework\models\model;

class Posts extends Model {
  protected $table;
  protected $permitetd_params = ['userId', 'title', 'body'];

  public $values = [];

  public function __construct() {
    parent::__construct();

    $this->table = $this->connect();
  }

  public function getAllPosts($limit = 5) {
    $result = $this->select(['a.title', 'date_format(a.created_at,"%d/%m/%Y") as fecha', 'b.name'])
                   ->join('user b', 'a.userId = b.id')
                   ->where([['active', 1]])
                   ->orderby([['created_at', 'desc']])
                   ->limit($limit)
                   ->get();
    return $result;
  }
}

?>
