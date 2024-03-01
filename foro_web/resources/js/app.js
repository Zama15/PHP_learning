const app = {
  urlPosts: 'http://jsonplaceholder.typicode.com/posts',
  urlComments: 'http://jsonplaceholder.typicode.com/comments',
  urlUsers: 'http://jsonplaceholder.typicode.com/users',

  loadPosts: async function() {
    const cont = $('#content');
    let html = '';

    let r = await fetch(this.urlUsers)
              .then(response => response.json())
              .catch(error => console.error('Error:', error))

    fetch(this.urlPosts)
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
                <button class="btn btn-link" type="button" id="btn-ver-comments-post${ post.id }" onclick="app.loadComments(${ post.id })">
                  Ver comentarios
                </button>
              </div>
            </div>
          `;
        });
        cont.html(html);
      }).catch(error => console.error('Error:', error))
  }  
}


window.onload = function() {
  app.loadPosts();
}
