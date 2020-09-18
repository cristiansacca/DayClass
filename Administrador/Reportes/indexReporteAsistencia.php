<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
?>
<div class="container">
    
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Reportes de asistencia</h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    
    <h4>Seleccione los datos para generar el reporte </h4>

    <form action="">
        
        <div class="form-row">
        <div class="form-group col-md-4">
          
            <select id="unidadTema" name="unidadTema" class="custom-select" class="custom-select" required>
                <option value="" selected>Materia</option>
                <?php
                
                $selectMateria = $con->query("SELECT * FROM `materia` WHERE materia.fechaAltaMateria <= '$currentDate' AND materia.fechaBajaMateria IS NULL ORDER BY materia.nombreMateria ASC");
                
                if(mysqli_num_rows($selectMateria) != 0){
                    while($materia = $selectMateria->fetch_assoc()){
                        echo "<option value='".$materia["nombreMateria"]."'>".$materia["nombreMateria"]." ".$materia["nivelMateria"]."</option>";
                    }
                }

                ?>
            </select>
        </div>

        <div class="form-group col-md-4">
          
          <select id="nombreTema" name="nombreTema" class="custom-select" disabled>
                <option value="" selected>Curso</option>
                
            </select>
        </div>
            
        <div class="form-group col-md-4">
          
          <select id="nombreTema" name="nombreTema" class="custom-select" disabled>
                <option value="" selected>Alumno</option>
                
            </select>
        </div>
            
            
      </div>
        
        <div class="form-row">
        <div class="form-group col-md-6">
          <label>Fecha Desde</label>
          <input type="date" class="form-control" id="inputFechaDesdeReporte" name="inputFechaDesdeReporte" required>
          <h9 class="msg" id="msjValidacionDNI"></h9>
        </div>

        <div class="form-group col-md-6">
          <label>Fecha Hasta</label>
          <input type="date" class="form-control" id="inputFechaHastaReporte" name="inputFechaHastaReporte" required>
          <h9 class="msg" id="msjValidacionLegajo"></h9>
        </div>
            
        
            
            
      </div>


        <button type="submit" class="btn btn-primary">Generar</button>
            
    </form>
 

    
    
</div>

<script src="administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../footer.html";
?>