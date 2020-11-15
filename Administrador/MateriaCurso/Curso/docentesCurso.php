<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../../header.html"; // <-- Cambia
include "../../../databaseConection.php"; // <-- Cambia

//-----------------------------------------------------------------------------------------------------------------------------

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 1")->fetch_assoc(); // <-- Cambia
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
<script src="../../administrador.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>

        <?php
        include "../../../databaseConection.php";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
        $id_curso = $_GET['id'];

        $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
        $resultado = $consultaCurso->fetch_assoc();
        $fchDesde = $resultado["fechaDesdeCursado"];
        $fchHasta = $resultado["fechaHastaCursado"];
        $nombreCurso = $resultado["nombreCurso"];

        echo "<h1>$nombreCurso</h1>";
        
        

        if(($fchDesde != null && $fchHasta != null) && ($fchHasta >= $currentDateTime)){
            echo "<h6 class='font-weight-normal'><b>Inicio del cursado:</b> " . strftime('%d/%m/%Y', strtotime($fchDesde)) . " </h6>";
            echo "<h6 class='font-weight-normal'><b>Finalización del cursado:</b> " . strftime('%d/%m/%Y', strtotime($fchHasta)) . " </h6>";
        }else{
            echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay fechas de cursado vigentes.</h5>
                            <h7>Puede agregar docentes, pero recuerde colocar las fechas nuevas.</h7>
                        </div>";
        }

        ?>
        <a <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=".$resultado['materia_id']."'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Docente agregado exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El documento o legajo ingresado no existen o el docente ha sido dado de baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 3:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El docente seleccionado ya dicta esa materia.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 5:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Licencia cargada exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
                
             case 6:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Cambio de cargo exitoso.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
                
            case 7:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en el cambio de cargo.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 8:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa de docente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 9:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se puede dar de baja al docente, es el único asociado al curso.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
        }
    }

    ?>

    <div class="my-2">
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-square mr-1"></i>Agregar docente</a>
    </div>

    <div class="my-4 table-responsive">
        <table id="dataTable" class="table table-secondary table-bordered table-hover">
           <?php
                $id_curso = $_GET["id"];

                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d'); 
            
                $selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'DOCENTE'");
                $permiso = $selectPermiso->fetch_assoc();
                $id_permiso = $permiso["id"];
            
                $consulta1 = $con->query("SELECT usuario.id, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.legajoUsuario, cargo.nombreCargo FROM `cargoprofesor`, curso, usuario, cargo WHERE `fechaDesdeCargo` <= '$currentDateTime' AND `fechaHastaCargo` IS NULL AND `curso_id` = '$id_curso' AND cargoprofesor.curso_id = curso.id AND cargoprofesor.profesor_id = usuario.id AND cargoprofesor.cargo_id = cargo.id");
            
            
                if(($consulta1->num_rows) != 0){

                echo "<thead>
                    <th>Legajo</th>
                    <th>Docente</th>
                    <th>Cargo</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>";


                echo "<input type='date' name='impIDprof' id='hoy' value='$currentDateTime' hidden>";
                echo "<input type='text' name='cursid' id='cursoid' value='$id_curso' hidden>";
                while ($resultadoProf = $consulta1->fetch_assoc()) {
                    
                    
                    $nombreCompleto = $resultadoProf['apellidoUsuario'] . ", " . $resultadoProf['nombreUsuario'];
                    $id_prof = $resultadoProf['id'];
                    
                    $consulta2 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND cargoprofesorestado.fechaHastaCargoProfesorEstado >= '$currentDateTime' AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Licencia' ORDER BY cargoprofesorestado.fechaDesdeCargoProfesorEstado ASC");
                    
                    $urlBaja = 'bajaDocenteCurso.php?docenteId='.$id_prof.'&&cursoId='.$id_curso;
                    
                    if (($consulta2->num_rows) == 0) {
                       echo "<tr>
                    <td>" . $resultadoProf['legajoUsuario'] . "</td>
                    <td>" . $nombreCompleto . "</td>
                    <td>" . $resultadoProf['nombreCargo'] . "</td>
                    <td> Activo </td>
                    
                    <td class='text-center'>
                        <a href='/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_prof' class='btn btn-warning mb-1'><i class='fa fa-address-book-o mr-1'></i>Licencia</a> 
                        <a href='' class='btn btn-primary mb-1' data-toggle='modal' data-target='#cambioCargoProf' onclick='setCargosDisponibles(" . $id_prof . ")'><i class='fa fa-edit mr-1'></i>Editar</a>
                        <a href='$urlBaja' class='btn btn-danger mb-1'><i class='fa fa-trash mr-1'></i>Baja</a>
                    </td> 
                    </tr>"; 
                    } else {
                        echo "<tr>
                    <td>" . $resultadoProf['legajoUsuario'] . "</td>
                    <td>" . $nombreCompleto . "</td>
                    <td>" . $resultadoProf['nombreCargo'] . "</td>
                    <td>Licencia</td>
                    
                    <td class='text-center'>
                        <a href='/DayClass/Administrador/MateriaCurso/Curso/licenciasDocente.php?id_curso=$id_curso&&id_prof=$id_prof' class='btn btn-warning mb-1'><i class='fa fa-address-book-o mr-1'></i>Licencia</a> 
                        <a href='' class='btn btn-primary mb-1' data-toggle='modal' data-target='#cambioCargoProf' onclick='setCargosDisponibles(" . $id_prof . ")'><i class='fa fa-edit mr-1'></i>Editar</a>
                        <a href='$urlBaja' class='btn btn-danger mb-1'><i class='fa fa-trash mr-1'></i>Baja</a>
                        
                
                    </td> 
                    </tr>";
                    }
                    
                    

                    echo "</tbody>";
                }
                }else{
                    echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no hay docentes en este curso.</h5>
                        </div>";
                }
                ?>
        </table>
    </div>
