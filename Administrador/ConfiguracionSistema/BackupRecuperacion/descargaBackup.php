<?php
$db_host = 'localhost'; //Host del Servidor MySQL
$db_name = 'dayclass'; //Nombre de la Base de datos
$db_user = 'root'; //Usuario de MySQL
$db_pass = ''; //Password de Usuario MySQL

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo

// Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
$salida_sql = $db_name . '_' . $fecha . '.sql';

//Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
$dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
system($dump, $output); //Ejecutamos el comando para respaldo

$zip = new ZipArchive(); //Objeto de Libreria ZipArchive

//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_zip = $db_name . '_' . $fecha . '.zip';

if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) { //Creamos y abrimos el archivo ZIP
	$zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
	$zip->close(); //Cerramos el ZIP
	unlink($salida_sql); //Eliminamos el archivo temporal SQL
	header("Location: $salida_zip"); // Redireccionamos para descargar el archivo ZIP
	unlink($salida_zip); //Eliminamos el archivo temporal ZIP
	header("Location: /DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=1");
} else {
	header("Location: /DayClass/Administrador/ConfiguracionSistema/BackupRecuperacion/backup.php?resultado=2");
}

?>