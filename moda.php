<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Moda - Tu Blog de Estilo de Vida</title>

</head>

<body>
>
    <header>
        <div>
           <a href="index.php"> <img src="images/logo.png" alt="Logo de tu blog" style="height: 40px; width: auto; float: left; border-radius: 50px;"></a>
        </div>
        <section>
            <a href="viaje.php">Viaje</a>
            <a href="comida.php">Comida</a>
            <a href="moda.php">Moda</a>
            <a href="mascotas.php">Mascotas</a>
            <a href="form_articulo.html">Subir</a>
        </section>
    </header>


    <section id="seccion-articulos">
        <h3>ARTÍCULOS DE MODA:</h3>

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

        // Consulta para obtener los artículos de moda
        $sqlObtenerModa = "SELECT id, titulo, contenido, imagen FROM articulos WHERE seccion = 'moda' ORDER BY id DESC LIMIT 5";

        $resultado = $conexion->query($sqlObtenerModa);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<article>";
                echo "<h3><a href='detalle_articulo.php?id=" . $fila["id"] . "'>" . $fila["titulo"] . "</h3>";
            
                if (isset($fila["imagen"])) {
                    echo "<img src='" . $fila["imagen"] . "' alt='Imagen del artículo'>";
                }
            
                echo "</article>";
            }
        } else {
            echo "No hay artículos de moda disponibles.";
        }
        $conexion->close();
        ?>
    </section>


    <footer>
        © 2023 Tu Blog de Estilo de Vida. Todos los derechos reservados.
    </footer>

    <script src="script.js"></script>

</body>

</html>
