const app = {
  routes: {
    home: '/home',
    initsession: '/session/initSession',
    register: '/register/register',

    prevposts: '/posts/getPosts',
  },

  user: {},
  pp: $('#prev-posts'),

  previusPosts: function () {
    let html = '<p>There are no posts</p>';
    this.pp.html('');

    fetch(this.routes.prevposts)
    .then( response => response.json())
    .then( posts => {
      html = '';
      console.log(posts);
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
  }
}

window.onload = function () {
  app.previusPosts();
}
