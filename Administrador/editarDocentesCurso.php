<?php
include "../header.html";
?>
<script src="administrador.js"></script>


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
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
        
            echo "<h1>$nombreCurso</h1>";
            
            echo "<h6>Inicio del curso: ".strftime('%d/%m/%Y', strtotime($fchDesde))."</h6>";
            echo "<h6>Finalización de curso: ".strftime('%d/%m/%Y', strtotime($fchHasta))."</h6>";
        
        ?>
        <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    
    
    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Docente agregado exitosamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El documento o Legajo ingresado no existen o el docente ha sido dado de baja</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El docente ya dicta esa materia</h5>
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
                case 5:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Licencia cargada exitosamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>

    <div class="my-3">
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-square mr-1"></i>Agregar Docente</a>
    </div>
   
        

    <div class="my-4">
        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Legajo</th>
                <th>Docente</th>
                <th>Cargo</th>
                <th>Estado</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                include "../databaseConection.php";
                $id_curso = $_GET["id"];
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

                $consulta1 = $con->query("SELECT profesor.id, profesor.legajoProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe <> 'Baja' AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");
                
                
                echo "<input type='date' name='impIDprof' id='hoy' value='$currentDateTime' hidden>";
                while ($resultadoProf = $consulta1->fetch_assoc()) {
                     $nombreCompleto = $resultadoProf['apellidoProf'].", ".$resultadoProf['nombreProf'];
                    $id = $resultadoProf['id'];
                    
                    $consulta2 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesor.profesor_id, cargoprofesorestado.cargoProfesor_id, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '$id' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe = 'Activo'");
                    $resultadoLicencia = $consulta2->fetch_assoc();
                    $inicioLicencia = $resultadoLicencia["fechaDesdeCargoProfesorEstado"];
                    
                    
                    echo "<tr>
                    <td>" . $resultadoProf['legajoProf'] . "</td>
                    <td>" . $nombreCompleto . "</td>
                    <td>" . $resultadoProf['nombreCargo'] . "</td>
                    <td>" . $resultadoProf['nombreEstadoCargoProfe'] . "</td>
                    
                    <td class='text-center'>
                        <a class='btn btn-success btn-sm mb-1' ><i class='fa fa-edit'></i>Editar</a>
                        <a class='btn btn-danger btn-sm mb-1'><i class='fa fa-trash'></i>Baja</a>
                        <a class='btn btn-warning btn-sm mb-1'data-toggle='modal' data-target='#staticBackdrop2' onclick='setIdProf(".$id.")'><i class='fa fa-address-book-o'></i>Licencia</a> 
                        <input type='date' name='impIDprof' id='inicLic".$id."' value='$inicioLicencia' hidden>                      
                        
                    </td>
                    
                     
                    </tr>";
                    
                    
                    
                   
                    
                }
                
                
                ?>
                
                </tbody>
        </table>
    </div>
</div>

<!-- Modal asociar porfesor-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Agregar docente</h5>
            </div>
            <form method="POST" id="insertAlumno" name="insertAlumno" action="ingresarNuevoDocente.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    
                    <div class="my-2">
                        <h5 class="msg" id="msjValidacionApellido">Ingrese el DNI y Legajo del docente a agregar y su cargo</h5>
                    </div>
                    <div class="form-inline my-2">
                        <label for="cargo">Cargo</label>
                        <select id="cargo" name="cargo" class="custom-select mx-2" style="width:200px">
                            <?php
                                  include "../databaseConection.php";
                                

                                  $consultaD = $con->query("SELECT * FROM `cargo`");
                        
                                  while ($cargo = $consultaD->fetch_assoc()) {
                                      
                                      echo "<option value='".$cargo['id']."'>".$cargo['nombreCargo']."</option>";

                                  }
                            ?>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="inputLegajo">Legajo</label>
                        <input type="number" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo" required>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>
                    
                    
                    
                    <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<!-- Modal de licencias -->
<div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Licencia docente</h5>
                
            </div>
            
            
            <form method="POST" id="insertAlumno" name="insertAlumno" action="ingresarLicenciaDocente.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    
                    <h8>No se aceptan licencias pasadas, iniciadas antes de la fecha</h8>
                    
                    <div class="my-2">
                        <div class="form-inline my-2">
                          <label style="margin-right: 1rem;" for="fechaDesde">Inicio Licencia: </label>
                          <input type="date" id="fechaDesde" name="fechaDesde" onchange="habilitarFechaHasta()" class="form-control mr-2" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> <?php echo"value= '".$currentDateTime."'"; ?> required >
                          <h9 id="msgDesde"></h9>
                        </div>
                        <div class="form-inline my-2">
                          <label style="margin-right: 1.2rem;" for="fechaHasta">Fin Licencia: </label>
                          <input type="date" id="fechaHasta" name="fechaHasta" onchange="validarFechasJustificativo();" class="form-control mr-2" required disabled>
                          <h9 id="msgHasta"></h9>
                        </div>
                    </div>
                    
                    <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>
                    <input type="text" name="impIDprof" id="impIDprof" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="paginadoDataTable.js"></script>
<script src="funcionesLicencia.js"></script>


    <?php
include "../footer.html";
?>