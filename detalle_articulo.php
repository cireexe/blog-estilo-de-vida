<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Detalle del Artículo - Tu Blog de Estilo de Vida</title>
    <!-- Agrega aquí tus enlaces a hojas de estilo (CSS) si es necesario -->
    <style>
       body {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            text-align: left;
            margin-bottom: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 8px;
        }

        footer {
            margin-top: 40px;
        }
    </style>
</head>

<body>

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

    // Obtener el ID del artículo de la URL si está definido
    $idArticulo = isset($_GET["id"]) ? $_GET["id"] : null;

    if ($idArticulo) {
        // Realizar consulta para obtener el artículo completo
        $sqlObtenerArticulo = "SELECT * FROM articulos WHERE id = $idArticulo";
        $resultadoArticulo = $conexion->query($sqlObtenerArticulo);

        if ($resultadoArticulo->num_rows > 0) {
            $articulo = $resultadoArticulo->fetch_assoc();

            // Mostrar el artículo completo
            echo "<h1>" . $articulo["titulo"] . "</h1>";

            if (isset($articulo["imagen"])) {
                echo "<img src='" . $articulo["imagen"] . "' alt='Imagen del artículo'>";
            }

            echo "<p>" . $articulo["contenido"] . "</p>";
        } else {
            echo "Artículo no encontrado.";
        }
    } else {
        echo "Artículo no seleccionado.";
    }

    $conexion->close();
    ?>

    <!-- Pie de Página (opcional) -->
    <footer>
        © 2023 Tu Blog de Estilo de Vida. Todos los derechos reservados.
    </footer>

    <script src="script.js"></script>

</body>

</html>