<?php
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];

$selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'ALUMNO'");
$permiso = $selectPermiso->fetch_assoc();
$id_permiso = $permiso["id"];

$consulta1 = $con->query("SELECT usuario.id, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.legajoUusario FROM usuario, alumnocursoactual, curso WHERE curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.fechaDesdeAlumCurAc = curso.fechaDesdeCursado AND alumnocursoactual.fechaHastaAlumCurAc = curso.fechaHastaCursado AND alumnocursoactual.alumno_id = usuario.id AND usuario.id_permiso = '$id_permiso' ORDER BY alumno.apellidoAlum ASC");
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