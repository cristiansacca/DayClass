<?php
include "../../../databaseConection.php";

$id_curso= $_POST["cursoId"];
$cargo = $_POST["cargo"];
$legajo = $_POST["inputLegajo"];
$dni = $_POST["inputDNI"];

echo "$cargo";
echo "$id_curso";


date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();


$consultaDocenteID = $con->query("SELECT id FROM `profesor` WHERE (dniProf = $dni AND legajoProf = $legajo) AND fechaBajaProf IS NULL");

if(mysqli_num_rows($consultaDocenteID) == 0){
    //si la cosnulta es vacia, el docente no existe o esta dado de baja, error 2 = docente inexistente o dado de baja 
    header("Location:/DayClass/Administrador/MateriaCurso/Curso/modifDocentesCurso.php?id=$id_curso&&resultado=2");
    
    
}else{
    $resultado3= $consultaDocenteID->fetch_assoc();
    $id_profesor = $resultado3["id"];
    
    //verificar que el alumno no vaya a estar inscripto en el ese curso 
    $consultaCargoProfesor = $con->query("SELECT id FROM `cargoprofesor` WHERE fechaDesdeCargo <= '$currentDateTime' AND fechaHastaCargo IS NULL AND profesor_id = '$id_profesor' AND curso_id = '$id_curso'");
    
    if(mysqli_num_rows($consultaCargoProfesor) == 0){
        //si la consulta es vacia, ese profesor no esta registrado en ese curso 
        
        //se crea la instancia de cargoprofesor de ese curso 
        $resultadoInsertCargoProfesor = $con->query("INSERT INTO `cargoprofesor`(`fechaDesdeCargo`, `profesor_id`, `curso_id`, `cargo_id`) VALUES ('$currentDateTime','$id_profesor','$id_curso','$cargo')");
        
        
        $consultaCargoProfesorCreado = $con -> query("SELECT * FROM cargoprofesor WHERE `profesor_id` = '$id_profesor' AND `curso_id` = '$id_curso' AND `cargo_id` = '$cargo' AND `fechaDesdeCargo` = '$currentDateTime'");
        $resultado6 = $consultaCargoProfesorCreado->fetch_assoc();
        $cargoProfesorCreadoID = $resultado6["id"];
        // 
        
        $consultaEstadoCargoProfesor = $con->query("SELECT id FROM `estadocargoprofesor` WHERE nombreEstadoCargoProfe = 'Activo'");
        $resultado7 = $consultaEstadoCargoProfesor->fetch_assoc();
        $estadoCargoProf = $resultado7["id"];
        
        
        $resultadoInsertEstadoCargo = $con->query("INSERT INTO `cargoprofesorestado`(`fechaDesdeCargoProfesorEstado`, `estadoCargoProfesor_id`, `cargoProfesor_id`) VALUES ('$currentDateTime','$estadoCargoProf','$cargoProfesorCreadoID')");
        
        //volver a la pagina que llamo, exito 1 = crwacion exitosa 
        header("Location:/DayClass/Administrador/MateriaCurso/Curso/modifDocentesCurso.php?id=$id_curso&&resultado=1");
        
    }else{
        //error 3 = docente ya registrado en esa materia
        header("Location:/DayClass/Administrador/MateriaCurso/Curso/modifDocentesCurso.php?id=$id_curso&&resultado=3");
    }
}



	
?>