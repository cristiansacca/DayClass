<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
} else {
    header("location:/DayClass/Profesor/index.php");
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
  
?>

<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET["id_curso"];

            $consulta1 = $con->query("SELECT curso.nombreCurso, materia.nombreMateria, division.nombreDivision, modalidad.nombre AS nombreModalidad FROM `curso`, materia, division, modalidad WHERE curso.id = '$id_curso' AND curso.materia_id = materia.id AND curso.division_id = division.id AND division.modalidad_id = modalidad.id");
            $curso = $consulta1->fetch_assoc();
            $nombreCurso = $curso["nombreCurso"];
            $nombreMateria = $curso["nombreMateria"];
            $nombreDivision = $curso["nombreDivision"];
            $nombreModalidad = $curso["nombreModalidad"];
            
            echo "<h1>$nombreCurso</h1>";
            echo "<h3 class='font-weight-normal'>$nombreModalidad</h3>";
            
        ?>
        
        
        <a class="btn btn-info" href="/DayClass/Alumno/materiasAlumno.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
        <a class="btn btn-success" <?php echo "href='/DayClass/Alumno/verTemasDados.php?id_curso=$id_curso'"; ?>><i class="fa fa-bookmark mr-2"></i>Temas Dados</a>
    </div>
    <!-- Page Features -->
    <h2>Docentes</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET["id_curso"];
        
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDateTime = date('Y-m-d');

            $consulta2 = $con->query("SELECT profesor.id, profesor.emailProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe <> 'Baja' AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");

            if(($consulta2->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no hay docentes asigandos a este curso, pronto entarán disponibles</h5>
                </div>";
            }else{
                
                while ($docentesCurso = $consulta2->fetch_assoc()) {
                
                $nombreDocente = $docentesCurso["nombreProf"];
                $apellidoDocente = $docentesCurso["apellidoProf"];
                $cargoDocente = $docentesCurso["nombreCargo"];
                $mailDocente = $docentesCurso["emailProf"];
                    
                if($mailDocente == "" || $mailDocente == null){
                    $mailDocente = "Correo electronico no registrado";
                }
                
                echo "<h4>$cargoDocente:</h4><h5 class='font-weight-normal' style='display:inline'>$apellidoDocente, $nombreDocente - $mailDocente</h5>";
                    
                
                }
            }
        ?>
    </div>
    
    <div class="row my-4">
       <?php
        include "../databaseConection.php";
        
        $id_curso = $_GET["id_curso"];
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
        
        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");
        
        $contador = 0;
        
       
        if(($consulta3->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han definido horaios para este curso</h5>
                </div>";
        }else{
            
            echo "<div class='col-lg-12'><h2>Horarios de cursado</h2></div>";
            while ($horarioCurso = $consulta3->fetch_assoc()) {
            if($contador == 4){
                $contador = 0;
            }
            
            $dia = $horarioCurso["nombreDia"];
            $horaDesde = $horarioCurso["horaInicioCurso"];
            $horaHasta = $horarioCurso["horaFinCurso"];
            echo "<div class='col-lg-4 my-3' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>$dia</h3>
                        <h5 class='font-weight-normal'>Desde: ".strftime("%H:%M", strtotime($horaDesde))."</h5>
                        <h5 class='font-weight-normal'>Hasta: ".strftime("%H:%M", strtotime($horaHasta))."</h5>
                    </div>
                </div>
            </div>" ;
            
            $contador ++;
       
            }
        }
        
        
    
        
    ?> 
        
    </div>

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
                    <h9>Temas dados durante el cursado</h9>

                    <table class="table text-center table-striped">
                        
                        
                        
                            <?php
                                include "../databaseConection.php";
                                $id_curso = $_GET["id_curso"];

                                $consulta1 = $con->query("SELECT temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia ASC");
                            
                            
                                if(($consulta1->num_rows) == 0){
                                    echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han cargado temas en este curso</h5>
                                        </div>";
                                }else{
                                   echo "<thead>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Comentario del Docente</th>
                                        </thead>
                                       <tbody> ";
                                

                                    while ($resultado1 = $consulta1->fetch_assoc()) {
                                        
                                        $date=date_create($resultado1['fechaTemaDia']);
                                        $fecha = date_format($date,"d/m/Y");

                                        echo "<tr>
                                        <td>" . $fecha . "</td>
                                        <td>" . $resultado1['nombreTema'] . "</td>
                                        <td>" . $resultado1['comentarioTema'] . "</td>
                                        </tr>";
                                    }
                                    
                                    echo " </tbody>";
                                }
                            ?>
                        
                       
                    </table>

                </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="alumno.js"></script>

<?php
include "modal-autoasistencia.php";
?>

<?php
include "../footer.html";
?>