<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
 
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


<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET['id'];
             date_default_timezone_set('America/Argentina/Mendoza');
            $currentDateTime = date('Y-m-d');
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
        
            echo "<h1>$nombreCurso</h1>";
            
        
        
            if($fchDesde != null && $fchHasta != null && $fchHasta >= $currentDateTime){
                echo "<h6>Inicio del curso: ".strftime('%d/%m/%Y', strtotime($fchDesde))."</h6>";
                echo "<h6>Finalización de curso: ".strftime('%d/%m/%Y', strtotime($fchHasta))."</h6>";
            }else{
                echo "<div class='alert alert-warning' role='alert'>
                            <h5>No hay fechas de cursado vigentes, no se puede inscribir alumnos</h5>
                        </div>";
            }
            
        
        ?>
        <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Alumno inscripto exitosamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El documento o Legajo ingresado no existen o el alumno esta dado de baja</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El alumno ya esta inscripto</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en la baja</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>
    
    <?php
                include "../databaseConection.php";
    
                    $id_curso = $_GET['id'];
                    date_default_timezone_set('America/Argentina/Mendoza');
                    $currentDateTime = date('Y-m-d');
            
                    $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
                    $resultadoCurso = $consultaCurso->fetch_assoc();
            
                    $nombreCurso = $resultadoCurso['nombreCurso'];
                    
                    $fechaDesdeCursado = $resultadoCurso['fechaDesdeCursado'];
                    $fechaHastaCursado = $resultadoCurso['fechaHastaCursado'];
                    
                    $habilitado = false;
                    
                    if($fechaDesdeCursado != null && $fechaHastaCursado != null){
                        if($fechaHastaCursado >= $currentDateTime){
                            $habilitado = true;

                        }    
                    }
                ?>

    <div class="my-3">
        <button <?php 
                    if($habilitado){
                        echo "class='btn btn-primary'";
                        echo "data-target='#staticBackdrop'";
                    }else{
                        echo "class='btn btn-primary disabled'";
                    }?> data-toggle="modal"><i class="fa fa-user-plus mr-2"></i>Agregar Alumno</button>
        <button <?php 
                    if($habilitado){
                        echo "class='btn btn-success'";
                        echo "data-target='#staticBackdrop1'";
                    }else{
                        echo "class='btn btn-success disabled'";
                    }?>  data-toggle="modal" ><i class="fa fa-download mr-2"></i>Importar lista de inscriptos</button>
    </div>

    <div class="my-4">

        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre </th>
                <th>DNI</th>
                <th></th>
            </thead>

            <tbody>
                <?php
                include "../databaseConection.php";
                
                $id_curso = $_GET['id'];
                date_default_timezone_set('America/Argentina/Mendoza');
                $currentDateTime = date('Y-m-d H:i:s');
                
                 
                
                $consulta2 = $con->query("SELECT alumno_id FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` < '$currentDateTime' AND `fechaHastaAlumCurAc` > '$currentDateTime' AND `curso_id` =  $id_curso");
                
                
                while($alumnocursoactual = $consulta2->fetch_assoc()){
                    $alumno = $con->query("SELECT * FROM alumno WHERE id = '".$alumnocursoactual['alumno_id']."'")->fetch_assoc();
                    
                    //$url = 'bajaAlum.php?id='.$resultado1["id"];
                   // $id = $resultado1["id"];
                    
                    echo "<tr>
                        <td>".$alumno['legajoAlumno']."</td>
                        <td>".$alumno['apellidoAlum']."</td>
                        <td>".$alumno['nombreAlum']."</td>
                        <td>".$alumno['dniAlum']."</td>
                        <td class='text-center'><a class='btn btn-danger btn-sm' data-emp-id= onclick='return confirmDelete()' href=''><i class='fa fa-trash'></i></a></td>
                    </tr>";
                }
            
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="administrador.js"></script>
<script src="fcInscribirAlumno.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="paginadoDataTable.js"></script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Inscribir alumno</h5>
            </div>
            <form method="POST" id="insertAlumno" name="insertAlumno" action="inscribir_UnAlumno.php" enctype="multipart/form-data" role="form" onsubmit="return validarDNIyLegajoIns()">
                <?php
        include "../databaseConection.php";
        $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
        $rtdo = false;
        $dni = null;

        if (!($consultaParamLeg->num_rows) == 0) {
            $formatoLegajo = $consultaParamLeg->fetch_assoc();
            $rtdo = true;
            $dni = $formatoLegajo["esDNI"];

            echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
            if ($dni) {
            }else {

                $letras = $formatoLegajo["tieneLetras"];
                $numeros = $formatoLegajo["tieneNumeros"];

                $cantTotal = $formatoLegajo["cantTotalCaracteres"];
                echo "<input type='text' id='cantTotal' name='cantTotal' value='$cantTotal' hidden>";

                echo "<input type='text' id='letras' name='letras' value='$letras' hidden>";
                echo "<input type='text' id='numeros' name='numeros' value='$numeros' hidden>";


                if ($letras) {
                    $cantLetras = $formatoLegajo["cantLetras"];

                    echo "<input type='text' id='cantLetras' name='cantLetras' value='$cantLetras' hidden>";
                }
                if ($numeros) {
                    $cantNumeros = $formatoLegajo["cantNumeros"];

                    echo "<input type='text' id='cantNumeros' name='cantNumeros' value='$cantNumeros' hidden>";
                }
            }
        }else{
            echo "<div class='alert alert-warning' role='alert'>
                <h5>No se ha definido un formato de Legajo, no se podra ingresar un nuevo Alumno</h5>
            </div>";
        } 

        ?>

                <div class="modal-body" <?php 
                                    if($dni == null){ 
                                        echo "hidden ";} ?>>
                    
                    <div class="my-2">
                        <h5 class="msg" id="msjValidacionApellido">Ingrese los datos solicitados</h5>
                    </div>
                    <div class="my-2" <?php 
                                    if($dni){ 
                                        echo "hidden ";} ?>>
                        <label for="inputLegajo">Legajo</label>
                        <input type="text" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajoIns()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo">
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNIIns()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>
                    
                    
                    
                    <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" disabled> Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Importar lista de alumnos Incriptos</h3>
            </div>
            <div class="modal-body">

                <div>
                    <h9>La extension para la lista debe ser .xlsx y los campos deben estar ordenados como sigue:</h9>

                    <table class="table table-bordered text-center table-info">
                        <thead>
                            <th>DNI</th>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre </th>
                        </thead>
                    </table>

                </div>

                <form method="POST" id="importPlanilla" name="importPlanilla" action="inscribir_CursoAlumnos.php" enctype="multipart/form-data" role="form">
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>

                        </div>
                    </div>
                    
                    <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>
                    <!-- la funcion comrobar esta en administrador.js -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled>Importar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../footer.html";
?>