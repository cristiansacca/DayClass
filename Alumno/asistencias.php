<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<div class="container">
    <div class="py-4 my-3 jumbotron bg-light">
        <h1>Información de asistencias</h1>
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Atras</a>
    </div>
    <div class="form-group">
            <?php
              include "../databaseConection.php";
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

              //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
              $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '".$_SESSION['alumno']['id']."' AND `fechaDesdeAlumCurAc` <= '$currentDateTime' AND  `fechaHastaAlumCurAc` >= '$currentDateTime'");
              
            if(($consulta1->num_rows) == 0){
            echo "<div class='alert alert-warning' role='alert'>
                    <h5>Todavia no esta inscripto a ninguna materia, no puede justiticar .</h5>
                </div>";
            }else{
                
                echo "<label for=''>Seleccione la materia:</label>";
                echo "<select name='' id='materias' class='custom-select'>";
              while ($alumnocursoactual = $consulta1->fetch_assoc()) {
                  
                //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
                  $curso = $con->query("SELECT * FROM curso WHERE id = '".$alumnocursoactual['curso_id']."'")->fetch_assoc();

                  echo "<option value='".$curso['id']."'>".$curso['nombreCurso']."</option>";

              }
                echo "</select>";
            }
        ?>
        
    </div>
    <h3 class="text-danger">De acá para abajo está hardcodeado</h3>
    <div class="form-gruup">
        <label for="" class="mr-2">Cantidad de clases: 4</label><br>
        <label for="">Faltas disponibles: 8</label><br>
        <label for="" class="mr-2">Presentes: 2</label><br>
        <label for="" class="mr-2">Ausentes: 2</label><br>
    </div>
    <div>
        <table class="table table-bordered text-center table-info table-sm">
            <thead>
                <th>Fecha</th>
                <th>Asistencia</th>
                <th>Justificado</th>
            </thead>
            <tbody>
                <tr>
                    <td>Lunes 25/04</td>
                    <td class="text-success">Presente</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Lunes 25/04</td>
                    <td class="text-success">Presente</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Lunes 25/04</td>
                    <td class="text-danger">Ausente</td>
                    <td>Sí</td>
                </tr>
                <tr>
                    <td>Lunes 25/04</td>
                    <td class="text-danger">Ausente</td>
                    <td>No</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="alumno.js"></script>

<?php
include "modal-autoasistencia.php";
?>

<?php
include "../footer.html";
?>