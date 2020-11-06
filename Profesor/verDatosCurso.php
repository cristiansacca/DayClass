<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../header.html"; // <-- Cambia
include "../databaseConection.php"; // <-- Cambia

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 24")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
  
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $_SESSION['limite'])
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");
  
        exit();
    }
  }
  $_SESSION['tiempo'] = time();

//-----------------------------------------------------------------------------------------------------------------------------



?>

<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Ver Información curso</h1>
        <?php
        $id_curso = $_GET["id_curso"];

        $consulta1 = $con->query("SELECT curso.nombreCurso, materia.nombreMateria, division.nombreDivision, modalidad.nombre AS nombreModalidad FROM `curso`, materia, division, modalidad WHERE curso.id = '$id_curso' AND curso.materia_id = materia.id AND curso.division_id = division.id AND division.modalidad_id = modalidad.id");
        $curso = $consulta1->fetch_assoc();
        $nombreCurso = $curso["nombreCurso"];
        $nombreMateria = $curso["nombreMateria"];
        $nombreDivision = $curso["nombreDivision"];
        $nombreModalidad = $curso["nombreModalidad"];

        echo "<h6>$nombreCurso</h6>";
        echo "";

        ?>

        <a class="btn btn-info" href="/DayClass/Index.php"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <!-- Page Features -->
    
    
    <div>
        <h3>Horarios de cursado</h3>
        <?php
        include "../databaseConection.php";

        $id_curso = $_GET["id_curso"];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");

        $contador = 0;


        if (($consulta3->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han definido horaios para este curso</h5>
                </div>";
        } else {

            echo "<div></div>
            <div class='list-group'>";
            
            while ($horarioCurso = $consulta3->fetch_assoc()) {
                

                $dia = $horarioCurso["nombreDia"];
                $horaDesde = $horarioCurso["horaInicioCurso"];
                $horaHasta = $horarioCurso["horaFinCurso"];
                echo "<div class='list-group-item list-group-item-action'>
                    <h5 class='font-weight-normal'> <b>$dia</b> de " . strftime("%H:%M", strtotime($horaDesde)) ." a " . strftime("%H:%M", strtotime($horaHasta)) . "</h5> 
                    </div>";

                
            }
            
            echo "</div>";
        }

        ?>

    </div>
    <br>
    <h3>Alumnos inscriptos</h3>
<div class="table-responsive">
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


            $consulta2 = $con->query("SELECT DISTINCT alumno_id FROM alumnocursoactual, usuario WHERE alumnocursoactual.alumno_id = usuario.id AND `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado' AND `curso_id` =  $id_curso ORDER BY usuario.apellidoUsuario ASC");

            if (!($consulta2->num_rows) == 0) {
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


                    $alumno = $con->query("SELECT cursoestadoalumno.nombreEstado, usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario, usuario.dniUsuario FROM alumnocursoactual, usuario, curso, alumnocursoestado, cursoestadoalumno WHERE usuario.id = '$alumno_id' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = usuario.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND ('$currentDateTime' >= alumnocursoestado.fechaInicioEstado) AND ('$currentDateTime' < alumnocursoestado.fechaFinEstado) AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id")->fetch_assoc();

                    $alumnoEstado = $alumno['nombreEstado'];
                    $primerLetra = substr($alumnoEstado, 0, 1);
                    $restoPlabra = strtolower(substr($alumnoEstado, 1));
                    $alumnoEstado = $primerLetra . $restoPlabra;

                    if ($alumno['nombreEstado'] == "LIBRE") {
                        echo "<tr class='table-danger'>
                                <td>" . $alumno['legajoUsuario'] . "</td>
                                <td>" . $alumno['apellidoUsuario'] . "</td>
                                <td>" . $alumno['nombreUsuario'] . "</td>
                                <td>" . $alumno['dniUsuario'] . "</td>
                                <td>" . $alumnoEstado . "</td>
                            </tr>";
                    } else {

                        echo "<tr class='table-info'>
                                <td>" . $alumno['legajoUsuario'] . "</td>
                                <td>" . $alumno['apellidoUsuario'] . "</td>
                                <td>" . $alumno['nombreUsuario'] . "</td>
                                <td>" . $alumno['dniUsuario'] . "</td>
                                <td>" . $alumnoEstado . "</td>
                            </tr>";
                    }
                }

                echo "</tbody>";
            } else {
                echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no hay alumnos inscriptos en este curso</h5>
                        </div>";
            }
            ?>

        </table>
    </div>


</div>


<script src="/DayClass/Alumno/alumno.js"></script>
<script src="profesor.js"></script>
<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../footer.html";
?>