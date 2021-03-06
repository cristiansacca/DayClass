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



?>

<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
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

        <a class="btn btn-info" href="/DayClass/Alumno/materiasAlumno.php"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <a class="btn btn-success" <?php echo "href='/DayClass/Alumno/verTemasDados.php?id_curso=$id_curso'"; ?>><i class="fa fa-bookmark mr-2"></i>Temas dados</a>
    </div>
    <!-- Page Features -->
    <h2>Docentes</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
        include "../databaseConection.php";
        $id_curso = $_GET["id_curso"];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        $consulta2 = $con->query("SELECT usuario.id, usuario.emailUsuario, usuario.apellidoUsuario, usuario.nombreUsuario, cargo.nombreCargo FROM cargoprofesor, curso, usuario, cargo WHERE `fechaDesdeCargo` <= '$currentDateTime' AND `fechaHastaCargo` IS NULL AND `curso_id` = '$id_curso' AND cargoprofesor.curso_id = curso.id AND cargoprofesor.profesor_id = usuario.id AND cargoprofesor.cargo_id = cargo.id");

        if (($consulta2->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no hay docentes asignados a este curso, pronto entarán disponibles.</h5>
                </div>";
        } else {

            while ($docentesCurso = $consulta2->fetch_assoc()) {

                $nombreDocente = $docentesCurso["nombreUsuario"];
                $apellidoDocente = $docentesCurso["apellidoUsuario"];
                $cargoDocente = $docentesCurso["nombreCargo"];
                $mailDocente = $docentesCurso["emailUsuario"];

                if ($mailDocente == "" || $mailDocente == null) {
                    $mailDocente = "Correo electronico no registrado";
                }

                echo "<h4>$cargoDocente:</h4><h5 class='font-weight-normal' style='display:inline'>$apellidoDocente, $nombreDocente - $mailDocente</h5>";
            }
        }
        ?>
    </div>

    <div class="row my-4">
        <?php
        include "../databaseConection.php";

        $id_curso = $_GET["id_curso"];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        $consulta3 = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");

        $contador = 0;


        if (($consulta3->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han definido horaios para este curso</h5>
                </div>";
        } else {

            echo "<div class='col-lg-12'><h2>Horarios de cursado</h2></div>";
            while ($horarioCurso = $consulta3->fetch_assoc()) {
                if ($contador == 4) {
                    $contador = 0;
                }

                $dia = $horarioCurso["nombreDia"];
                $horaDesde = $horarioCurso["horaInicioCurso"];
                $horaHasta = $horarioCurso["horaFinCurso"];
                echo "<div class='col-lg-4 my-3' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>$dia</h3>
                        <h5 class='font-weight-normal'>Desde: " . strftime("%H:%M", strtotime($horaDesde)) . "</h5>
                        <h5 class='font-weight-normal'>Hasta: " . strftime("%H:%M", strtotime($horaHasta)) . "</h5>
                    </div>
                </div>
            </div>";

                $contador++;
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

                <div class="table-responsive">
                    <h9>Temas dados durante el cursado</h9>

                    <table class="table text-center table-striped">

                        <?php
                        include "../databaseConection.php";
                        $id_curso = $_GET["id_curso"];

                        $consulta1 = $con->query("SELECT temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia ASC");


                        if (($consulta1->num_rows) == 0) {
                            echo "<div class='alert alert-warning' role='alert'>
                                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no se han cargado temas en este curso</h5>
                                        </div>";
                        } else {
                            echo "<thead>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Comentario del docente</th>
                                        </thead>
                                       <tbody> ";


                            while ($resultado1 = $consulta1->fetch_assoc()) {

                                $date = date_create($resultado1['fechaTemaDia']);
                                $fecha = date_format($date, "d/m/Y");

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

<script src="alumno.js"></script>
<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../footer.html";
?>