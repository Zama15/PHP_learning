const app = {
  urlPosts: 'http://jsonplaceholder.typicode.com/posts',
  urlComments: 'http://jsonplaceholder.typicode.com/comments',
  urlUsers: 'http://jsonplaceholder.typicode.com/users',

  userId : "",

  loadPosts: async function() {
    const cont = $('#content');
    let html = '';

    let urlaux = '';
    if(this.userId !== ""){
      urlaux = `?userId=${ this.userId }`;
    }

    let r = await fetch(this.urlUsers)
              .then(response => response.json())
              .catch(error => console.error('Error:', error))

    fetch(this.urlPosts + urlaux)
      .then(response => response.json())
      .then(posts => {
        posts.forEach(post => {
          html += `
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">${ post.title }</h5>
                <h6 class="card-subtitle mb-2 text-muted">${ r[post.userId - 1].name }</h6>
                <p class="card-text">${ post.body }</p>
              </div>
              <div class="card-footer text-body-secondary">
                <button class="btn btn-link" type="button" id="btn-ver-comments-post${ post.id }" onclick="app.loadComment(${ post.id })">
                  Ver comentarios
                  <i class="bi bi-chevron-compact-down"></i>
                </button>
                <button class="btn btn-link d-none" type="button" id="btn-cer-comments-post${ post.id }" onclick="app.closeComment(${ post.id })">
                  Ocultar comentarios
                  <i class="bi bi-chevron-compact-up"></i>
                </button>
                <div class="spinner-border text-primary d-none float-end" role="status" id="spinner-comments-post${ post.id }">
                  <span class="visually-hidden">Loading...</span>
                </div>

                <div class="card d-none" id="card-comments-post${ post.id }">
                  <ul class="list-group list-group-flush" id="comments-post${ post.id }">
                  </ul>
                </div>
              </div>
            </div>
          `;
        });
        cont.html(html);
      }).catch(error => console.error('Error:', error))
  },

  loadUsers: function() {
    const Divusers = $('#authors');
    let html = '';
    Divusers.html(html);
    fetch(this.urlUsers)
      .then(response => response.json())
      .then(users => {
        users.forEach(user => {
          html += `
            <button type="button" class="list-group-item list-group-item-action" id="User${ user.id }" onclick="app.userPosts(${ user.id })">
              ${ user.username }<br>
              ${ user.email }
            </button>
          `;
        });
        Divusers.html(html);
      }).catch(error => console.error('Error:', error))
  },

  userPosts: function(userId) {
    $('#User' + userId).addClass('active');
    $('#User' + this.userId).removeClass('active');
    this.userId = userId;
    this.loadPosts();
  },

  loadComment: function(postId) {
    let html = '';
    const listaComentarios = $(`#comments-post${ postId }`);
    $(`#spinner-comments-post${ postId }`).removeClass('d-none', true);
    fetch(this.urlComments + `?postId=${ postId }`)
      .then(response => response.json())
      .then(comments => {
        comments.forEach(comment => {
          html += `
            <li class="list-group-item">
              <h6>${ comment.email }</h6>
              <p>${ comment.body }</p>
            </li>
          `;
        });
        listaComentarios.html(html);
        $(`#card-comments-post${ postId }`).removeClass('d-none', false);
        $(`#btn-ver-comments-post${ postId }`).addClass('d-none', false);
        $(`#btn-cer-comments-post${ postId }`).removeClass('d-none', true);
        $(`#spinner-comments-post${ postId }`).addClass('d-none', true);
      }).catch(error => console.error('Error:', error))
  },

  closeComment: function(postId) {
    $(`#comments-post${ postId }`).html('');
    $(`#card-comments-post${ postId }`).addClass('d-none', true);
    $(`#btn-ver-comments-post${ postId }`).removeClass('d-none', true);
    $(`#btn-cer-comments-post${ postId }`).addClass('d-none', true);
  }
}


window.onload = function() {
  app.loadPosts();
  app.loadUsers();
}
