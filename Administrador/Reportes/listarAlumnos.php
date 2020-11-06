<?php
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];


$consulta1 = $con->query("SELECT usuario.id, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.legajoUsuario FROM usuario, alumnocursoactual, curso WHERE curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.fechaDesdeAlumCurAc = curso.fechaDesdeCursado AND alumnocursoactual.fechaHastaAlumCurAc = curso.fechaHastaCursado AND alumnocursoactual.alumno_id = usuario.id ORDER BY usuario.apellidoUsuario ASC");
$alumnos = array();

while($resultado1 = $consulta1->fetch_assoc()) {
    $alumnos[] = array(
        'id'=> $resultado1['id'],
        'nombreUsuario'=> $resultado1['nombreUsuario'],
        'apellidoUsuario'=> $resultado1['apellidoUsuario'],
        'legajoUsuario'=> $resultado1['legajoUsuario']
    );
}

$myJSON = json_encode($alumnos);

echo $myJSON;

?>