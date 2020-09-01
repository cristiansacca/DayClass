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

<script src="administrador.js"></script>
<script src="validarDiasCurso.js"></script>

<link rel="stylesheet" href="../styleCards.css">

<div class="container ">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Cursos</h1>
        <a href="/DayClass/Administrador/administrar-materia.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Curso creado exitosamente</h5>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El documento o legajo ingresado ya se encuentra registrado</h5>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Baja exitosa del curso</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en la baja del curso</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>


    <div class="my-2">
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus-square mr-1"></i>Nuevo curso </a>
    </div>


    <div class="my-2">

        <table id="dataTable" class="table table-info table-bordered table-hover">
            <thead>
                <th>Nombre</th>
                <th>Division</th>
                <th>Modalidad</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
                <?php
                include "../databaseConection.php";
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

                $id_materia = $_GET["id"];
                $consulta1 = $con->query("SELECT * FROM curso WHERE materia_id = '$id_materia' AND `fechaHastaCurActul` IS NULL");


                while ($resultadoCurso = $consulta1->fetch_assoc()) {

                    $division = $resultadoCurso['division_id'];

                    $consulta2 =  $con->query("SELECT * FROM division WHERE id = '$division'");
                    $resultado2 = $consulta2->fetch_assoc();

                    $modalidad = $resultado2['modalidad_id'];

                    $consulta3 = $con->query("SELECT * FROM modalidad WHERE id = '$modalidad'");
                    $resultado3 = $consulta3->fetch_assoc();

                    $id = $resultadoCurso["id"];
                    $urlEditarCurso = "editarCurso.php?id=$id";
                    $urlBajaCurso = "bajaCurso.php?id=$id";

                    $nombreCurso = $resultadoCurso['nombreCurso'];
                    
                    $fechaDesdeCursado = $resultadoCurso['fechaDesdeCursado'];
                    $fechaHastaCursado = $resultadoCurso['fechaHastaCursado'];
                    
                    $classHabilitado = "btn btn-danger btn-sm mb-1";
                    
                    if($fechaDesdeCursado != null && $fechaHastaCursado != null) {
                        if($fechaHastaCursado >= $currentDateTime){
                            $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado'  AND `curso_id` = '$id' ");

                            if(mysqli_num_rows($consultaAlumnos) == 0 ){
                                $classHabilitado = "btn btn-danger btn-sm mb-1";
                            }else{
                                $classHabilitado = "btn btn-danger btn-sm mb-1 disabled";
                            }
                        }else{
                            $classHabilitado = "btn btn-danger btn-sm mb-1";
                        }
                        
                    }
                    
                    echo "<tr>
                    <td>" . $nombreCurso . "</td>
                    <td>" . $resultado2['nombreDivision'] . "</td>
                    <td>" . $resultado3['nombre'] . "</td>
                    
                    <td class='text-center'>
                        <a class='btn btn-success btn-sm mb-1' data-emp-id=" . $id . " onclick='' href='$urlEditarCurso'><i class='fa fa-edit'></i></a>
                        <a class='$classHabilitado' data-emp-id=" . $id . " onclick='return confirmDelete()' href='$urlBajaCurso'><i class='fa fa-trash'></i></a>
                                                
                    </td>
                    
                    <td class='text-center'>
                        <a class='btn btn-warning btn-sm mb-1' data-emp-id=" . $id . " href='editarDocentesCurso.php?id=$id'><i class=' fa fa-user-plus mr-1'></i>Docentes</a> 
                        <a class='btn btn-info btn-sm mb-1' data-emp-id=" . $id . " href='inscribirAlumnos.php?id=$id'><i class=' fa fa-user-plus mr-1'></i>Alumnos</a>                              
                    </td>
                    
                    
                    
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal nuevo curso -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Añadir Curso</h5>
            </div>
            <form id="crearCurso" name="crearCurso" action="crearCurso.php" method="POST" enctype="multipart/form-data" role="form" onsubmit="return enviar()">

                <div class="modal-body">
                    <div class="my-2">

                        <label for="divisiones"> Divisiones </label>
                        <select name="divisiones" id="divisiones" class="custom-select">

                            <?php
                            include "../databaseConection.php";
                            $id_materia = $_GET["id"];

                            $consultaD = $con->query("SELECT * FROM division LEFT JOIN (SELECT curso.id as idCurso, curso.division_id as idDivision FROM curso WHERE curso.materia_id = '$id_materia' AND curso.fechaHastaCurActul IS NULL) as A ON A.idDivision = division.id where A.idCurso IS NULL");

                            //"SELECT * FROM `division`"

                            while ($divisiones = $consultaD->fetch_assoc()) {

                                echo "<option value='" . $divisiones['id'] . "'>" . $divisiones['nombreDivision'] . "</option>";
                            }

                            ?>

                        </select>

                    </div>
                    <div class="form-group">


                        <table id="dataTable" class="table">
                            <thead>
                                <th>Dia</th>
                                <th>Hora desde</th>
                                <th>Hora hasta</th>

                            </thead>

                            <tbody>
                                <?php
                                include "../databaseConection.php";

                                $consulta = $con->query("SELECT * FROM `cursoDia`");

                                while ($dias = $consulta->fetch_assoc()) {

                                    echo "<tr>
                            <td> <input class='checkDia' type='checkbox' id='" . $dias['nombreDia'] . "' onclick='habilitarTimeP(this.id)'><label class='ml-2' name='dia[]'>" . $dias['nombreDia'] . "</label></td>
                            <td><input type='time'  id='" . $dias['nombreDia'] . "1' onchange='habilitar2do(this.id)' disabled></td>
                            <td><input type='time' id='" . $dias['nombreDia'] . "2' onchange='validar(this.id)' disabled> </td>
                            </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <input type="text" id="arregloDiasHorario" name="arregloDiasHorario" hidden>
                        <input type="text" name="materiaId" id="materiaId" <?php echo "value= '" . $id_materia . "'"; ?> hidden>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="Submit" class="btn btn-primary"> Crear </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
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
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../footer.html";
?>