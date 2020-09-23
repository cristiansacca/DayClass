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

//Si la variable id_curso no está definida se vuelve al index
if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$consultaMateria = $con->query("SELECT * FROM materia WHERE id = '".$curso["materia_id"]."'");
$materia = $consultaMateria->fetch_assoc();
$materia_id = $materia["id"];
               
$consultaPrograma = $con->query("SELECT * FROM programamateria WHERE materia_id = '$materia_id' AND programamateria.fechaDesdePrograma <= '$currentDate' AND programamateria.fechaHastaPrograma IS NULL");
$programa = $consultaPrograma->fetch_assoc();
$programa_id = $programa["id"];


$hab =false;
if($programa_id != "" || $programa_id != null){
    $hab = true;
}


$id_prof = $_SESSION['profesor']["id"];
$id_curso = $_GET["id_curso"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT profesor.id, profesor.legajoProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE profesor.id = '$id_prof' AND cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

$resultadoProf = $consulta1->fetch_assoc();
$estadoCargo = $resultadoProf['nombreEstadoCargoProfe'];

$habP = false;
//si el docente no tiene estado activo en ese materia en esa fecha, se desabilitaran los botones de asistencia 
if ($estadoCargo == "Activo") {
    $habP = true;
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

$hayFechasCursado = false;
$hayAlumnos = false;


$consulta2 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
$cursoFechas = $consulta2->fetch_assoc();

$fechaD = $cursoFechas["fechaDesdeCursado"];
$fechaH = $cursoFechas["fechaHastaCursado"];

$fechaDesdeCursado = date_create($cursoFechas["fechaDesdeCursado"]);
$fechaHastaCursado = date_create($cursoFechas["fechaHastaCursado"]);

$fechaDesdeCursadoF = date_format($fechaDesdeCursado,"d/m/Y");
$fechaHastaCursadoF = date_format($fechaHastaCursado,"d/m/Y");

if(($fechaD != null && $fechaH != null) && ($fechaH >= $currentDateTime)){
    $hayFechasCursado = true;
    
    $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaD' AND `fechaHastaAlumCurAc` = '$fechaH'  AND `curso_id` = '$id_curso' ");
    
    if(mysqli_num_rows($consultaAlumnos) != 0 ){
        $hayAlumnos = true;
    }
}

$cursadoFuturo = true;

if(($fechaD > $currentDateTime)){
    $cursadoFuturo = false;
}


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Tema del día</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
         <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-bookmark mr-2"></i>Temas dados</button>
    </div>

    <?php
        if(isset($_GET['resultado'])){
            if($_GET['resultado'] == 1){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>El tema se cargó correctamente</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            } elseif($_GET['resultado'] == 0) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al cargar el tema</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            }
        }
    ?>
    
    <?php
        if(!$hab){
                echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Aún no se ha cargado el programa de esta materia, no podrá seleccionar temas de clase.</h5>
                </div>";
        }
    
        if (!$habP) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Su estado el dia de hoy es $estadoCargo, no puede cargar temas, solo verlos.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>";
        }
        
        if(!$hayAlumnos){
           echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no hay alumnos inscriptos para este periodo.</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
            </div>"; 
        }
    ?>

    <form action="cargarTemaDia.php" method="POST" class=" form-group" <?php if (($hab && $diaHoraBien && $tieneDiaHora && $hayFechasCursado && $hayAlumnos && $habP && $cursadoFuturo)){ }else{echo "hidden";}  ?>>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>Indique el tema del día</h5>
        <input type="text" name="id_curso" <?php echo "value='$id_curso'" ?> hidden >
        <div class="my-2  form-inline">
            <select id="unidadTema" name="unidadTema" class="custom-select" class="custom-select" style="width:15%" required>
                <option value="" selected>Unidad</option>
                <?php
                
                $consultaTemas = $con->query("SELECT DISTINCT temasmateria.unidadTema FROM temasmateria WHERE programaMateria_id = '$programa_id' ORDER BY temasmateria.unidadTema");

                while($temas = $consultaTemas->fetch_assoc()){
                    echo "<option value='".$temas["unidadTema"]."'>".$temas["unidadTema"]."</option>";
                }

                ?>
            </select>
            
            <select id="nombreTema" name="nombreTema" class="custom-select" style="width:85%" required disabled>
                <option value="" selected>Tema</option>
                
            </select>
            
            
            
        </div>
        <div class="my-2">
            <textarea name="comentario" cols="60" rows="5" style="resize: none;" class="form-control form-inline"
                placeholder="Escriba un comentario (Opcional)"></textarea>
        </div>
        
        <input type="text" name="idPrograma" id="idPrograma" <?php echo "value='$programa_id'" ?> hidden >
        <input type="text" name="idProfesor" id="idProfesor" <?php echo "value='$id_prof'" ?> hidden >
        
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

                <div>
                    

                    <table class="table text-center table-striped">
                        
                        
                        
                            <?php
                                include "../databaseConection.php";
                                $id_curso = $_GET["id_curso"];

                                $consulta1 = $con->query("SELECT temadia.profesor_id, temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia DESC");
                            
                                if(($consulta1->num_rows) == 0){
                                    echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han cargado temas en este curso.</h5>
                                        </div>";
                                }else{
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
                                        $datosProf = $con->query("SELECT * FROM `profesor` WHERE profesor.id = '$profTema'")->fetch_assoc();
                                        
                                        $nombreProf = $datosProf["nombreProf"];
                                        $apellidoProf = $datosProf["apellidoProf"];
                                        
                                        
                                        $date=date_create($resultado1['fechaTemaDia']);
                                        $fecha = date_format($date,"d/m/Y");

                                        echo "<tr>
                                        <td>" . $fecha . "</td>
                                        <td>" . $resultado1['nombreTema'] . "</td>
                                        <td>" . $resultado1['comentarioTema'] . "</td>
                                        <td>" . $nombreProf ." ". $apellidoProf . "</td>
                                        </tr>";
                                    }
                                    
                                    echo " </tbody>";
                                }
                            ?>
                        
                       
                    </table>

                </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>

        </div>
    </div>
</div>




<script src="profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>
<script src="fnTemaDia.js"></script>
<?php
include "../footer.html";
?>