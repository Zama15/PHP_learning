<?php 
namespace framework\models;

use framework\models\model;

class User extends Model {
  protected $table;
  protected $permited_params = ['name', 'email', 'passwd'];

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

  public function authUserById($data) {
    $id = $data['id'];
    $passwd = sha1($data['passwd']);

    $result = $this->where([
      ['id', $id],
      ['passwd', $passwd]
    ])->get();

    return $result;
  }

  public function getUser($params) {
    $id_user = $params[2];

    $result = $this->select([
      'id',
      'name',
      'email',
      'date_format(created_at,"%d/%m/%Y") as fecha',
      'activo',
      'tipo'
    ])->where([
      ['id', $id_user]
    ])->get();

    return $result;
  }

  public function upsertUser($params) {
    $this->values = [
      empty($params['name']) ? '' : $params['name'],
      empty($params['email']) ? '' : $params['email'],
      empty($params['password']) ? '' : sha1($params['pswrd']),
      ['id', $params['id']],
      ['passwd', sha1($params['cpassword'])]
    ];

    $result = $this->updateOrCreate();

    return $result;
  }
}
?>
