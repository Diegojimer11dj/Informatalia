<html>
<head>
</head>
<body>
    <h1>Hola</h1>
    <?php
        session_start();
        session_destroy();
        $_SESSION["importe"] = null;
        setcookie(session_name(), 0, time() - 1000);
        header("Location: Inicio_Sesion.php");
    ?>
</body>
</html>