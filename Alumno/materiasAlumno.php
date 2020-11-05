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
        <h1>Materias en las que está inscripto</h1>
        <a class="btn btn-info" href="/DayClass/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
    </div>
    <!-- Page Features -->
    <div class="row text-center my-5">

        <?php
        include "../databaseConection.php";

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');

        //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
        $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '" . $_SESSION['usuario']['id'] . "' AND `fechaDesdeAlumCurAc` <= '$currentDateTime' AND  `fechaHastaAlumCurAc` >= '$currentDateTime'");
        $contador = 0;


        if (($consulta1->num_rows) == 0) {
            echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavia no esta inscripto a ninguna materia.</h5>
                </div>";
        } else {
            while ($alumnocursoactual = $consulta1->fetch_assoc()) {
                if ($contador == 4) {
                    $contador = 0;
                }
                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                $consulta2 = $con->query("SELECT * FROM curso WHERE id = '" . $alumnocursoactual['curso_id'] . "'");
                $curso = $consulta2->fetch_assoc();

                //Se buscan todos los CargoProfesor de ese curso

                $id_curso = $curso['id'];
                $consulta3 = $con->query("SELECT * FROM cargoprofesor WHERE curso_id ='$id_curso' AND fechaDesdeCargo <= '$currentDateTime' AND fechaHastaCargo IS NULL");

                echo "<div class='col-lg-6 col-md-12 mb-4' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>" . $curso["nombreCurso"] . "</h3>
                        <h6  class='mx-3'>Profesores</h6>
                        <ul style='list-style: none;'>";
                while ($cargoprofesor = $consulta3->fetch_assoc()) {
                    //Por cada CargoProfesor obtiene el cargo
                    $id_cargo = $cargoprofesor['cargo_id'];
                    $cargo = $con->query("SELECT * FROM cargo WHERE id = '$id_cargo' AND fechaAltaCargo <= '$currentDateTime' AND fechaFinCargo IS NULL")->fetch_assoc();

                    //Por cada CargoProfesor obtiene el profesor
                    $id_prof = $cargoprofesor['profesor_id'];
                    $profesor = $con->query("SELECT * FROM usuario WHERE id = '$id_prof' AND fechaAltaProf <= '$currentDateTime' AND fechaBajaUsuario IS NULL")->fetch_assoc();

                    echo "<li>" . $cargo['nombreCargo'] . ": " . $profesor['nombreUsuario'] . " " . $profesor['apellidoUsuario'] . "</li>";
                }
                echo " </ul>
                    </div>
                    <div class='card-footer'>
                        <a href='cursoInfo.php?id_curso=" . $curso['id'] . "' class='btn btn-primary'><i class='fa fa-book mr-1'></i>Ver curso</a>
                        <a href='novedades.php?id_curso=" . $curso['id'] . "' class='btn btn-success'><i class='fa fa-newspaper mr-1'></i>Novedades</a>
                    </div>
                </div>
            </div>";

                $contador++;
            }
        }

        ?>

    </div>

</div>

<script src="alumno.js"></script>
<script>
  <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['alumno']['nombreAlum'] . " " . $_SESSION['alumno']['apellidoAlum'] . "'" ?>
</script>

<?php
include "../footer.html";
?>