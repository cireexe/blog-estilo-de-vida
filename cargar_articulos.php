<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$usuario = "id21671733_celina";
$contrasena = "Cbc.45422691";
$base_de_datos = "id21671733_blog";
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Crear la tabla de artículos si no existe
$sqlCrearTabla = "CREATE TABLE IF NOT EXISTS articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    contenido TEXT,
    imagen VARCHAR(255) -- Quité la coma que estaba aquí
)";

if (!$conexion->query($sqlCrearTabla)) {
    die("Error al crear la tabla de artículos: " . $conexion->error);
}

// Consulta para obtener los artículos
$sqlObtenerArticulos = "SELECT id, titulo, contenido, imagen FROM articulos";
$resultado = $conexion->query($sqlObtenerArticulos);

if ($resultado->num_rows > 0) {
    $articulos = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($articulos);
} else {
    echo json_encode([]);
}

$conexion->close();
?>
