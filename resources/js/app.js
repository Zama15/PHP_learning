const app = {
  urlDatos: 'data/autos.json',
  filtro: 'todos',

  modalFoto: document.querySelector('.modal'),
  foto: document.getElementById('foto'),

  cargarFichas() {
    const fichas = document.getElementById('fichas');
    let html = '';
    fetch(this.urlDatos)
      .then(response => response.json())
      .then (autos => {
        autos.forEach(auto => {
          if (this.filtro === 'todos' || auto.tipo === this.filtro) {
            keys = Object.keys(auto);
            lastKey = keys[keys.length - 1];
            data = auto[lastKey];
            let datos ='';
            for (let key in data) {
              datos += `<span>${data[key]}</span>`;
            }
            html += `
              <div class="ficha">
                <img src="resources/imgs/${auto.foto}" alt="${auto.marca} ${auto.modelo}" onclick=app.verFoto('${auto.foto}')>
                <div class="datos">
                  <h3>${auto.marca}</h3>
                  <span>${auto.modelo}</span>
                  <span>${auto.anio}</span>
                  <p>${datos}</p>       
                </div>
              </div>
            `;
          }
        })
        fichas.innerHTML = html;
      }).catch(error => console.error('Error:', error));
  },

  verFoto(foto) {
    this.foto.src = `resources/imgs/${foto}`;
    this.modalFoto.style.display = 'block';
  }
}

window.onload = function() {
  app.cargarFichas();

  const amenu = document.querySelectorAll("a.menu");

  amenu.forEach(a => {
    a.addEventListener('click', e => {
      e.preventDefault();
      app.filtro = a.getAttribute('data-filtro');
      app.cargarFichas();
    });
  });

  document.getElementById('close-modal').addEventListener('click', () => {
    app.modalFoto.style.display = 'none';
  });
}

window.onclick = event => {
  if (event.target == app.modalFoto) {
    app.modalFoto.style.display = 'none';
  }
}
