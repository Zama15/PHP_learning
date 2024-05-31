<?php 

namespace framework\models;

use framework\models\model;

class Posts extends Model {
  protected $table;
  protected $permited_params = ['userId', 'title', 'body'];

  public $values = [];

  public function __construct() {
    parent::__construct();

    $this->table = $this->connect();
  }

  public function getAllPosts($limit = 5) {
    $result = $this->select(
      ['a.title','date_format(a.created_at,"%d/%m/%Y") as fecha', 'b.name']
    )->join('user b', 'a.userId = b.id')
      ->orderby([['a.created_at', 'desc']])
      ->limit($limit)
      ->get();

    return $result;
  }

  public function lastPost() {
    $result = $this->select([
      'a.id',
      'a.title',
      'date_format(a.created_at,"%d/%m/%Y") as fecha',
      'a.body',
      'b.name'
    ])->join('user b', 'a.userId = b.id')
      ->orderby([['a.created_at', 'desc']])
      ->limit(1)
      ->get();

    return $result;
  }

  public function getUserPosts($params) {
    $id_user = $params[2];

    $result = $this->select([
      'id',
      'title',
      'date_format(created_at,"%d/%m/%Y") as fecha',
      'active',
    ])->where([
      ['userId', $id_user]
    ])->orderby([
      ['created_at', 'asc']
    ])->get();

    return $result;
  }

  public function savePost($data) {
    $this->values = [
      $data['user_id'],
      $data['title'],
      $data['body']
    ];

    $result = $this->create();

    return $result;
  }
}

?>
