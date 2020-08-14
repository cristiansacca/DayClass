<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Inscriptos en <?php echo " " . $curso["nombreCurso"] ?></h1>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-secondary"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div>
        <table class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>DNI</th>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d H:i:s');
                $consulta2 = $con->query("SELECT alumno_id FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` < '$currentDateTime' AND `fechaHastaAlumCurAc` > '$currentDateTime' AND `curso_id` =  $id_curso");

                while($alumnocursoactual = $consulta2->fetch_assoc()){
                    $alumno = $con->query("SELECT * FROM alumno WHERE id = '".$alumnocursoactual['alumno_id']."'")->fetch_assoc();
                    echo "<tr>
                        <td>".$alumno['legajoAlumno']."</td>
                        <td>".$alumno['apellidoAlum']."</td>
                        <td>".$alumno['nombreAlum']."</td>
                        <td>".$alumno['dniAlum']."</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>

<?php
include "../footer.html";
?>