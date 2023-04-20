<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/General_CSS.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body id="body">
    <!-- Incluir menú y abrir la base de datos -->
    <?php
        include 'Menu_izq.php';
        $bd = mysqli_connect("localhost", "root", "", "proyecto");
        // Declaro la busqueda recibida
        if(isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST["busqueda"])) {
            $busqueda = $_POST["busqueda"];
            $_SESSION["busqueda"] = $busqueda;
        }
        if(isset($_SESSION["busqueda"])) {
            $busqueda = $_SESSION["busqueda"];
        }
    ?>

    <div class="introduccion">
        <h2><?php echo $busqueda; ?></h2><br>
    </div>
    <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#filtros">Filtros</button>
    <span class="well well-sm" id="productos_encontrados"></span>
    <br>
    <form action="#" method="POST">
    <div id="filtros" class="collapse in">
        <h4>Filtros:</h4><br>
        <label>Precio:</label>
        <div class="price-bar">
            <?php
                $sql = "SELECT MAX(precio) AS resultado
                        FROM productos
                        WHERE Nombre LIKE '%$busqueda%'
                        OR Marca LIKE '%$busqueda%'";
                $resultados = mysqli_query($bd, $sql);
                foreach ($resultados as $fila) {
                    $max = $fila["resultado"];
                }
            ?>
            <div class="contenedor_minimo">
                <input type="range" min="0" max="<?php echo $max - 1; ?>" class="slider" id="minPrice">
                <div class="contenedor_precio">
                    <input type="number" name="precio_min" id="minCaja">
                </div>
            </div>
            <div class="contenedor_maximo">
                <input type="range" min="1" max="<?php echo $max + 1; ?>" class="slider" id="maxPrice">
                <div class="contenedor_precio">
                    <input type="number" name="precio_max" id="maxCaja">
                </div>
            </div>
                <script>
                    const minPrice = document.getElementById("minPrice");
                    const maxPrice = document.getElementById("maxPrice");

                    minPrice.addEventListener("input", updatePrice);
                    maxPrice.addEventListener("input", updatePrice);

                    var minCaja = document.getElementById("minCaja");
                    var maxCaja = document.getElementById("maxCaja");

                    function updatePrice() {
                        const min = parseInt(minPrice.value);
                        const max = parseInt(maxPrice.value);
                        minCaja.value = min;
                        maxCaja.value = max;
                    }
                </script>
        </div>
        <br><label>Marca:</label>
        <div class="filtro_marcas">
            <?php
            $sql = "SELECT DISTINCT Marca
                    FROM productos
                    WHERE Nombre LIKE '%$busqueda%'
                    OR Marca LIKE '%$busqueda%'";
            $resultados = mysqli_query($bd, $sql);
            foreach ($resultados as $fila) {
                echo "<label class='checkbox_marcas'><input type='checkbox' name='marcas[]' value='" . $fila['Marca'] . "'> " . $fila['Marca'] . "</label><br>";
            }
            ?>
        </div>
        <div class="boton_filtro">
            <br><input type="submit" class="btn btn-primary" value="filtrar" name="filtrar" id="boton_filtrar">
        </div>
        </form>
        
    </div>
    <div class="productos">
        <!-- Tabla que el número de columnas dependa de el tamaño en horizontal de la ventana.
            Hay que tener en cuenta los filtros, los filtros solo se aplican si se pulsa el
            boton de submit, por lo que nos llegaría en forma de POST[]
        -->
        
        <div class="tabla">
        <table>
            <thead>
            </thead>
            <tbody>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["filtrar"])) {
                /* Declarar los inputs del filtro recibido */
                if(isset($_POST["marcas"])) {
                    $marcas_seleccionadas = $_POST["marcas"];
                    $marcas_filtro = implode("', '", $marcas_seleccionadas);
                }
                $precio_min = $_POST["precio_min"];
                $precio_max = $_POST["precio_max"];
                /* Primera linea obligatoria */
                $sql = "SELECT *
                        FROM productos
                        WHERE Nombre LIKE '%$busqueda%'";
                /* Si se ha indicado algún checkbox */
                if(empty($marcas_seleccionadas)) {
                    $sql .= " OR Marca LIKE '%$busqueda%'";
                } else {
                    $sql .= " AND Marca IN ('$marcas_filtro')";
                }
                /* Si se ha indicado algún precio */
                if(!empty($precio_min)) {
                    $sql .= " AND Precio BETWEEN $precio_min AND $precio_max";
                }
            } else {
                $sql = "SELECT *
                        FROM productos
                        WHERE Nombre LIKE '%$busqueda%'
                        OR Marca LIKE '%$busqueda%'";
            }
            $resultados = mysqli_query($bd, $sql);
            foreach ($resultados as $fila) {
            ?>
                <!--Ejecutar función si se pulsa-->
                <tr onclick="">
                    <td>
                        <div class="celda_imagen">
                            <p><?php echo "<img src='" . $fila['Imagen'] . "' title='" . $fila['Nombre'] . "' " ?></p>
                        </div>
                        <div class="celda_marcaynombre">
                            <p><?php echo $fila['Marca'] . " - " . $fila['Nombre']; ?></p>
                        </div>
                        <div class="celda_precio">
                            <p class="well well-sm"><?php echo $fila['Precio'] . " €"; ?></p>
                        </div>
                    </td>
                </tr>
            <?php
            }
            echo "<input type='hidden' id='productos_total' value='" . mysqli_num_rows($resultados) . "'></div>";
        ?>
        <script>
            let contador = document.getElementById("productos_encontrados");
            let contador2 = document.getElementById("productos_total");
            contador.innerHTML = contador2.value + " artículos";
        </script>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>