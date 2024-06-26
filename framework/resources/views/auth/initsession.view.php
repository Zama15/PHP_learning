<?php 
  include_once LAYOUTS . 'header.php';
  setHeader($d);
?>

<div class="container">
  <div class="card mt-t w-50 mx-auto">
    <div class="card-body">
      <h5 class="card-title">Iniciar sesión</h5>
      <form id="login-form" onsubmit="login.submit(event)">
        <div class="form-group input-group mb-3">
          <label for="name" class="input-group-text"><i class="bi bi-person-fill"></i></label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Xx_name_xX">
        </div>
        <div class="form-group input-group mb-3">
          <label for="passwd" class="input-group-text"><i class="bi bi-lock-fill"></i></label>
          <input type="password" name="passwd" id="passwd" class="form-control" placeholder="***4">
        </div>
        <div class="d-grid gap-2 my-2">
          <small class="form-text text-danger d-none" id="error">Usuario o contraseña incorrectos</small>
          <button type="submit" class="btn btn-primary" id="submit">Iniciar sesión</button>
          <a href="/register" class="btn btn-link text-center" id="register">Registrarse</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'login.js');
  closeFooter();
?>
