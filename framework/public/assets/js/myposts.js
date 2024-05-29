const myposts = {
  routes: {
    home: '/',
    getMyPosts: '/userposts/getmyposts',
  },

  tbl: $('#tbl-my-posts'),

  loadMyPosts: function(text_filter = "") {
    fetch(this.routes.getMyPosts + `/${app.user.id}/${text_filter}`)
    .then( response => response.json())
    .then( posts => {
      let html = '';
      for (let post of posts) {
        html += `
          <tr>
            <td>${ post.fecha }</td>
            <td>${ post.title }</td>
            <td> ... </td>
          </tr>
        `;
      }
      this.tbl.html(html);
    }).catch( err => console.error('Error: ', err));
  }
}

$(function() {
  myposts.loadMyPosts();
})
