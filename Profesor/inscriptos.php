<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Inscriptos en <?php echo " " . $curso["nombreCurso"] ?></h1>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div>
        <table class="table table-active table-bordered table-hover table-sm">
            
                
                <?php

                $id_curso = $_GET['id_curso'];
                date_default_timezone_set('America/Argentina/Mendoza');
                $currentDateTime = date('Y-m-d H:i:s');


                $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
                $resultadoCurso = $consultaCurso->fetch_assoc();

                $nombreCurso = $resultadoCurso['nombreCurso'];

                $fechaDesdeCursado = $resultadoCurso['fechaDesdeCursado'];
                $fechaHastaCursado = $resultadoCurso['fechaHastaCursado'];
            
            
                $consulta2 = $con->query("SELECT DISTINCT alumno_id FROM alumnocursoactual, alumno WHERE alumnocursoactual.alumno_id = alumno.id AND `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado' AND `curso_id` =  $id_curso ORDER BY alumno.apellidoAlum ASC");
                                
                if(!($consulta2 ->num_rows) == 0){
                    echo "<thead>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre </th>
                            <th>DNI</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>";
                    while ($alumnocursoactual = $consulta2->fetch_assoc()) {
                        
                       $alumno_id = $alumnocursoactual['alumno_id'];
                        
                        
                        $alumno = $con->query("SELECT cursoestadoalumno.nombreEstado, alumno.legajoAlumno, alumno.apellidoAlum, alumno.nombreAlum, alumno.dniAlum FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$alumno_id' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND ('$currentDateTime' >= alumnocursoestado.fechaInicioEstado) AND ('$currentDateTime' < alumnocursoestado.fechaFinEstado) AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id")->fetch_assoc();
                        
                        $alumnoEstado = $alumno['nombreEstado'];
                        $primerLetra = substr($alumnoEstado, 0, 1);
                        $restoPlabra = strtolower(substr($alumnoEstado, 1));
                        $alumnoEstado = $primerLetra . $restoPlabra;
                        
                        if($alumno['nombreEstado'] == "LIBRE"){
                            echo "<tr class='table-danger'>
                                <td>" . $alumno['legajoAlumno'] . "</td>
                                <td>" . $alumno['apellidoAlum'] . "</td>
                                <td>" . $alumno['nombreAlum'] . "</td>
                                <td>" . $alumno['dniAlum'] . "</td>
                                <td>".$alumnoEstado."</td>
                            </tr>";
                        }else{
                            
                           echo "<tr class='table-info'>
                                <td>" . $alumno['legajoAlumno'] . "</td>
                                <td>" . $alumno['apellidoAlum'] . "</td>
                                <td>" . $alumno['nombreAlum'] . "</td>
                                <td>" . $alumno['dniAlum'] . "</td>
                                <td>".$alumnoEstado."</td>
                            </tr>"; 
                        }
                         
                    }
                    
                    echo "</tbody>";

                        
                }else{
                    echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no hay alumnos Incriptos en este curso</h5>
                        </div>";
                }  
            ?>            
            
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';";?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>
<?php
include "../footer.html";
?>