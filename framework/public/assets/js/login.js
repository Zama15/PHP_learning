const login = {
  routes: {
    home: '/',
    login: '/session/userAuth',
    register: '/register',
  },

  form: $('#login-form'),

  submit: function (event) {
    event.preventDefault();
    event.stopPropagation();
    
    let email = $('#name');
    let pass = $('#passwd');

    if (email.val() === '' || pass.val() === '') {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'All fields are required!',
      });
    } else {
      this.login();
    }
  }, 

  login: function () {
    const data = new FormData(this.form[0]);

    fetch(this.routes.login, {
      method: 'POST',
      body: data,
    }).then( response => response.json())
    .then(resp => {
      if (resp.r ) {
        location.href = this.routes.home;
      } else {
        $('#error').removeClass('d-none');
      }
    }).catch( err => console.error(err));
  }
}
