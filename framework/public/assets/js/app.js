const app = {
  routes: {
    home: '/home',
    initsession: '/session/initSession',

    prevposts: '/posts/getPosts',
  },

  user: {},
  pp: $('#prev-posts'),

  previusPosts: function (callback) {
    let html = '<p>There are no posts</p>';
    this.pp.html('');

    fetch(response => {
      console.log(response);

      return response.json();
    }).then( posts => {
      posts.forEach( post => {
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
      });
      this.pp.html(html);
    }).catch( err => console.error('Error: ', err));
  }
}
