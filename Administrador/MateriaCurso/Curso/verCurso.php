<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
.custom-file-label::after {
    content: "Elegir";
}
</style>


<link rel="stylesheet" href="../../../styleCards.css">
<script src="fnValidarDiasCurso.js"></script>

<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <?php
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
        <a class="btn btn-primary"<?php echo "href='modifFechasCursadoCurso.php?id=$id_curso'"; ?>><i class="fa fa-arrow-circle-left mr-2"></i>Fechas cursado</a>
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modifHorariosCurso"><i class="fa fa-plus-square mr-1"></i>Nuevo curso </a>
        <a class="btn btn-success" <?php //echo "href='/DayClass/Alumno/verTemasDados.php?id_curso=$id_curso'"; ?>><i class="fa fa-bookmark mr-2"></i>Temas Dados</a>
        
        
    </div>
    <!-- Page Features -->
    
    <h2>Fechas de cursado</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
            
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('Y-m-d');
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
      
            $rtdo = false;
      
            if(($fchDesde < $currentDateTime &&  $fchHasta < $currentDateTime) || ($fchDesde == "" &&  $fchHasta == "")){
               echo "<div class='alert alert-danger' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Se deben ingresar las fechas de cursado para este año.</h5>
                        </div>";
                
            }else{
                echo "<div class='alert alert-success' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Las fechas de cursado son correctas</h5>
                        </div>";
                echo "<div class='form-row'>";
                echo "<div class='form-group col-md-6'>
            <label for='inputInicio'>Inicio de cursado:</label>
            <input type='date' class='form-control' id='inputInicioCursado' name='inputInicioCursado' placeholder='Fecha Inicio Cursado' disabled value='$fchDesde'></div>";
                
             echo   "<div class='form-group col-md-6'>
            <label for='inputInicio'>Fin de cursado:</label>
            <input type='date' class='form-control' id='inputInicioCursado' name='inputInicioCursado' placeholder='Fecha Inicio Cursado' disabled value='$fchHasta'></div>";
                
                echo "</div>";
                $rtdo = true;
            }  
        
        ?>
    </div>
    
    <div class="row my-4">
       <?php
        
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

<!-- Modal modificar horarios de cursado -->
<div class="modal fade" id="modifHorariosCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Modificar horarios curso</h5>
            </div>
            <form id="crearCurso" name="crearCurso" action="#" method="POST" enctype="multipart/form-data" role="form" onsubmit="return enviar()">

                <div class="modal-body">
                    
                    <div class="form-group">
                       
                        <div id="mensajeError"></div>
                        
                        <table id="daysHoursTable" class="table">
                            <thead>
                                <th>Dia</th>
                                <th>Hora desde</th>
                                <th>Hora hasta</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                date_default_timezone_set('America/Argentina/Buenos_Aires');
                                $currentDateTime = date('Y-m-d');
                                
                                $consulta = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");
                                
                                $contador = 0;

                                while ($horarioCurso = $consulta->fetch_assoc()) {
                                    
                                    $horaDesde = $horarioCurso["horaInicioCurso"];
                                    $horaHasta = $horarioCurso["horaFinCurso"];

                                    echo "<tr>
                                    <td> <input class='checkDia' type='checkbox' id='" . $horarioCurso["nombreDia"] . "' onclick='habilitarTimePCF(this.id)'><label class='ml-2' name='dia[]'>" . $horarioCurso["nombreDia"] . "</label></td>
                                    <td><input type='time'  id='" . $horarioCurso["nombreDia"] . "1' onchange='habilitar2do(this.id)' disabled value='$horaDesde'></td>
                                    <td><input type='time' id='" . $horarioCurso["nombreDia"] . "2' onchange='validar(this.id)' disabled value='$horaHasta'> </td>
                                    <td><button type='button' class='btn btn-danger mb-1' onclick='deleteRow(this)'><i class='fa fa-trash mr-1'></i>Eliminar</button></td>
                                    </tr>";
                                    
                                    $contador ++;
                                }
                                ?>
                            </tbody>
                        </table>
                         <button type="button" class='btn btn-success mb-1' onclick="addCourseDay()"> <i class="fa fa-plus mr-1"></i>Agregar Dia</button>
                        <input type="text" id="arregloDiasHorario" name="arregloDiasHorario" hidden>
                        <input type="text" name="cursoId" id="cursoId" <?php echo "value= '$id_curso'"; ?> hidden>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="getNewDays()"> Cancelar </button>
                    <button type="submit" class="btn btn-primary"> Crear </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="../../administrador.js"></script>


<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../../footer.html";
?>