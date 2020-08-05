<?php
include "../header.html";
include "../databaseConection.php";

//Se inicia o restaura la sesión
session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Si la variable id_curso no está definida se vuelve al index
if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Alumno/index.php");
}
?>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1>Pizarra de novedades</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Alumno/materiasAlumno.php'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <table class="table table-info table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>Tema</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Docente</th>
            </tr>
        </thead>
        <tbody id= "Publicaciones">
        <?php
            setlocale(LC_ALL, 'Spanish');//Formato de fechas en español strftime("%A %d %B %Y %H:%M:%S", strtotime(fecha));
            $consulta2 = $con->query("SELECT * FROM notificacionprofe WHERE curso_id = '$id_curso'");
            
            if (($consulta2->num_rows) > 0) {
                while ($resultado2 = $consulta2->fetch_assoc()) {
                    $profesor = $con->query("SELECT * FROM profesor WHERE id = '".$resultado2['profesor_id']."'")->fetch_assoc();
                    $fechaFormateada = strftime("%d de %B del %Y %H:%M", strtotime($resultado2['fechaHoraNotif']));
                    echo "<tr>
                    <td>" . $resultado2['asunto'] . "</td>
                    <td>" . $resultado2['mensaje'] . "</td>
                    <td>" . $fechaFormateada . "</td>  
                    <td>". $profesor['apellidoProf'].", ". $profesor['nombreProf'] ."</td> 
                    </tr>";
                }
            } else {
                
                echo "<br><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5>No se han realizado publicaciones</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div> ";
            }
        ?>
        </tbody>
    </table>
    
</div>

<?php
include "modal-autoasistencia.html";
?>

<script src="alumno.js"></script>

<?php
include "../footer.html";
?>