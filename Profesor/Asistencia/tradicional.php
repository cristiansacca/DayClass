<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 6")->fetch_assoc(); // <-- Cambia
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
    header("location:/DayClass/Usuario/inicioSesion.php?error=0");
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

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');

    $consultaAsistMismoDia = $con->query("SELECT * FROM asistenciadia, asistencia, curso WHERE curso.id = $id_curso AND curso.id = asistencia.curso_id AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia LIKE '$currentDate%'");

    if (($consultaAsistMismoDia->num_rows) != 0) {
        header("location:/DayClass/Usuario/inicioSesion.php?error=1");
    }
} else {
    header("location:/DayClass/Usuario/inicioSesion.php?error=2");
}

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();

    $id_prof = $_SESSION['usuario']["id"];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d');

    $consulta3 = $con->query("SELECT usuario.id, usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo 
    FROM cargoprofesor, curso, usuario, cargoprofesorestado, estadocargoprofesor, cargo 
    WHERE usuario.id = '$id_prof' 
        AND cargoprofesor.profesor_id = usuario.id 
        AND cargoprofesor.curso_id = curso.id 
        AND cargoprofesor.cargo_id = cargo.id 
        AND cargoprofesor.curso_id = '$id_curso' 
        AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' 
        AND cargoprofesor.fechaHastaCargo IS NULL ");
    
    $resultadoProf = $consulta3->fetch_assoc();
    
    
    
    $consulta4 = $con->query("SELECT cargoprofesorestado.id, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND fechaDesdeCargoProfesorEstado <='$currentDateTime' AND fechaHastaCargoProfesorEstado >='$currentDateTime' AND `estadoCargoProfesor_id` = 2");
    

    $hab = false;
    //si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
    if (($consulta4->num_rows) == 0) {
        $hab = true;
    }
    
    $consultaDiasHorasCurso = $con->query("SELECT cursodia.dayName, horariocurso.horaInicioCurso, horariocurso.horaFinCurso FROM horariocurso, cursodia, curso WHERE curso.id ='$id_curso' AND horariocurso.curso_id = curso.id AND horariocurso.cursoDia_id = cursodia.id ");

    $tieneDiaHora = false;
    $diaHoraBien = false;
    $diaBien = false;
    $horaBien = false;
    if (!($consultaDiasHorasCurso) == 0) {
        $tieneDiaHora = true;
        $curretDay = date('l', strtotime($currentDateTime));
        $currentTime = date('H:i:s');
        while ($rtdoDiasHoras = $consultaDiasHorasCurso->fetch_assoc()) {
            $dayName = $rtdoDiasHoras['dayName'];

            if ($dayName == $curretDay) {
                $diaBien = true;
                $horaInicio = $rtdoDiasHoras['horaInicioCurso'];
                $horaFin = $rtdoDiasHoras['horaFinCurso'];

                if ($currentTime >= $horaInicio && $currentTime <= $horaFin) {
                    $horaBien = true;


                    if ($horaBien && $diaBien) {
                        $diaHoraBien = true;

                        break;
                    }
                }
            }
        }
    }
    
    //echo $tieneDiaHora $diaHoraBien $diaBien $horaBien;

    if ($hab && $tieneDiaHora && $diaHoraBien && $diaBien && $horaBien) {
        //esta todo bien continua la ejecucion 
    } else {
        if(!$hab){
          header("location:/DayClass/Profesor/seleccionCurso.php?codFn=6&&error=9");  
        }else{
            if(!$tieneDiaHora){
                header("location:/DayClass/Profesor/seleccionCurso.php?codFn=6&&error=9");
            }else{
                    if(!$diaBien){
                       header("location:/DayClass/Profesor/seleccionCurso.php?codFn=6&&error=10"); 
                    }else{
                        header("location:/DayClass/Profesor/seleccionCurso.php?codFn=6&&error=11");
                    }
            }
        }
        
        //header("location:/DayClass/Usuario/inicioSesion.php?error=5");
    }
}

?>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo $nombreRol ?></p>
        <h1 class="my-2">Asistencia</h1>
        <h5 class="my-2"><?php echo $curso["nombreCurso"] ?></h5>
        <a href="/DayClass/Usuario/inicioSesion.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="text-center">
        <?php

        echo " <input type='text' hidden id='idCurso' name='idCurso' value='$id_curso'>";

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d H:i:s');


        $consulta1 = $con->query("SELECT usuario.id, apellidoUsuario, nombreUsuario, legajoUsuario 
        FROM usuario, alumnocursoactual, curso, cursoestadoalumno, alumnocursoestado 
        WHERE usuario.id = alumnocursoactual.alumno_id 
            AND usuario.fechaBajaUsuario IS NULL 
            AND alumnocursoactual.curso_id = curso.id 
            AND curso.id = '$id_curso' 
            AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' 
            AND alumnocursoactual.fechaDesdeAlumCurAc<= '$currentDateTime' 
            AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id 
            AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' 
            AND alumnocursoestado.fechaFinEstado > '$currentDateTime' 
            AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id 
            AND cursoestadoalumno.nombreEstado = 'INSCRIPTO' ORDER BY apellidoUsuario ASC");

        
        if(($consulta1->num_rows)==0){
            echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay alumnos incriptos en este curso, no se puede tomar asistencia.</h5>
            </div>";
        }else{  
            $contador = 1;
            while ($resultado1 = $consulta1->fetch_assoc()) {
                $nombreAlum = $resultado1["nombreUsuario"];
                $apellidoAlum = $resultado1["apellidoUsuario"];
                $idAlum = $resultado1["id"];
                $legajoAlum = $resultado1["legajoUsuario"];

                $aux = $contador + 1;
                $ausente = "Ausente";
                $presente = "Presente";

                echo "<div class='mySlides'>
                    <i class='fa fa-user-circle fa-5x'></i>
                    <br>
                    <label id='labelLegajo' style='font-size:xx-large;'>$legajoAlum</label>
                    <br>
                    <label id='labelNombreApellido' style='font-size:xx-large;'>$apellidoAlum, $nombreAlum</label>

                    <div>" .
                    '<button class="btn btn-lg btn-danger mx-2" id="' . $ausente . '-' . $nombreAlum . '-' . $apellidoAlum . '" onclick="currentSlide(' . $aux . ',this.id,\'' . $legajoAlum . '\')"><i class="fa fa-ban mr-1"></i>Ausente</button>
                        <button class="btn btn-lg btn-success mx-2" id="' . $presente . '-' . $nombreAlum . '-' . $apellidoAlum . '" onclick="currentSlide(' . $aux . ',this.id,\'' . $legajoAlum . '\')"><i class="fa fa-check mr-1"></i>Presente</button>
                    </div>
                </div>';

                $contador++;
            }
        }

        ?>
    </div>


    <div id="dvTable" class="justify-content-center table-responsive"></div>


</div>

<script src="../profesor.js"></script>
<script src="funciones_tradicional.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>