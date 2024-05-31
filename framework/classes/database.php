<?php
namespace framework\classes;

use Mysqli;

class DataBase {
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_name;

  private $conn;

  public $s = ' * ';
  public $j = '';
  public $w = ' 1 ';
  public $o = '';
  public $l = '';

  public function __construct($dbh = DB_HOST, $dbu = DB_USER, $dbp = DB_PASS, $dbn = DB_NAME) {
    $this->db_host = $dbh;
    $this->db_user = $dbu;
    $this->db_pass = $dbp;
    $this->db_name = $dbn;
  }

  public function connect() {
    $this->conn = new Mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

    if ($this->conn->connect_error) {
      die('Connection failed: ' . $this->conn->connect_error);
    }

    $this->conn->set_charset('utf8');

    return $this->conn;
  }

  public function all(){
    return $this;
  }

  public function select($cc = []) {
    if (count($cc) > 0) {
      $this->s = implode(", ", $cc);
    }

    return $this;
  }

  public function join($jj = '', $on = '') {
    if ($jj != '' && $on != '') {
      $this->j .= " JOIN $jj ON $on";
    }

    return $this;
  }

  public function where($ww = []) {
    $this->w = '';

    if (count($ww) > 0) {
      foreach ($ww as $where) {
        $this->w .= "$where[0] LIKE '$where[1]' AND ";
      }
    }

    $this->w .= ' 1 ';

    $this->w = '(' . $this->w . ')';

    return $this;
  }

  public function orderBy($ob = []) {
    $this->o = '';

    if (count($ob) > 0) {
      foreach ($ob as $order) {
        $this->o .= "$order[0] $order[1],";
      }
      $this->o = 'ORDER BY ' . rtrim($this->o, ','); 
    }

    return $this;
  }

  public function limit($l = '') {
    $this->l = '';

    if ($l != '') {
      $this->l = "LIMIT $l";
    }

    return $this;
  }

  public function get() {
    $table = lcfirst(str_replace("framework\\models\\", "", get_class($this)));
    $table = $this->j == '' ? $table : "$table a";

    $sql = "SELECT $this->s FROM $table $this->j WHERE $this->w $this->o $this->l";
    $result = $this->conn->query($sql);

    $data = [];
    while ($f = $result->fetch_assoc()) {
      $data[] = $f;
    }

    return json_encode($data);
  }

  public function create() {
    $table = lcfirst(str_replace("framework\\models\\", "", get_class($this)));

    $attributes = implode(", ", $this->permited_params);
    $values = trim(str_replace('&', '?, ', str_pad("", count($this->permited_params), "&")), ', ');

    $sql = "INSERT INTO $table ($attributes) VALUES ($values)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param(str_pad("", count($this->permited_params), "s"), ...$this->values);
    $stmt->execute();

    return $stmt->insert_id;
  }

  public function update($sets) {
    $table = lcfirst(str_replace("framework\\models\\", "", get_class($this)));

    $attributes = [];
    foreach ($sets as $s) {
      $attributes[] = "$s[0] = ?";
      $this->values[] = $s[1];
    }
    $attributes = implode(", ", $attributes);

    $sql = "UPDATE $table SET $attributes WHERE $this->w";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param(str_pad("", count($sets), "s"), ...$this->values);

    return $stmt->execute();
  }
  
  public function updateOrCreate() {
    if (count($this->permited_params) !== count($this->values)) {
      $sets = [];
  
      foreach ($this->permited_params as $key => $param) {
        $sets[] = [$param, $this->values[$key]];
  
        if (empty($this->values[$key])) {
          unset($sets[$key]);
        }

        unset($this->values[$key]);
      }
      $this->where($this->values);

      $this->values = [];

      return $this->update($sets);
    } else {
      return $this->create();
    }
  }
}
?>
