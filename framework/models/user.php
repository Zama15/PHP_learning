<?php 
namespace framework\models;

use framework\models\model;

class User extends Model {
  protected $table;
  protected $permitetd_params = ['name', 'email', 'passwd'];

  public $values = [];

  public function __construct() {
    parent::__construct();

    $this->table = $this->connect();
  }

  public function newUser($data) {
    $this->values = [
      $data['name'],
      $data['email'],
      sha1($data['password']),
    ];

    $result = $this->create();

    return $result;
  }

  public function authUser($data, $session = false) {
    $name = $data['name'];
    $passwd = $session ? $data['passwd'] : sha1($data['passwd']);

    $result = $this->where([['name', $name], ['passwd', $passwd]])->get();

    return $result;
  }
}
?>
