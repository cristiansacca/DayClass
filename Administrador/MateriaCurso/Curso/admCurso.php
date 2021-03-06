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
  

                
date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDateTime = date('Y-m-d');

$id_materia = $_GET["id"];
$materia = $con->query("SELECT * FROM materia WHERE id = '$id_materia'")->fetch_assoc();

?>

<script src="../../administrador.js"></script>
<script src="fnValidarDiasCurso.js"></script>

<link rel="stylesheet" href="../../../styleCards.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<div class="container ">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Cursos</h1>
        <h5 class="font-weight-normal"><?php echo $materia['nombreMateria']." Nivel ".$materia['nivelMateria']; ?></h5>
        <a href="/DayClass/Administrador/MateriaCurso/Materia/admMateria.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Curso creado exitosamente.</h5>";
                break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El documento o legajo ingresado ya se encuentra registrado.</h5>";
                break;
            case 3:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa del curso.</h5>";
                break;
            case 4:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja del curso.</h5>";
                break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>


    <div class="my-2">
    <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus-square mr-1"></i>Nuevo curso </a>
    </div>

    <div class="my-2 table-responsive">
        <table id="dataTableCursos" class="table table-secondary table-bordered table-hover">
            <thead hidden>
                <th>Nombre</th>
                <th>División</th>
                <th>Modalidad</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                
                $consulta1 = $con->query("SELECT * FROM curso WHERE materia_id = '$id_materia' AND `fechaHastaCurActul` IS NULL");
                
                
                if(($consulta1->num_rows)== 0){
                    echo "<div class='alert alert-warning' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay cursos creados para esta materia.</h5>
                    </div>"; 
                }else{
                    
                


                while ($resultadoCurso = $consulta1->fetch_assoc()) {

                    $division = $resultadoCurso['division_id'];

                    $consulta2 =  $con->query("SELECT * FROM division WHERE id = '$division'");
                    $resultado2 = $consulta2->fetch_assoc();

                    $modalidad = $resultado2['modalidad_id'];

                    $consulta3 = $con->query("SELECT * FROM modalidad WHERE id = '$modalidad'");
                    $resultado3 = $consulta3->fetch_assoc();

                    $id = $resultadoCurso["id"];
                    $urlEditarCurso = "modifFechasCursadoCurso.php?id=$id";
                    
                    $urlEditarCurso = "verCurso.php?id_curso=$id";
                    
                    $urlBajaCurso = "bajaCurso.php?id=$id";

                    $nombreCurso = $resultadoCurso['nombreCurso'];
                    
                    $fechaDesdeCursado = $resultadoCurso['fechaDesdeCursado'];
                    $fechaHastaCursado = $resultadoCurso['fechaHastaCursado'];
                    
                    $classHabilitado = "btn btn-danger mb-1";
                    
                    if($fechaDesdeCursado != null && $fechaHastaCursado != null) {
                        if($fechaHastaCursado >= $currentDateTime){
                            $consultaAlumnos = $con->query("SELECT * FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` = '$fechaDesdeCursado' AND `fechaHastaAlumCurAc` = '$fechaHastaCursado'  AND `curso_id` = '$id' ");

                            if(mysqli_num_rows($consultaAlumnos) == 0 ){
                                $classHabilitado = "btn btn-danger mb-1";
                            }else{
                                $classHabilitado = "btn btn-danger mb-1 disabled";
                            }
                        }else{
                            $classHabilitado = "btn btn-danger mb-1";
                        }
                        
                    }
                    
                    echo "<tr>
                    <td>" . $nombreCurso . "</td>
                    <td>" . $resultado3['nombre'] . "</td>
                    
                    <td class='text-center'>
                        <a class='btn btn-info mb-1' data-emp-id=" . $id . " href='alumnosCurso.php?id=$id'><i class=' fa fa-user mr-1'></i>Alumnos</a>                              
                        <a class='btn btn-warning mb-1' data-emp-id=" . $id . " href='docentesCurso.php?id=$id'><i class=' fa fa-graduation-cap mr-1'></i>Docentes</a> 
                    </td>
                    <td class='text-center'>
                        <a class='btn btn-primary mb-1' data-emp-id=" . $id . " onclick='' href='$urlEditarCurso'><i class='fa fa-book mr-1'></i>Ver curso</a>
                        <a class='$classHabilitado' data-emp-id=" . $id . " onclick='return confirmDelete()' href='$urlBajaCurso' style='width:85px'><i class='fa fa-trash mr-1'></i>Baja</a>
                                                
                    </td>                  
                    
                    </tr>";
                }
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
            <form id="crearCurso" name="crearCurso" action="altaCurso.php" method="POST" enctype="multipart/form-data" role="form" onsubmit="return enviar()">

                <div class="modal-body">
                    <div class="my-2">

                        <label for="divisiones"> Divisiones </label>
                        <select name="divisiones" id="divisiones" class="custom-select">

                            <?php
                            include "../../../databaseConection.php";
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
                                include "../../../databaseConection.php";

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                    <button type="submit" class="btn btn-primary"> Crear </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $("#dataTableCursos").DataTable({
    ordering:false,
    language: {
        processing:     "Procesando...",
        lengthMenu: "Mostrar _MENU_ por página",
        zeroRecords: "No hay coincidencias",
        info: "Página _PAGE_ de _PAGES_",
        infoEmpty: "No se encontraron datos",
        infoFiltered: "(Filtrada de _MAX_ filas)",
        loadingRecords: "Cargando...",
        infoPostFix:    "",
        search: "Buscar:",
        paginate: {
            first: "Primero",
            previous: "Anterior",
            next: "Siguiente",
            last: "Último"
        },
        aria: {
            sortAscending:  ": Ordenar de manera ascendente",
            sortDescending: ": Ordenar de manera descendente"
        }
    }
});
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>
<?php
include "../../../footer.html";
?>