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
        $id_curso = $_GET['id_curso'];
        $id_prof = $_GET["id_prof"];


        $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
        $resultado = $consultaCurso->fetch_assoc();
        $fchDesde = $resultado["fechaDesdeCursado"];
        $fchHasta = $resultado["fechaHastaCursado"];
        $nombreCurso = $resultado["nombreCurso"];
            
        $consulta1 = $con->query("SELECT usuario.id, usuario.legajoUsuario, usuario.apellidoUsuario, usuario.nombreUsuario, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo 
                FROM cargoprofesor, curso, usuario, cargoprofesorestado, estadocargoprofesor, cargo 
                WHERE usuario.id = $id_prof 
                    AND cargoprofesor.profesor_id = usuario.id
                    AND cargoprofesor.curso_id = curso.id 
                    AND cargoprofesor.cargo_id = cargo.id 
                    AND cargoprofesor.curso_id = '$id_curso' 
                    AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' 
                    AND cargoprofesor.fechaHastaCargo IS NULL 
                    AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id 
                    AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id 
                    AND estadocargoprofesor.nombreEstadoCargoProfe <> 'Baja' 
                    AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' 
                    AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' 
                        OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");
         $resultadoProf = $consulta1->fetch_assoc();   
        $nombreProf = $resultadoProf["nombreUsuario"];
        $apellidoProf = $resultadoProf["apellidoUsuario"];
        

        echo "<h1>Administrar licencias docente</h1>";
        echo "<h3>$nombreCurso - $nombreProf $apellidoProf</h3>";
        

        ?>
        <a <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/docentesCurso.php?id=".$id_curso."'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Licencia cargada exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i> Erro al registrar la licencia.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa de la licencia.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja de la licencia.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                break;
                
                //hasta aca se usan
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
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-square mr-1"></i>Agregar Licencia</a>
    </div>

    <div class="my-4 table-responsive">
        <table id="dataTable" class="table table-secondary table-bordered table-hover">
           <?php
                $id_curso = $_GET["id_curso"];
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d'); 
            
                
            
            
            
                echo "<input type='date' name='impIDprof' id='hoy' value='$currentDateTime' hidden>";
                echo "<input type='text' name='cursid' id='cursoid' value='$id_curso' hidden>";
                
                //$nombreCompleto = $resultadoProf['apellidoUsuario'] . ", " . $resultadoProf['nombreUsuario'];
                //$id = $resultadoProf['id'];
            
                $consulta2 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Licencia' ORDER BY cargoprofesorestado.fechaDesdeCargoProfesorEstado ASC");
            
            
                if(($consulta2->num_rows) != 0){

                echo "<thead>
                    <th>Fecha Desde</th>
                    <th>Fecha Hasta</th>
                    <th></th>
                </thead>
                <tbody>";
                    
                    
                    while($resultadoLicencia = $consulta2->fetch_assoc()){
                        $inicioLicencia = $resultadoLicencia["fechaDesdeCargoProfesorEstado"];
                        $finLicencia = $resultadoLicencia["fechaHastaCargoProfesorEstado"];
                        $nombreEstado = $resultadoLicencia["nombreEstadoCargoProfe"];
                        
                    
                        
                        
                        
                    if($nombreEstado == "Licencia"){
                            //$urlReinc = 'reincAlum.php?id='.$resultado1["id"];
                            echo "<tr>
                    <td>" . $inicioLicencia . "</td>
                    <td>" . $finLicencia  . "</td>
                    <td class='text-center'><a class='btn btn-danger' onclick='return confirmDelete()' href=''><i class='fa fa-trash mr-1'></i>Eliminar Licencia</a></td>
                    </tr>";
                        }else{
                            //urlBaja = 'bajaAlum.php?id='.$resultado1["id"];
                           echo "<tr>
                    <td>" . $inicioLicencia . "</td>
                    <td>" . $finLicencia  . "</td>
                    <td>" . $nombreEstado . "</td>
                    <td class='text-center'><a class='btn btn-warning' onclick='return confirmDelete()' href=''><i class='fa fa-trash mr-1'></i>Ingresar Licencia</a></td>
                    </tr>"; 
                        }
                        
                        
                        echo "</tbody>";
                        
                    }

                
                }else{
                    echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El docente no registra licencias presentes o futuras.</h5>
                        </div>";
                }

                

            
                ?>
        </table>
    </div>
</div>


<!-- Modal de licencias -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Licencia docente</h5>

            </div>
            <form method="POST" id="ingresarLicenciaDocente" name="ingresarLicenciaDocente" action="ingresarDocenteLicenciaCurso.php" enctype="multipart/form-data" role="form" onsubmit="return validarFechasLic()">
                <div class="modal-body">

                    <label class="text-muted text-center">Ingrese las fechas de la nueva licencia del docente</label>
                    
                    <div id="resultadoMostrar"></div>

                    <div class="my-2">
                        <div class="form-inline my-2">
                            <label style="margin-right: 1rem;" for="fechaDesde">Inicio Licencia: </label>
                            <input type="date" id="fechaDesde" name="fechaDesde" onchange="habilitarFechaHasta()" class="form-control mr-2" required>
                            <h9 id="msgDesde"></h9>
                        </div>
                        <div class="form-inline my-2">
                            <label style="margin-right: 1.2rem;" for="fechaHasta">Fin Licencia: </label>
                            <input type="date" id="fechaHasta" name="fechaHasta" class="form-control mr-2" required disabled>
                            <h9 id="msgHasta"></h9>
                        </div>
                        <div class="my-2 table-responsive" id="tablaLastLicencia"></div>
                    </div>

                    <input type="text" name="cursoId" id="cursoId" <?php echo "value= '" . $id_curso . "'"; ?> hidden>
                    <input type="text" name="impIDprof" id="impIDprof" <?php echo "value= '" . $id_prof . "'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrearLicencia">Agregar</button>
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
</script>

<?php
include "../../../footer.html";
?>