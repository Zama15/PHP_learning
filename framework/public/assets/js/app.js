const app = {
  routes: {
    home: '/home',
    initsession: '/session/initSession',
    prevposts: '/posts/getPosts',
    lastPost: '/posts/getLastPost',
  },

  user: {
    session: false,
    id: '',
    name: '',
    tipo: '',
  },
  pp: $('#prev-posts'),
  lp: $('#content'),

  previusPosts: function () {
    let html = '<p>There are no posts</p>';
    this.pp.html('');

    fetch(this.routes.prevposts)
    .then( response => response.json())
    .then( posts => {
      html = '';
      for (let post of posts) {
        html += `
          <button onclick="app.openPosts(event, ${ posts.id }, this)"
            class="list-group-item list-group-item-action">
            <div class="w-100 border-bottom d-flex justify-content-between">
              <span class="mb-1">${ post.title }</span>
              <small>${ post.fecha }</small>
            </div>
            <p class="mb-1">${ post.name }</p>
          </button>
        `;
      };
      this.pp.html(html);
    }).catch( err => console.error('Error: ', err));
  },

  lastPost: function () {
    let html = '<p>There are no posts</p>';
    this.lp.html('');

    fetch(this.routes.lastPost)
    .then( response => response.json())
    .then( post => {
      if(post.length > 0) {
        html = `
          <div class="w-100 p-4 shadow rounded bg-body">
            <h5 class="mb-1">${ post[0].title }</h5>
            <small class="text-muted">
              ${ post[0].fecha } by ${ post[0].name }
            </small>
            <p class="py-3 border-bottom lh-sm fs-5 mb-0" style="text-align: justify;">
              ${ post[0].body }
            </p>
          </div>
        `;
      }
      this.lp.html(html);
    }).catch( err => console.error('Error: ', err));
  },
}

window.onload = function () {
  app.previusPosts();
  app.lastPost();
}