</div>

<!-- Modal asociar profesor-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Agregar docente</h5>
            </div>
            <form method="POST" id="asociarProfesor" name="asociarProfesor" action="ingresarDocenteCurso.php" enctype="multipart/form-data" role="form" onsubmit="return validarDNIyLegajoIns()">
                <?php

                include "../../../databaseConection.php";
                $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                $rtdo = false;
                $dni = null;

                if (!($consultaParamLeg->num_rows) == 0) {
                    $formatoLegajo = $consultaParamLeg->fetch_assoc();
                    $rtdo = true;
                    $dni = $formatoLegajo["esDNI"];

                    echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
                    if ($dni) {
                    } else {

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
                } else {
                    echo "<div class='alert alert-warning' role='alert'>
                                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se puede cargar un nuevo docente en el curso.</h5>
                                    </div>";
                }

                $consultaD = $con->query("SELECT * FROM `cargo`");

                $cargos = null;

                if (($consultaD->num_rows) == 0) {
                    echo "<div class='alert alert-warning' role='alert'>
                                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No se han definido cargos para los docentes. No puede agregar docentes nuevos al curso.</h5>
                                    </div>";
                } else {
                    $cargos = true;
                }
                ?>
                <div class="modal-body" <?php if ($dni == null || $cargos == null) {
                                            echo "hidden ";
                                        } ?>>
                    <div id="resultadoMostrar"></div>

                    <div class="my-2">
                        <h5 class="msg" id="msjValidacionApellido">Ingrese los datos del docente a agregar y su cargo en esta materia.</h5>
                    </div>
                    <div class="form-inline my-2">
                        <label for="cargo">Cargo</label>
                        <select id="cargo" name="cargo" class="custom-select mx-2" style="width:200px">
                            <?php


                            while ($cargo = $consultaD->fetch_assoc()) {

                                echo "<option value='" . $cargo['id'] . "'>" . $cargo['nombreCargo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="my-2" <?php if ($dni) {
                                            echo "hidden ";
                                        } ?>>
                        <label for="inputLegajo">Legajo</label>
                        <input type="text" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajoIns()" placeholder="Legajo" onkeydown="return event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110"  <?php if (!($dni)) {"required";} ?>>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="number" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNIIns()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>



                    <input type="text" name="cursoId" id="cursoId1" <?php echo "value= '" . $id_curso . "'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" 
                    <?php if ($dni == null || $cargos == null) {
                        echo "style='display:none;'";} 
                    ?>>Agregar</button>
                </div>
            </form>

        </div>

    </div>
</div>

<!-- Modal de modificar cargo profesor -->
<div class="modal fade" id="cambioCargoProf" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Editar el cargo de un docente</h5>

            </div>
            <form method="POST" id="cambioCargoDocente" name="cambioCargoDocente" action="cambioCargoDocenteCurso.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">

                    <div class="my-2">
                        
                        <label class="text-muted">Seleccione el nuevo cargo del docente a partir de hoy</label>
                        
                        <select id="cargosDisponibles" name="cargosDisponibles" class="custom-select" style="width:85%" required>
                            <option value="" selected>Seleccione</option>
                
                        </select>
                    </div>

                    <input type="text" name="curso_idCC" id="cursoId" <?php echo "value= '" . $id_curso . "'"; ?> hidden>
                    <input type="text" name="impIDprofCC" id="impIDprofCC" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrearLicencia">Aceptar</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script src="../../administrador.js"></script>
<script src="../../fnInscribirAlumno.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../../paginadoDataTable.js"></script>
<script src="fnLicencia.js"></script>
<script src="fnCambioCargo.js"></script>


<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
    
$('#staticBackdrop').on('hidden.bs.modal', function() {
  location.reload();
});
</script>

<?php
include "../../../footer.html";
?>