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
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 5")->fetch_assoc(); // <-- Cambia
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
        AND cargoprofesor.fechaHastaCargo IS NULL 
        AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id 
        AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id 
        AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' 
        AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' 
            OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

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

    if ($hab && $tieneDiaHora && $diaHoraBien && $diaBien && $horaBien) {
    } else {
        header("location:/DayClass/Usuario/inicioSesion.php?error=5");
    }
}

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Habilitar auto-asistencia</h1>
        <h5 class="font-weight-normal my-2"><?php echo $curso["nombreCurso"] ?></h5>
        <a href="/DayClass/Usuario/inicioSesion.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <?php
        if(isset($_GET['codigo'])){
            $codigo = $_GET['codigo'];
            if(!$codigo == ""){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>El código <b>$codigo</b> se habilitó correctamente.</h5>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
            } 
        }

        if(isset($_GET['error'])){
            switch ($_GET['error']) {
                case '1':
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al habilitar el código.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button></div>";
                break;
                
                case '2':
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ya existe un código vigente en este curso para el día de hoy.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button></div>";
                break;
            }
        }
    ?>
    <div class="mt-4">
    <?php
        $consultaLimite = $con->query("SELECT * FROM `tiempolimitecodigo`");
        $limiteAnt = $consultaLimite->fetch_assoc();
        $tiempoAnt = $limiteAnt["minutosLimite"];
                            
        if($tiempoAnt == null){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un tiempo para los códigos de autoasistencia. Solicite a un administrador que se habilite para que pueda usar esta funcionalidad.</h5>
                </div>";        
        }
    ?>
    
    
    </div>
    <div class="mt-4" <?php if($tiempoAnt == null){echo " hidden";} ?>>
        <form action="habilitarCodigo.php" method="POST">
            <div class="text-center row">
                <div class="form-group col-md-6">
                    <h3 class="font-weight-normal">Código de auto-asistencia</h3>
                    <i class="fa fa-qrcode fa-5x mb-2"></i>
                    <input type="text" class="form-control m-auto text-center" style="width: auto" id="outCodigoAutoasist" name="codigoAsis" readonly>
                    <br>
                    <button type="button" class="btn btn-primary" id="btnCodigoAutoasist" onclick="generarCodigo(); return false;"><i class="fa fa-refresh mr-2"></i>Generar</button>
                </div>    
                <div class="form-group col-md-6">
                    <h3 class="font-weight-normal">Duración del código</h3>
                    <i class="fa fa-clock-o fa-5x mb-2"></i>
                    <select class="form-control m-auto" name="tiempo" style="width: auto;" required>
                        <option value="" selected>Seleccione</option>
                        
                        <?php
                        
                        $tiempoMax = $con->query("SELECT * FROM tiempolimitecodigo")->fetch_assoc();
                        $max = $tiempoMax['minutosLimite'];

                        for ($i=5; $i <= $max ; $i+=5) { 
                            
                            echo "<option value='$i'>$i minutos</option>";

                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="text" <?php echo "value='$id_curso'"; ?> name="id_curso" hidden>
                <button type="submit" id="btnHabilitar" class="btn btn-success" disabled = "disabled"><i class="fa fa-check-circle mr-2"></i>Habilitar</button>
            </div>
        </form>
    </div>
</div>

<script src="../profesor.js"></script>
<!--<script>
    document.getElementById("temaDia").innerHTML = <?php //echo "'<a class=nav-link href=/DayClass/Profesor/TemaDia/temaDelDia.php?id_curso=" . $id_curso . "><i id=icono ></i>Tema del día</a>';";?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>-->
<script src="funciones_habilitarAutoasistencia.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../../footer.html";
?>