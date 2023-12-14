<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la conexión a la base de datos
    $host = "localhost";
    $usuario = "id21671733_celina";
    $contrasena = "Cbc.45422691";
    $base_de_datos = "id21671733_blog";

    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Recoger datos del formulario
    $titulo = $_POST["articleTitle"];
    $contenido = $_POST["articleContent"];
    $seccion = $_POST["articleSection"]; // Agrega esta línea para recoger la sección

    // Subir imagen
    $directorioImagenes = "carpeta_imagenes/"; // Cambia a tu directorio de imágenes

    // Verificar si se ha subido una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = $_FILES['imagen']['name'];
        $rutaImagen = $directorioImagenes . $nombreImagen;

        // Mover la imagen al directorio
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);

        // Insertar artículo en la base de datos con la ruta de la imagen y la sección
        $sqlInsertarArticulo = "INSERT INTO articulos (titulo, contenido, imagen, seccion) VALUES ('$titulo', '$contenido', '$rutaImagen', '$seccion')";

        // Ejecutar la consulta
        if ($conexion->query($sqlInsertarArticulo) === TRUE) {
            // Obtener el ID del artículo recién insertado
            $idArticuloInsertado = $conexion->insert_id;

            echo "Artículo subido con éxito.";

            // Redirigir al inicio con el ID del artículo
            header("Location: index.php?id=$idArticuloInsertado");
            exit();
        } else {
            echo "Error al subir el artículo: " . $conexion->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }

    $conexion->close();
}
?>
