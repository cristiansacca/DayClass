<?php
include "../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$id = $_GET['id'];

$string = "UPDATE `materia` SET `fechaBajaMateria`=' $currentDate' WHERE `id`= ".$id;
$finalizarMateria = $con->query($string);


if($finalizarMateria){
$selectCursosMateria = $con->query("SELECT curso.id AS idCurso FROM curso, materia WHERE materia.id = '$idmateria' AND materia.id = curso.materia_id AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaHastaCursado < '$currentDate'");

 if(mysqli_num_rows($consultaCursosMateria) != 0){
     while ($cursosMateria = $consultaCursosMateria->fetch_assoc()){
        $idCurso = $cursosMateria["idCurso"];
                             
        $finalizarCurso =  $con->query("UPDATE `curso` SET `fechaHastaCurActul`='$currentDate' WHERE `id`= ".$idCurso);
        
         if($finalizarCurso){
             $consultaDocentesCurso = $con->query("SELECT profesor.apellidoProf, profesor.nombreProf, profesor.id FROM cargoprofesor, profesor, curso WHERE curso.id = '$idCurso' AND cargoprofesor.curso_id = curso.id AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.profesor_id = profesor.id");
    
                if(mysqli_num_rows($consultaDocentesCurso) > 0){
                     while ($docentesCurso = $consultaDocentesCurso->fetch_assoc()) {

                         $id_prof = $docentesCurso["id"];
                         $finalizarCargoDocente = $con->query("UPDATE `cargoprofesor` SET `fechaHastaCargo`='$currentDate' WHERE `profesor_id` = '$id_prof'");

                     }
                }
         } 
    }
}
    
$selectProgramaMateria = $con->query("SELECT * FROM `programamateria` WHERE programamateria.materia_id = '$id' AND programamateria.fechaHastaPrograma IS NULL AND programamateria.fechaDesdePrograma <= '$currentDate'");
    
if(mysqli_num_rows($selectProgramaMateria) != 0){
    $programa = $selectPorgramaMateria->fetch_assoc();
    $id_programa =  $programa["id"];
    $finalizarPrograma = $con->query("UPDATE `programamateria` SET `fechaHastaPrograma`= '$currentDate' WHERE programamateria.materia_id = '$id' AND fechaHastaPrograma IS NULL AND programamateria.id = '$id_programa'"); 
    
}   

  header("Location:/DayClass/Administrador/MateriaCurso/Materia/admMateria.php?resultado=3");
  
}else{
    header("Location:/DayClass/Administrador/MateriaCurso/Materia/admMateria.php?resultado=4");

}

?>