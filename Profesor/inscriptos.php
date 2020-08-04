<?php
include "../header.html";
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

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
                $consulta2 = $con->query("SELECT * FROM alumnocursoactual WHERE curso_id = '$id_curso' AND fechaHastaAlumCurAc is NULL");

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

<script src="profesor.js"></script>

<?php
include "../footer.html";
?>