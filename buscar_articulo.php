<?php
// buscar_articulo.php

// Configuración de la conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "blog";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener el título del artículo desde la solicitud GET
$titulo = isset($_GET["titulo"]) ? $_GET["titulo"] : null;

if ($titulo) {
    // Realizar consulta para obtener el artículo por título
    $sqlObtenerArticulo = "SELECT * FROM articulos WHERE titulo = '$titulo'";
    $resultadoArticulo = $conexion->query($sqlObtenerArticulo);

    if ($resultadoArticulo->num_rows > 0) {
        // Obtener la información del artículo
        $articulo = $resultadoArticulo->fetch_assoc();

        // Devolver la información del artículo en formato JSON
        echo json_encode($articulo);
    } else {
        // Si no se encuentra el artículo, devolver un mensaje de error
        echo json_encode(["error" => "Artículo no encontrado"]);
    }
} else {
    // Si no se proporciona un título, devolver un mensaje de error
    echo json_encode(["error" => "Título no proporcionado"]);
}

$conexion->close();
?>

