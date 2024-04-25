<?php 
  include_once LAYOUTS . 'header.php';
  setHeader($d);
?>

<div class="container">
  <div class="card mt-t w-50 mx-auto">
    <div class="card-body">
      <h5 class="card-title">Registrarse</h5>
      <form id="register-form" onsubmit="register.submit(event)">
        <div class="form-group input-group mb-3">
          <label for="name" class="input-group-text"><i class="bi bi-person-fill"></i></label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Xx_name_xX">
        </div>
        <div class="form-group input-group mb-3">
          <label for="email" class="input-group-text"><i class="bi bi-envelope-fill"></i></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="name@hotmail.com">
        </div>
        <div class="form-group input-group mb-3">
          <label for="password" class="input-group-text"><i class="bi bi-lock-fill"></i></label>
          <input type="password" name="password" id="password" class="form-control" placeholder="***4">
        </div>
        <div class="form-group input-group mb-3">
          <label for="password-confirm" class="input-group-text"><i class="bi bi-lock-fill"></i></label>
          <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="***4">
        </div>
        <div class="d-grid gap-2 my-2">
          <small class="form-text text-danger d-none" id="error">
            Hubo un error al registrarse, inténtelo de nuevo
          </small>
          <button type="submit" class="btn btn-primary" id="submit">Registrarse</button>
          <a href="/Session/initsession" class="btn btn-link text-center" id="register">Iniciar sesión</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
  include_once LAYOUTS . 'footer.php';
  setFooter($d, 'register.js');
  closeFooter();
?>
