<?php
include "../../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d H:i:s');
$id_curso = $_GET['id'];

$string = "UPDATE `curso` SET `fechaHastaCurActul`=' $currentDateTime' WHERE `id`= ".$id_curso;
echo "$string";

$consulta = $con->query($string);
echo "$consulta";

if($consulta){
    // si se da de baja el curso se les finaliza el cargo a los docentes, hubiera docentes asociados
    $consultaDocentesCurso = $con->query("SELECT profesor.apellidoProf, profesor.nombreProf, profesor.id FROM cargoprofesor, profesor, curso WHERE curso.id = '$id_curso' AND cargoprofesor.curso_id = curso.id AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.profesor_id = profesor.id");
    
    if(mysqli_num_rows($consultaDocentesCurso) > 0){
         while ($docentesCurso = $consultaDocentesCurso->fetch_assoc()) {
             
             $id_prof = $docentesCurso["id"];
             $finalizarCargoDocente = $con->query("UPDATE `cargoprofesor` SET `fechaHastaCargo`='$currentDateTime' WHERE `profesor_id` = '$id_prof'");
             
         }
    }
    
    
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=$id&&resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=$id&&resultado=4");

}

?>