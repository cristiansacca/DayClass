<?php
// El mensaje
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');

$mensaje = "Fecha: $currentDateTime\r\nEsto es una prueba 1\r\nA ver si te llega correctamente 2\r\nUn saludo 3\r\n\n\n\nwww.ejemplocodigo.com";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

//direccion de mail destino, cambiar por el mail propio para porbar 
$destino = "lea220197@gmail.com";

// Enviamos el email
$rtdo = mail($destino, 'Probando la funcion MAIL desde PHP', $mensaje);


echo "EMAIL ENVIADO...";
echo "$rtdo";

?>