<?php session_start(); ?>
<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/inicio_registro_CSS.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<h3>Iniciar sesión</h3>

<div class="logo">
    <img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/5be01d787b5e5b0001ebb6bb/0x0.png" title="logo">
</div>

<div class="container" action="Menu_izq.php">
    <form action="" method="post">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="text" class="form-control" name="user" placeholder="Email o Usuario">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
        </div><br>
        <div class="input-group">
            <button id="submit" type="submit" class="btn btn-default" name="submit">Iniciar sesión</button>
        </div>
    </form>
    <br>
</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $bd = mysqli_connect("localhost", "root", "", "proyecto");
    $usuario = $_POST["user"];
    $pass = $_POST["password"];
    $sql = "SELECT *
            FROM usuarios
            WHERE LOWER(Email) = LOWER('$usuario') OR LOWER(Usuario) = LOWER('$usuario')
            AND Contrasena = '$pass'";
    $resultados = mysqli_query($bd, $sql);

    // Comprobación de los resultados contando el número de filas
    if(mysqli_num_rows($resultados)) {
        foreach($resultados as $fila) {
            $_SESSION["ID_Usuario"] = $fila["ID_Usuario"];
            $_SESSION["Primer_inicio"] = 1;
        }
        header("Location: Inicio.php");
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> El usuario y/o la contraseña son incorrectos
        </div>
        <?php
    }
}

?>

<!--

<p>
    Hay que hacer un php en el que cuando haya un POST, se comparen los datos recibidos con los datos 
    que haya en la tabla de usuarios, el campo de usuario hay que compararlo con Email y Usuario.
<br><br>
    Hay que poner justo en el centro los campos
<br><br>
    El proceso de comprobación hay pasarlo a una página específica procesa.php
<br><br>
    En todas las páginas (o en el menú) poner una redirección a esta página si no 
    está creada las $_SESSION["usuario"]
<br><br>
    Si consigue iniciar sesión que le salga la tarjeta verde en el inicio.php en la redirección
</p>

-->

</body>
</html>