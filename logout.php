<?php
//Recupera la sesión existente
session_start();

//Cierra la sesión
session_destroy();

//Redirige a la página principal
header("Location:/DayClass/index.php");

?>