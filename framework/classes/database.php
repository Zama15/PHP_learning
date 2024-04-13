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
  public $w = ' 1 ';

  public function __construct($dbh = DB_HOST, $dbu = DB_USER, $dbp = DB_PASS, $dbn = DB_NAME) {
    $this->db_host = $dbh;
    $this->db_user = $dbu;
    $this->db_pass = $dbp;
    $this->db_name = $dbn;

    $this->connect();
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

  public function get() {
    $table = lcfirst(str_replace("framework\\models\\", "", get_class($this)));

    $sql = "SELECT $this->s FROM $table WHERE $this->w";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
  }
}
?>
