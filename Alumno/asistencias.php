<?php
include "../header.html";

//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<div class="container">
    <h1 class="display-4">Información de asistencias</h1>
    <div class="form-group">
        <label for="">Seleccione la materia:</label>
        <select name="" id="materias" class="custom-select">
            <option value="1">Materia 1</option>
            <option value="2">Materia 2</option>
        </select>
    </div>
    <div class="form-gruup">
        <label for="" class="mr-2">Cantidad de clases: 4</label><br>
        <label for="">Faltas disponibles: 8</label><br>
        <label for="" class="mr-2">Presentes: 2</label><br>
        <label for="" class="mr-2">Ausentes: 2</label><br>
    </div>
    <div>
        <table class="table table-bordered text-center table-info">
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

<?php
include "modal-autoasistencia.html";
?>

<script src="alumno.js"></script>

<?php
include "../footer.html";
?>