<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";


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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 4")->fetch_assoc(); // <-- Cambia
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

//Si la variable id_curso no está definida se vuelve al index
if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
} else {
    header("location:/DayClass/Profesor/index.php");
}

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$consultaMateria = $con->query("SELECT * FROM materia WHERE id = '" . $curso["materia_id"] . "'");
$materia = $consultaMateria->fetch_assoc();
$materia_id = $materia["id"];

$consultaPrograma = $con->query("SELECT * FROM programamateria WHERE materia_id = '$materia_id' AND programamateria.fechaDesdePrograma <= '$currentDate' AND programamateria.fechaHastaPrograma IS NULL");


$hab = false;
if (($consultaPrograma->num_rows) != 0) {
    $programa = $consultaPrograma->fetch_assoc();
    $programa_id = $programa["id"];
    $hab = true;
}


$id_prof = $_SESSION['usuario']["id"];
$id_curso = $_GET["id_curso"];
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
    

    $habP = false;
    //si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
    if (($consulta4->num_rows) == 0) {
        $habP = true;
    }

$consultaDiasHorasCurso = $con->query("SELECT cursodia.dayName, horariocurso.horaInicioCurso, horariocurso.horaFinCurso FROM horariocurso, cursodia, curso WHERE curso.id ='$id_curso' AND horariocurso.curso_id = curso.id AND horariocurso.cursoDia_id = cursodia.id ");

$tieneDiaHora = false;
$diaHoraBien = false;
$diaBien = false;
$horaBien = false;
$diaSinClases = false;
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
                    
                    $consultaDiasHorasCurso = $con->query("SELECT * FROM `diassinclases` WHERE `fechaDiaSinClases` LIKE '$currentDateTime%'");
                    
                    if(($consultaDiasHorasCurso->num_rows) != 0){
                        $diaSinClases = true;
                    }

                    break;
                }
            }
        }
    }
}

$hayFechasCursado = false;
$hayAlumnos = false;


$consulta2 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
$cursoFechas = $consulta2->fetch_assoc();

$fechaD = $cursoFechas["fechaDesdeCursado"];
$fechaH = $cursoFechas["fechaHastaCursado"];

$fechaDesdeCursado = date_create($cursoFechas["fechaDesdeCursado"]);
$fechaHastaCursado = date_create($cursoFechas["fechaHastaCursado"]);

$fechaDesdeCursadoF = date_format($fechaDesdeCursado, "d/m/Y");
$fechaHastaCursadoF = date_format($fechaHastaCursado, "d/m/Y");

if (($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)) {
    $hayFechasCursado = true;

    $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaD' AND `fechaHastaAlumCurAc` = '$fechaH'  AND `curso_id` = '$id_curso' ");

    if (mysqli_num_rows($consultaAlumnos) != 0) {
        $hayAlumnos = true;
    }
}

$cursadoFuturo = true;

if (($fechaD > $currentDateTime)) {
    $cursadoFuturo = false;
}


