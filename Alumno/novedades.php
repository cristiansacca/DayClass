<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../header.html"; // <-- Cambia
include "../databaseConection.php"; // <-- Cambia

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 17")->fetch_assoc(); // <-- Cambia
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

//Si la variable id_curso no está definida se vuelve al index
if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
} else {
    header("location:/DayClass/Alumno/index.php");
}
?>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Pizarra de novedades</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Alumno/materiasAlumno.php'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>


    <?php
    setlocale(LC_ALL, 'Spanish'); //Formato de fechas en español strftime("%A %d %B %Y %H:%M:%S", strtotime(fecha));
    $consulta2 = $con->query("SELECT * FROM notificacionprofe WHERE curso_id = '$id_curso' AND fechaHoraNotif >= '" . $curso['fechaDesdeCursado'] . "' AND fechaHoraNotif <= '" . $curso['fechaHastaCursado'] . "' ORDER BY (fechaHoraNotif) DESC");

    if (($consulta2->num_rows) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table table-secondary table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width: 50%;">Tema</th>
                        <th></th>
                        <th>Fecha</th>
                        <th>Docente</th>
                    </tr>
                </thead>
                <tbody id="Publicaciones">
                    <?php
                    while ($resultado2 = $consulta2->fetch_assoc()) {
                        $profesor = $con->query("SELECT * FROM usuario WHERE id = '" . $resultado2['profesor_id'] . "'")->fetch_assoc();
                        $fechaFormateada = strftime("%d de %B del %Y %H:%M", strtotime($resultado2['fechaHoraNotif']));
                        echo "<tr>
                        <td><a>" . $resultado2['asunto'] . "</a></td>
                        <td><a class='btn btn-primary text-light' onclick='setearPublicacion(" . $resultado2['id'] . ");' data-toggle='modal' data-target='#modalVerPublicacion'><i class='fa fa-eye mr-1 text-light'></i>Ver</a></td>
                        <td>" . $fechaFormateada . "</td>  
                        <td>" . $profesor['apellidoUsuario'] . ", " . $profesor['nombreUsuario'] . "</td> 
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {

        echo "<br><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No se han realizado publicaciones</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div> ";
    }
    ?>
</div>

<!-- Modal para ver publicación-->
<div class="modal fade" id="modalVerPublicacion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title"> Publicación </h5>
            </div>
            <div class="modal-body">
                <div>
                    <label>Asunto</label>
                    <input type="text" id="verAsunto" class="form-control" readonly>
                </div>
                <div class="my-2">
                    <label> Mensaje </label>
                    <textarea class="form-control" id="verMensaje" cols="30" rows="10" style="resize:none;" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarModal();">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="alumno.js"></script>
<script src="/DayClass/Profesor/PizarraNovedades/fnVerNovedades.js"></script>
<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../footer.html";
?>