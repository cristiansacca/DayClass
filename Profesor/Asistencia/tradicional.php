<?php
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
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
  
if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();


    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');

    $consultaAsistMismoDia = $con->query("SELECT * FROM `asistenciadia`, asistencia, curso WHERE curso.id = $id_curso AND curso.id = asistencia.curso_id AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia LIKE '$currentDate%'");

    if(($consultaAsistMismoDia->num_rows)!=0){
        header("location: /DayClass/Profesor/indexCurso.php?id_curso=$id_curso&&resultado=3");
    }
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
    $id_prof = $_SESSION['profesor']["id"];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d');

    $consulta3 = $con->query("SELECT profesor.id, profesor.legajoProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE profesor.id = '$id_prof' AND cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

    $resultadoProf = $consulta3->fetch_assoc();
    $estadoCargo = $resultadoProf['nombreEstadoCargoProfe'];

    $hab = false;
    //si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
    if ($estadoCargo == "Activo") {
        $hab = true;
    }


    $consultaDiasHorasCurso = $con->query("SELECT cursodia.dayName, horariocurso.horaInicioCurso, horariocurso.horaFinCurso FROM horariocurso, cursodia, curso WHERE curso.id ='$id_curso' AND horariocurso.curso_id = curso.id AND horariocurso.cursoDia_id = cursodia.id ");

    $tieneDiaHora = false;
    $diaHoraBien = false;
    $diaBien = false;
    $horaBien = false;
    if(!($consultaDiasHorasCurso)==0){
        $tieneDiaHora = true;
        $curretDay = date('l', strtotime($currentDateTime));
        $currentTime = date('H:i:s');
        while ($rtdoDiasHoras = $consultaDiasHorasCurso->fetch_assoc()){
            $dayName = $rtdoDiasHoras['dayName'];

            if($dayName == $curretDay){
                $diaBien = true;
                $horaInicio = $rtdoDiasHoras['horaInicioCurso'];
                $horaFin = $rtdoDiasHoras['horaFinCurso'];

                if($currentTime >= $horaInicio && $currentTime <=$horaFin ){
                    $horaBien = true; 


                    if ($horaBien && $diaBien){
                        $diaHoraBien= true;

                        break;
                    }
                }
            }
        }
    }

    if($hab && $tieneDiaHora && $diaHoraBien && $diaBien && $horaBien){
        
    }else{
        header("location:/DayClass/Profesor/indexCurso.php?id_curso=$id_curso");
    }   
} 




?>

<style>
   .abajo-pagina{
      position: absolute;
      bottom: 0;
      width: 100%;
   }
</style>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1 class="my-2">Asistencia</h1>
        <h5 class="my-2"><?php echo $curso["nombreCurso"] ?></h5>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="text-center">
        <?php
        
        echo " <input type='text' hidden id='idCurso' name='idCurso' value='$id_curso'>";

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d H:i:s');
        

        $consulta1 = $con->query("SELECT alumno.id, apellidoAlum, nombreAlum, legajoAlumno FROM alumno, alumnocursoactual, curso, cursoestadoalumno, alumnocursoestado WHERE alumno.id = alumnocursoactual.alumno_id AND alumnocursoactual.curso_id = curso.id AND curso.id = '$id_curso' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND alumnocursoactual.fechaDesdeAlumCurAc<= '$currentDateTime' AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' AND alumnocursoestado.fechaFinEstado > '$currentDateTime' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO' ORDER BY apellidoAlum ASC");

        $contador = 1;
        while ($resultado1 = $consulta1->fetch_assoc()) {
            $nombreAlum = $resultado1["nombreAlum"];
            $apellidoAlum = $resultado1["apellidoAlum"];
            $idAlum = $resultado1["id"];
            $legajoAlum = $resultado1["legajoAlumno"];

            $aux = $contador + 1;
            $ausente = "Ausente";
            $presente = "Presente";

            echo "<div class='mySlides'>
                <i class='fa fa-user-circle fa-5x'></i>
                <br>
                <label id='labelLegajo' style='font-size:xx-large;'>$legajoAlum</label>
                <br>
                <label id='labelNombreApellido' style='font-size:xx-large;'>$apellidoAlum, $nombreAlum</label>
                
                <div>".
                    '<button class="btn btn-lg btn-danger mx-2" id="'.$ausente.'-'.$nombreAlum.'-'.$apellidoAlum.'" onclick="currentSlide('.$aux.',this.id,\''.$legajoAlum.'\')"><i class="fa fa-ban mr-1"></i>Ausente</button>
                    <button class="btn btn-lg btn-success mx-2" id="'.$presente.'-'.$nombreAlum.'-'.$apellidoAlum.'" onclick="currentSlide('.$aux.',this.id,\''.$legajoAlum.'\')"><i class="fa fa-check mr-1"></i>Presente</button>
                </div>
            </div>';

            $contador++;
        }

        ?>
    </div>
   

<div id="dvTable" class="justify-content-center"></div>
    

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';";?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script src="funciones_tradicional.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>

<?php
include "../../footer.html";
?>