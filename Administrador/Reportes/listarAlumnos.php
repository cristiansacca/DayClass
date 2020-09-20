<?php
include "../../databaseConection.php";

$id_curso = $_POST['id_curso'];
$consulta1 = $con->query("SELECT alumno.id, alumno.nombreAlum, alumno.apellidoAlum, alumno.legajoAlumno FROM alumno, alumnocursoactual, curso WHERE curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.fechaDesdeAlumCurAc = curso.fechaDesdeCursado AND alumnocursoactual.fechaHastaAlumCurAc = curso.fechaHastaCursado AND alumnocursoactual.alumno_id = alumno.id ORDER BY alumno.apellidoAlum ASC");
$alumnos = array();

while($resultado1 = $consulta1->fetch_assoc()) {
    $alumnos[] = array(
        'id'=> $resultado1['id'],
        'nombreAlum'=> $resultado1['nombreAlum'],
        'apellidoAlum'=> $resultado1['apellidoAlum'],
        'legajoAlumno'=> $resultado1['legajoAlumno']
    );
}

$myJSON = json_encode($alumnos);

echo $myJSON;

?>