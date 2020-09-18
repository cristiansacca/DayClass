<?php
include "../../databaseConection.php";

$consulta1 = $con->query("SELECT * FROM justificativo WHERE fechaRevision IS NULL ORDER BY fechaPresentacion");

echo ($consulta1->num_rows);

?>