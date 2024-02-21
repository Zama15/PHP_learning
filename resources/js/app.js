const app = {
  urlDatos: 'data/autos.json',
  filtros: 'todos',

  cargarFichas() {
    const fichas = document.getElementById('fichas');
    let html = '';
    fetch(this.urlDatos)
      .then(response => response.json())
      .then (autos => {
        autos.forEach(auto => {
          if (this.filtros === 'todos' || auto.tipo === this.filtros) {
            html += `
              <div class="ficha">
                <img src="resources/imgs/${auto.foto}" alt="${auto.marca} ${auto.modelo}">
                <div class="datos">
                  <h3>${auto.marca}</h3>
                  <span>${auto.modelo}</span>
                  <span>${auto.anio}</span>
                  <p>
                    ${auto.motor.desplazamiento}
                    ${auto.motor.potencia}
                    ${auto.motor.rendimiento}
                  </p>
                </div>
              </div>
            `;
          }
        })
        fichas.innerHTML = html;
      }).catch(error => console.error('Error:', error));
  }
}

window.onload = function() {
  app.cargarFichas();
}
