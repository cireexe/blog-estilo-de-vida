<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tu Blog de Estilo de Vida</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Agrega aquí tus enlaces a hojas de estilo (CSS) si es necesario -->
</head>

<body>

    <!-- Banner con Logo -->
    <header>
        <div>
           <a href="index.php"> <img src="images/logo.png" alt="Logo de tu blog" style="height: 40px; width: auto; float: left; border-radius: 50px;"></a>
        </div>
        <section>
            <a href="viaje.php">viaje</a>
            <a href="comida.php">Comida</a>
            <a href="moda.php">Moda</a>
            <a href="mascotas.php">Mascotas</a>
            <a href="form_articulo.html">Subir</a>
        </section>
    </header>

    <!-- Barra de Búsqueda -->
    <section>
        <form action="/buscar" method="get">
            <input type="text" id="busqueda" name="busqueda" placeholder="Buscar en el blog...">
            <button type="submit">Buscar</button>
        </form>
    </section>

    <!-- Sección de Artículos -->
    <section id="seccion-articulos">
        <h3>ULTIMOS ARTICULOS:</h3>

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

        // Consulta para obtener los últimos artículos

        $sqlObtenerArticulos = "SELECT id, titulo, contenido, imagen FROM articulos ORDER BY id DESC LIMIT 5";


        $resultado = $conexion->query($sqlObtenerArticulos);

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
            echo "No hay artículos disponibles.";
        }
        $conexion->close();
        ?>
    </section>

    <!-- Pie de Página (opcional) -->
    <footer>
        © 2023 Tu Blog de Estilo de Vida. Todos los derechos reservados.
    </footer>

    <script src="script.js"></script>

</body>

</html>