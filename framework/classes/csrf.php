<?php 
namespace framework\classes;

class Csrf {
  private $length = 32;
  private $token;
  private $token_expiration;
  private $expiration_time = 60 * 10;

  public function __construct() {
    session_start();

    if (!isset($_SESSION['csrf_token'])) {
      $this->generate();
      
      $_SESSION['csrf_token'] = [
        'token' => $this->token,
        'expiration' => $this->token_expiration
      ];

      session_write_close();
  
      return $this;
    }

    $this->token = $_SESSION['csrf_token']['token'];
    $this->token_expiration = $_SESSION['csrf_token']['expiration'];
    
    session_write_close();
    
    return $this;
  }

  private function generate() {
    $this->token = bin2hex(random_bytes($this->length));
    $this->token_expiration = time() + $this->expiration_time;
  }

  public static function validate($csrf_token, $validate_expiration = false) {
    $self = new self();

    if ($validate_expiration && $self->get_expiration() < time()) {
      return false;
    }

    if($self->get_token() !== $csrf_token) {
      return false;
    }

    return true;
  }

  public function get_token() {
    return $this->token;
  }

  public function get_expiration() {
    return $this->token_expiration;
  }
}
?>
