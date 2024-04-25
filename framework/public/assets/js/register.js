const register = {
  routes: {
    register: '/register/register',
    initsession: '/session/initSession',
  },

  form: $('#register-form'),

  submit: function (event) {
    event.preventDefault();
    event.stopPropagation();
    
    let name = $('#name');
    let email = $('#email');
    let pass = $('#password');
    let passConf = $('#password-confirm');

    if (name.val() === '' || email.val() === '' || pass.val() === '' || passConf.val() === '') {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'All fields are required!',
      });
    } else if (pass.val() !== passConf.val()) {
      console.log('Passwords match');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Passwords do not match!',
      }).then(() => {
        passConf.val('');
        passConf.focus();
      });
    } else {
      console.log('Passwords do not match');
      this.register();
    }
  }, 

  register: function () {
    const data = new FormData(this.form[0]);

    fetch(this.routes.register, {
      method: 'POST',
      body: data,
    }).then( resp => {
      if (resp.ok) {
        location.href = this.routes.initsession;
      } else {
        $('#error').removeClass('d-none');
      }
    }).catch( err => ($('#error').removeClass('d-none')));
  }
}

window.onload = function () {
  console.log('Register page loaded');
}
