document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia al contenedor de artículos
    const articlesContainer = document.querySelector('.articles');

    // Cargar artículos desde el servidor
    fetch('cargar_articulos.php')
        .then(response => response.json())
        .then(articulos => {
            // Crear elementos HTML para cada artículo
            articulos.forEach(articulo => {
                const articleDiv = document.createElement('div');
                articleDiv.classList.add('article');
                articleDiv.innerHTML = `<h2>${articulo.titulo}</h2><p>${articulo.contenido}</p>`;
                articlesContainer.appendChild(articleDiv);
            });
        })
        .catch(error => console.error('Error al cargar los artículos:', error));
});
