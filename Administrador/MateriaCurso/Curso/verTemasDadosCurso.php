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
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."'");

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text"><?php echo $nombreRol;?></p>
        <h1>Temas dados anteriormente</h1>
        <h3 class='font-weight-normal'><?php echo " " . $curso["nombreCurso"] ?></h3>
        <a class="btn btn-info" <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/verCurso.php?id_curso=$id_curso'"; ?>><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>


    <div class="table-responsive">
        <table class="table text-center table-striped table-light" id="dataTable">
            <?php

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDate = date('Y-m-d H:i:s');
            $consulta1 = $con->query("SELECT temadia.profesor_id, temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia DESC");

            if (($consulta1->num_rows) == 0) {
                echo "<div class='alert alert-warning' role='alert'>
                                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han cargado temas en este curso.</h5>
                                </div>";
            } else {
                echo "<thead>
                                    <th>Fecha</th>
                                    <th>Tema</th>
                                    <th>Comentario</th>
                                    <th>Docente</th> 
                                </thead>
                                <tbody> ";

                while ($resultado1 = $consulta1->fetch_assoc()) {
                    $profTema = $resultado1['profesor_id'];
                    $datosProf = $con->query("SELECT * FROM `usuario` WHERE usuario.id = '$profTema'")->fetch_assoc();

                    $nombreProf = $datosProf["nombreUsuario"];
                    $apellidoProf = $datosProf["apellidoUsuario"];

                    $date = date_create($resultado1['fechaTemaDia']);
                    $fecha = date_format($date, "d/m/Y");

                    echo "<tr>
                                    <td>" . $fecha . "</td>
                                    <td>" . $resultado1['nombreTema'] . "</td>
                                    <td>" . $resultado1['comentarioTema'] . "</td>
                                    <td>" . $nombreProf . " " . $apellidoProf . "</td>
                                </tr>";
                }
                echo " </tbody>";
            }
            ?>
        </table>
    </div>
</div>

<script src="../../administrador.js"></script>
<script src="paginadoDataTable.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../../footer.html";
?>