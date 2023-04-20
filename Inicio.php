<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/general_css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
<body id="body">
    <?php
        include 'Encabezado.php';
        include 'Menu_izq.php';
    ?>
    <center><h2>¡¡¡BIENVENIDOS A INFORMATALIA!!!</h2></center><br>
    <p>Bienvenido a nuestra página web dedicada a la venta de productos tecnológicos. Somos una empresa comprometida con la innovación y la calidad en nuestros productos, y nos esforzamos por ofrecer siempre las últimas tendencias tecnológicas del mercado a precios competitivos.</p><br>
    <p>En nuestra tienda en línea encontrarás una amplia variedad de productos electrónicos de alta calidad, desde smartphones y laptops hasta periféricos. Trabajamos con las mejores marcas del mercado para garantizar la satisfacción de nuestros clientes.</p><br>
    <p>Nuestro objetivo es brindar una experiencia de compra fácil, rápida y segura para que puedas obtener los productos que necesitas con la mayor comodidad posible. Además, contamos con un equipo de expertos en tecnología dispuestos a ayudarte en todo momento para que puedas tomar la mejor decisión al momento de adquirir un producto.</p><br>
    <p>Explora nuestro catálogo en línea y descubre lo que tenemos para ofrecer. ¡En nuestra tienda encontrarás los productos tecnológicos más avanzados del mercado!</p><br><br>
    <center><p><b>¡¡¡MUCHAS GRACIAS POR SU CONFIANZA!!!</b><p></center>

    <?php
    // Para que la alerta de inicio correcto solo salga la primera vez
    if(isset($_SESSION["Primer_inicio"]) && $_SESSION["Primer_inicio"] == 1) {
        $bd = mysqli_connect("localhost", "root", "", "proyecto");
        $usuario = $_SESSION["ID_Usuario"];
        $sql = "SELECT Nombre
                FROM usuarios
                WHERE ID_Usuario = '$usuario'";
        $resultados = mysqli_query($bd, $sql);
        foreach ($resultados as $fila) {
            $nombre = $fila["Nombre"];
        }
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Correcto!</strong> Hola <?php echo $nombre; ?>, acabas de iniciar sesión
        </div>
    <?php
        $_SESSION["Primer_inicio"] = 0;
    }
    ?>

</body>
</html>