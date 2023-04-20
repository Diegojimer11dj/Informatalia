<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <!-- Estilos -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Menu_izq_CSS.css">
    <!-- Iconos del menú -->
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<body id="body">

<?php
/*session_start(); // Inicia la sesión

if (isset($_SESSION['inicio_sesion'])) { // Verifica si la sesión "inicio" existe
    // Si la sesión existe, no hace nada
} else {
    header('Location: inicio_sesion.php'); // Si la sesión no existe, redirige al usuario a la página de inicio de sesión
}*/
?>

<?php
// Comprobar si se ha iniciado sesión
function comprobar_sesion(){
	if(!isset($_SESSION['ID_Usuario'])){	
		header("Location: Inicio_Sesion.php");
	}
}

comprobar_sesion();
?>

    <!-- Icono menú -->
    <header>
        <div class="icono_menu">
            <i class="fas fa-bars" id="abrir_menu"></i>
        </div>
        <h1>LOGO</h1>
        <?php
        if (isset($_COOKIE["sesion"])){
            
        } else {
    ?>
        <div class="buscador">
            <form class="navbar-form navbar-left" action="Busqueda.php" method="POST">
                <div class="input-group">
                    <input type="text" name="busqueda" class="form-control" placeholder="Busca en Informatalia">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <nav>
            <ul>
                <li>
                    <img id="foto_usu" src="fotos/usuario.png"></img>
                    <ul>
                        <li><a href="Perfil.php">Ver perfil</a></li>
                        <li><a href="Facturas.php">Ver facturas</a></li>
                        <!--Tendriamos que mandarlo al inicio de sesion y eliminar la sesion con una funcion de javascript que actue al hacer click-->
                        <li><a href="Cerrar_Sesion.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

            <script>
                var nav = document.querySelector('nav');

                nav.addEventListener('click', function(event) {
                var target = event.target;
                if (target.tagName === 'A' && target.parentNode.querySelector('ul')) {
                    event.preventDefault();
                    target.parentNode.classList.toggle('active');
                }
                });
            </script>
    <?php
        }
    ?>
    </header>

    <!-- Iconos laterales -->
    <div class="menu_lateral" id="menu_lateral">

        <div class="opciones_menu">	

            <!-- Icono inicio (Por defecto) -->
            <a href="inicio.php">
                <div class="opcion">
                    <i class="fas fa-house" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <!-- Icono teléfono -->
            <a href="telefonos.php">
                <div class="opcion">
                    <i class="fas fa-mobile" title="Teléfonos"></i>
                    <h4>Teléfonos</h4>
                </div>
            </a>

            <!-- Icono PC sobremesa -->
            <a href="sobremesa.php">
                <div class="opcion">
                    <i class="fas fa-computer" title="PC"></i>
                    <h4>PC Sobremesa</h4>
                </div>
            </a>
            
            <!-- Icono portátil -->
            <a href="portatiles.php">
                <div class="opcion">
                    <i class="fas fa-laptop" title="Portátiles"></i>
                    <h4>Portátiles</h4>
                </div>
            </a>

            <!-- Icono teclado -->
            <a href="teclados.php">
                <div class="opcion">
                    <i class="fas fa-keyboard" title="Teclados"></i>
                    <h4>Teclados</h4>
                </div>
            </a>

            <!-- Icono ratón -->
            <a href="ratones.php">
                <div class="opcion">
                    <i class="fas fa-computer-mouse" title="Ratones"></i>
                    <h4>Ratones</h4>
                </div>
            </a>

            <!-- Icono auriculares -->
            <a href="auriculares.php">
                <div class="opcion">
                    <i class="fas fa-headset" title="Auriculares"></i>
                    <h4>Auriculares</h4>
                </div>
            </a>

            <!-- Icono monitor -->
            <a href="monitores.php">
                <div class="opcion">
                    <i class="fas fa-tv" title="Monitores"></i>
                    <h4>Monitores</h4>
                </div>
            </a>

            <!-- Icono impresora -->
            <a href="impresoras.php">
                <div class="opcion">
                    <i class="fas fa-print" title="Impresoras"></i>
                    <h4>Impresoras</h4>
                </div>
            </a>
        </div>
    </div>

    <!-- Script externo -->
    <script src="js/menu_izq_js.js"></script>

</body>
</html>