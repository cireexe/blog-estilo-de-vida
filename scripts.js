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

$(document).ready(function () {
    var searchForm = $("#searchForm");
    var resultadosDiv = $("#search-articulos");
    var sugerenciasDiv = $("#sugerencias");

    $("#busqueda").on("input", function () {
        var searchTerm = $(this).val();

        if (searchTerm.length >= 2) {
            $.ajax({
                url: "buscar_sugerencias.php",
                method: "GET",
                data: { busqueda: searchTerm },
                dataType: "json",
                success: function (sugerencias) {
                    mostrarSugerencias(sugerencias);
                },
                error: function () {
                    console.log("Error al obtener sugerencias de búsqueda.");
                },
            });
        } else {
            sugerenciasDiv.empty();
        }
    });

    searchForm.submit(function (event) {
        event.preventDefault();

        var searchTerm = $("#busqueda").val();

        // Realizar una solicitud AJAX para obtener los resultados de búsqueda
        $.ajax({
            url: "buscar.php",
            method: "GET",
            data: { busqueda: searchTerm },
            dataType: "json",
            success: function (resultados) {
                mostrarResultados(resultados);
            },
            error: function () {
                console.log("Error al realizar la búsqueda.");
            },
        });
    });

    // Función para mostrar sugerencias de búsqueda
    function mostrarSugerencias(sugerencias) {
        sugerenciasDiv.empty();

        if (sugerencias.length > 0) {
            sugerencias.forEach(function (sugerencia) {
                sugerenciasDiv.append('<p class="sugerencia">' + sugerencia.titulo + '</p>');
            });

            // Manejar clic en sugerencia
            $(".sugerencia").on("click", function () {
                var tituloSeleccionado = $(this).text();
                redirigirADetalleArticulo(tituloSeleccionado);
            });
        } else {
            sugerenciasDiv.append("<p>No hay sugerencias disponibles.</p>");
        }
    }

    // Función para mostrar resultados de búsqueda
    function mostrarResultados(resultados) {
        resultadosDiv.empty();
    
        if (resultados.length > 0) {
            resultados.forEach(function (resultado) {
                console.log(resultado); // Log para verificar la estructura de los resultados
                resultadosDiv.append(
                    '<article><h3><a href="detalle_articulo.php?id=' +
                        resultado.id +
                        '">' +
                        resultado.titulo +
                        '</a></h3><img src="carpeta_imagenes/' 
                );
            });
        } else {
            resultadosDiv.append("<p>No se encontraron resultados.</p>");
        }
    }

    // Función para redirigir al detalle del artículo
    function redirigirADetalleArticulo(titulo) {
        $.ajax({
            url: "buscar_articulo.php",
            method: "GET",
            data: { titulo: titulo },
            dataType: "json",
            success: function (articulo) {
                // Redirigir al detalle del artículo
                window.location.href = 'detalle_articulo.php?id=' + articulo.id;
            },
            error: function () {
                console.log("Error al obtener el artículo.");
            },
        });
    }
});
