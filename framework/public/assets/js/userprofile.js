const userprofile = {
  routes: {
    home: '/',
    myprofile: '/user/getMyUser',
    editprofile: '/user/upsert',
  },

  mp: $('#profile'),
  form: $('#edit-form'),
  
  myprofile: function () {
    fetch(this.routes.myprofile + `/${app.user.id}`)
    .then( response => response.json())
    .then( user => {
      let rol = '';

      if (user[0].tipo == 0) {
        rol = 'Admin';
      } else if (user[0].tipo == 1) {
        rol = 'Member';
      } else if (user[0].tipo == 2) {
        rol = 'User';
      }

      let html = `
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-12 col-xl-4">
            <div style="border-radius: 15px;">
              <div class="text-center">
                <div class="mt-3 mb-4">
                  <i class="bi bi-person-bounding-box" style="font-size: 9rem;">
                  </i>
                </div>
                <h4 class="mb-2">${ user[0].name }</h4>
                <p class="text-muted mb-4">
                  ${ user[0].email }
                  <span class="mx-2">|</span>
                  ${ rol }
                </p>
                <a data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-rounded btn-lg" onclick="userprofile.editprofile()">
                  Edit Profile
                </a>
                <div class="mt-4">
                  <a data-mdb-button-init data-mdb-ripple-init class="btn btn-link" onclick="location.href='${this.routes.home}'">
                    Back
                  </a>
                </div>
              </div>
            </div>
    
          </div>
        </div>
      `;
      this.mp.html(html);
    }).catch( err => console.error('Error: ', err));
  },

  editprofile: function () {
    fetch(this.routes.myprofile + `/${app.user.id}`)
    .then( response => response.json())
    .then( user => {
      this.swalForm(user[0].id, user[0].name, user[0].email);
    }).catch( err => console.error('Error: ', err));
  },

  swalForm: function (id, name = '', email = '', pswrd = '', pswrdConfirm = '', cpswrd = '') {
    Swal.fire({
      title: 'Edit Profile',
      html: `
        <div class="mt-t">
          <div class="text-center">
            <div class="mt-3 mb-4">
              <i class="bi bi-person-bounding-box" style="font-size: 9rem;">
              </i>
            </div>
            <h6>Edita solo los campos que desees cambiar</h6>
          </div>
          <form id="edit-form">
            <input type="hidden" name="id" id="id" value="${id}">
            <div class="form-group input-group mb-3">
              <label for="name" class="input-group-text"><i class="bi bi-person"></i></label>
              <input type="text" name="name" id="name" class="form-control" value="${name || ''}">
            </div>
            <div class="form-group input-group mb-3">
              <label for="email" class="input-group-text"><i class="bi bi-envelope"></i></label>
              <input type="email" name="email" id="email" class="form-control" value="${email || ''}">
            </div>
            <div class="form-group input-group mb-3">
              <label for="pswrd" class="input-group-text"><i class="bi bi-lock"></i></label>
              <input type="password" name="pswrd" id="pswrd" class="form-control" placeholder="nueva contraseña" value="${pswrd || ''}">
            </div>
            <div class="form-group input-group mb-3">
              <label for="pswrd-confirm" class="input-group-text"><i class="bi bi-lock"></i></label>
              <input type="password" name="pswrd-confirm" id="pswrd-confirm" class="form-control" placeholder="confirmar nueva contraseña" value="${pswrdConfirm || ''}">
            </div>
            <div class="form-group input-group my-5">
              <label for="cpswrd" class="input-group-text"><i class="bi bi-lock-fill"></i></label>
              <input type="password" name="cpswrd" id="cpswrd" class="form-control" placeholder="contraseña actual" value="${cpswrd || ''}">
            </div>
          </form>
        </div>
      `,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: 'Save',
      confirmButtonColor: '#28a745',
      cancelButtonText: 'Cancel',
      cancelButtonColor: '#dc3545',
      preConfirm: () => {
        let id = $('#id');
        let name = $('#name');
        let email = $('#email');
        let pass = $('#pswrd');
        let passConf = $('#pswrd-confirm');
        let currentPass = $('#cpswrd');
    
        if (currentPass.val() === '') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Current password is required!',
          }).then(() => {
            this.swalForm(id.val(), name.val(), email.val(), pass.val(), passConf.val());
          });
        } else if (pass.val() !== passConf.val()) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Passwords do not match!',
          }).then(() => {
            this.swalForm(id.val(), name.val(), email.val(), pass.val(), passConf.val(), currentPass.val());
          });
        } else {
          let params = new URLSearchParams();
          params.append('id', id.val());
          params.append('name', name.val());
          params.append('email', email.val());
          params.append('password', pass.val());
          params.append('cpassword', currentPass.val());
          this.editProfile(params);
        }
      }
    });
  },

  editProfile: function (data) {
    fetch(this.routes.editprofile, {
      method: 'POST',
      body: data,
    }).then( response => response.json())
    .then( resp => {
      if (resp.r !== false) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Profile updated!',
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Credentials are incorrect!',
        }).then(() => {
          this.swalForm(data.get('id'), data.get('name'), data.get('email'), data.get('pswrd'), data.get('pswrd-confirm'), data.get('cpswrd'));
        });
      }
    }).catch( err => console.error('Error: ', err));
  }
}

$(function() {
  userprofile.myprofile();
})
