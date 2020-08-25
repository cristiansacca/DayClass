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
                            <h5>El docente ya esta dicta esa materia</h5>
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

    <div class="my-3">
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-square mr-1"></i>Agregar Docente</a>
    </div>
   
        

    <div class="my-4">
        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Fecha Desde</th>
                <th>Fecha Hasta</th>
                <th>Estado</th>
                <th>Ingresar Licencia</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                include "../databaseConection.php";
                $id_curso = $_GET["id"];
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

                $consulta1 = $con->query("SELECT profesor.id, profesor.legajoProf, profesor.apellidoProf, profesor.nombreProf, estadocargoprofesor.nombreEstadoCargoProfe, cargo.nombreCargo FROM cargoprofesor, curso, profesor, cargoprofesorestado, estadocargoprofesor, cargo WHERE cargoprofesor.profesor_id = profesor.id AND cargoprofesor.curso_id = curso.id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.fechaDesdeCargo <= '$currentDateTime' AND cargoprofesor.fechaHastaCargo IS NULL AND cargoprofesor.id = cargoprofesorestado.cargoProfesor_id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id AND estadocargoprofesor.nombreEstadoCargoProfe <> 'Baja' AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$currentDateTime' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$currentDateTime' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");
                
                while ($resultadoProf = $consulta1->fetch_assoc()) {
                     $nombreCompleto = $resultadoProf['apellidoProf'].", ".$resultadoProf['nombreProf'];
                    $id = $resultadoProf['id'];
                    echo "<tr>
                    <td>" . $resultadoProf['legajoProf'] . "</td>
                    <td>" . $nombreCompleto . "</td>
                    <td>" . $resultadoProf['nombreCargo'] . "</td>
                    <td>" . $resultadoProf['nombreEstadoCargoProfe'] . "</td>
                    
                    <td class='text-center'>
                        <a class='btn btn-success btn-sm mb-1' ><i class='fa fa-edit'></i>Editar</a>
                        <a class='btn btn-danger btn-sm mb-1'><i class='fa fa-trash'></i>Baja</a>
                        <a class='btn btn-warning btn-sm mb-1'data-toggle='modal' data-target='#staticBackdrop2' onclick='setIdProf(".$id.")'><i class='fa fa-address-book-o'></i>Licencia</a> 
                                                
                    </td>
                    
                    </tr>";
                }
                
                
                ?>
                
                </tbody>
        </table>
    </div>
</div>






<?php
include "../databaseConection.php";

$id_curso= $_POST["cursoId"];
$id_docente = $_POST["impIDprof"];
$fchDesdeLicencia = $_POST["fechaDesde"];
$fchHastaLicencia = $_POST["fechaHasta"];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$consulta1 = $con->query("SELECT * FROM `curso` WHERE id = '$id_curso'");
$resultado1 = $consulta1->fetch_assoc();


//PARA MOSTRAR LAS FECHAS DE ACTIVIDAD Y LICENCIA DE UN DOCENTE
$consulta1 = $con->query("SELECT cargoprofesorestado.id, estadocargoprofesor.nombreEstadoCargoProfe, cargoprofesorestado.fechaDesdeCargoProfesorEstado, cargoprofesorestado.fechaHastaCargoProfesorEstado FROM cargoprofesor, estadocargoprofesor, cargoprofesorestado WHERE cargoprofesor.profesor_id = '103' AND cargoprofesor.curso_id = '18' AND cargoprofesorestado.cargoProfesor_id = cargoprofesor.id AND cargoprofesorestado.estadoCargoProfesor_id = estadocargoprofesor.id ORDER BY cargoprofesorestado.fechaDesdeCargoProfesorEstado ASC");


	
?>