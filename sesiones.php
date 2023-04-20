<?php
// Añadir este documento a todas las paginas con un require para obligar a que se tiene el usuario
?>
<?php
function comprobar_sesion(){
	if(!isset($_SESSION['usuario'])){	
		header("Location: Inicio_Sesion.php");
	}
}

comprobar_sesion();
?>