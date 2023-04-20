<html>
<head>
</head>
<body>
    <h1>Hola, estas son tus facturas</h1>
    <?php
        $bd = mysqli_connect("localhost", "root", "", "proyecto");

        $resultado = mysqli_query($bd, "SELECT * FROM factura WHERE ID_Usuario=1 ");

        $num = 1;
        foreach($resultado as $fila) {
            $factura = $fila["ID_Factura"];
            echo "<h3 id='$factura'>Factura nº  " . $num . "</h3>";
            $div = "d" . $factura;
            echo "<div id='$div'></div>";
            $num = $num + 1;
		}
    ?>
        <?php
            $resultado2 = mysqli_query($bd, "SELECT * FROM factura WHERE ID_Usuario=1 ");
        ?>
        <script>
            let contenido;
        </script>
        <?php
            foreach($resultado2 as $fila2) {
                $id = $fila2["ID_Factura"];
                $fecha = $fila2["Fecha"];
                $total = $fila2["Total"];
        ?>
                <script>
                contenido = document.getElementById("d<?php echo $id; ?>");
			    contenido.insertAdjacentHTML("beforeend", "<p><?php echo "ID: $id - Fecha: $fecha - Total: $total"; ?></p><br>");
                </script>
                <?php
                $resultado3 = mysqli_query($bd, "SELECT * FROM factura_productos fp INNER JOIN productos p ON fp.ID_Producto=p.ID_Producto WHERE fp.ID_Factura=1 ");

                while($fila3 = mysqli_fetch_assoc($resultado3)) {
                    $id2 = $fila3["fp.ID_Factura"];
                    $cantidad = $fila3["fp.Cantidad"];
                    $subtotal = $fila3["Subtotal"];
                    $nombre = $fila3["Nombre"];
                    $marca = $fila3["Marca"];
                    $modelo = $fila3["Modelo"];
                    $categoria = $fila3["Categoria"];
                    $descripcion = $fila3["Descripcion"];
                    $img = $fila3["Imagen"];
                ?>
                    <script>
                    contenido2 = document.getElementById("d<?php echo $id2; ?>");
                    contenido2.insertAdjacentHTML("beforeend", "<p><?php echo '"Nombre: ' + $nombre + '"'; ?></p>");
                    </script>
                <?php
                }
            }
                ?>
</body>
</html>