?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Tema del día</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Index.php'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-bookmark mr-2"></i>Temas dados</button>
    </div>

    <?php
    if (isset($_GET['resultado'])) {
        if ($_GET['resultado'] == 1) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>El tema se cargó correctamente</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
        } elseif ($_GET['resultado'] == 0) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al cargar el tema</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
        }
    }
    ?>

    <?php
    if (!$hab) {
        echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Aún no se ha cargado el programa de esta materia, no podrá seleccionar temas de clase.</h5>
                </div>";
    }

    if (!$habP) {
        echo "<div class='alert alert-danger fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Registra una licencia en el día de hoy, no puede cargar temas, solo verlos.</h5>
            </div>";
    }

    if (!$hayAlumnos) {
        echo "<div class='alert alert-warning fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no hay alumnos inscriptos en este curso. No puede cargar temas.</h5>
            </div>";
    }


    if (!$tieneDiaHora) {
        echo "<div class='alert alert-danger fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay horario definido para este curso. No puede cargar temas.</h5>
            </div>";
    } else {
        if (!$diaHoraBien) {

            if ($diaBien && !$horaBien) {
                echo "<div class='alert alert-warning fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No es el horario de cursado. No puede cargar temas nuevos.</h5>
                    </div>";
            }

            if (!$diaBien && !$horaBien) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No es el día ni horario de cursado. No puede cargar temas nuevos.</h5>
                    </div>";
            }
        } else {
            if (!$diaBien) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Este curso no se dicta este día, no puede cargar temas.</h5>
                    </div>";
            }
            if ($diaSinClases) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Este día esta registrado como sin clases, no se pueden cargar temas nuevos.</h5>
                    </div>";
                }
        }
    }
    ?>

    <form action="cargarTemaDia.php" method="POST" class=" form-group" <?php if (($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos && $habP && $cursadoFuturo && !$diaSinClases)) {} else {echo "hidden";}  ?>>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Indique el tema del día</h5>
        <input type="text" name="id_curso" <?php echo "value='$id_curso'" ?> hidden>
        <div class="my-2  form-inline">
            <select id="unidadTema" name="unidadTema" class="custom-select" class="custom-select" style="width:15%" required>
                <option value="" selected>Seleccione</option>
                <?php

                $consultaTemas = $con->query("SELECT DISTINCT temasmateria.unidadTema FROM temasmateria WHERE programaMateria_id = '$programa_id' ORDER BY temasmateria.unidadTema");
               
               echo "<option value='examen'>Examen</option>";
               echo "<option value='claseEspecial'>Clase especial</option>";

                while ($temas = $consultaTemas->fetch_assoc()) {
                    echo "<option value='" . $temas["unidadTema"] . "'>Unidad " . $temas["unidadTema"] . "</option>";
                }

                ?>
            </select>

            <select id="nombreTema" name="nombreTema" class="custom-select" style="width:85%" required disabled>
                <option value="" selected>Tema</option>

            </select>



        </div>
        <div class="my-2">
            <textarea name="comentario" id="comentario" cols="60" rows="5" style="resize: none;" class="form-control form-inline" placeholder="Escriba un comentario (Opcional). Máximo 40 carácteres" maxlength="80"></textarea>

        </div>
        
        <input type="text" name="idTemaEspecial" id="idTemaEspecial" hidden>
        <input type="text" name="idPrograma" id="idPrograma" <?php echo "value='$programa_id'" ?> hidden>
        <input type="text" name="idProfesor" id="idProfesor" <?php echo "value='$id_prof'" ?> hidden>

        <button class="btn btn-primary my-2" type="submit">Aceptar</button>
    </form>

</div>


<!-- Modal ver temas dados -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Temas dados</h3>
            </div>
            <div class="modal-body">

                <div class="table-responsive">

                    <table class="table text-center table-striped">

                        <?php
                        include "../../databaseConection.php";
                        $id_curso = $_GET["id_curso"];

                        $consulta1 = $con->query("SELECT temadia.profesor_id, temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia DESC LIMIT 2");
                        //https://www.tutorialspoint.com/how-to-select-first-10-elements-from-a-mysql-database#:~:text=To%20select%20first%2010%20elements%20from%20a%20database%20using,BY%20clause%20with%20LIMIT%2010.&text=Insert%20some%20records%20in%20the%20table%20using%20insert%20command.&text=Display%20all%20records%20from%20the%20table%20using%20select%20statement.&text=Here%20is%20the%20alternate%20query%20to%20select%20first%2010%20elements.

                        if (($consulta1->num_rows) == 0) {
                            echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han cargado temas en este curso.</h5>
                                        </div>";
                        } else {
                            echo "<h9>Temas dados anteriormente</h9>";
                            echo "<thead>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Comentario</th>
                                            <th>Docente</th> 
                                        </thead>
                                       <tbody> ";


                            while ($resultado1 = $consulta1->fetch_assoc()) {
                                $profTema = $resultado1['profesor_id'];
                                $datosProf = $con->query("SELECT * FROM `usuario` WHERE usuario.id = '$profTema'")->fetch_assoc();

                                $nombreProf = $datosProf["nombreUsuario"];
                                $apellidoProf = $datosProf["apellidoUsuario"];


                                $date = date_create($resultado1['fechaTemaDia']);
                                $fecha = date_format($date, "d/m/Y");

                                echo "<tr>
                                        <td>" . $fecha . "</td>
                                        <td>" . $resultado1['nombreTema'] . "</td>
                                        <td>" . $resultado1['comentarioTema'] . "</td>
                                        <td>" . $nombreProf . " " . $apellidoProf . "</td>
                                        </tr>";
                            }

                            echo " </tbody>";
                        }
                        ?>

                    </table>

                </div>

                <div class="modal-footer">

                    <a <?php echo "href='/DayClass/Profesor/TemaDia/verTemaDiaAnt.php?id_curso=$id_curso'"; 
                       if(($consulta1->num_rows) == 0){echo "class='btn btn-success disabled'";}else{echo "class='btn btn-success'";} ?> ><i class="fas fa-search-plus mr-1"></i>Ver más</a>

                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>

                </div>
            </div>

        </div>
    </div>
</div>




<script src="../profesor.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>
<script src="fnTemaDia.js"></script>
<?php
include "../../footer.html";
?>