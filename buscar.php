<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "blog";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener el término de búsqueda desde la URL
if (isset($_GET['busqueda'])) {
    $searchTerm = $conexion->real_escape_string($_GET['busqueda']);

    // Consulta SQL para obtener sugerencias de búsqueda
    $sqlSugerencias = "SELECT DISTINCT titulo FROM articulos WHERE titulo LIKE '%$searchTerm%' LIMIT 5";
    
    $sugerencias = array();

    if ($resultado = $conexion->query($sqlSugerencias)) {
        while ($fila = $resultado->fetch_assoc()) {
            $sugerencias[] = $fila;
        }
        $resultado->free();
    }

    echo json_encode($sugerencias);
}

$conexion->close();
?>
