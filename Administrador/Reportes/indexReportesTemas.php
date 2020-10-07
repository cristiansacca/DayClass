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

?>
<div class="container">
    
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Reportes de Temas Dados</h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    
    <h4>Seleccione los datos para generar el reporte </h4>
    
    <div id="resultadoMostrar"></div>

    <form method="POST" id="crearReporte" name="crearReporte" action="verDatosReportesTemas.php" enctype="multipart/form-data" role="form" onsubmit="return enviarReporte()">
        
        <div class="form-row">
        <div class="form-group col-md-6">
          <label>Materia</label>
            <select id="materia" name="materia" class="custom-select" required>
                <option value="" selected>Materia</option>
                <?php
                
                $selectMateria = $con->query("SELECT * FROM `materia` WHERE materia.fechaAltaMateria <= '$currentDate' AND materia.fechaBajaMateria IS NULL ORDER BY materia.nombreMateria ASC");
                
                if(mysqli_num_rows($selectMateria) != 0){
                    while($materia = $selectMateria->fetch_assoc()){
                        echo "<option value='".$materia["id"]."'>".$materia["nombreMateria"]." ".$materia["nivelMateria"]."</option>";
                    }
                }

                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
          <label>Curso</label>
          <select id="curso" name="curso" class="custom-select" required disabled>
                <option value="" selected>Curso</option>
                
            </select>
        </div>
              
      </div>
        
        <div class="form-row">
        <div class="form-group col-md-6">
          <label>Fecha Desde</label>
          <input type="date" class="form-control" id="inputFechaDesdeReporte" name="inputFechaDesdeReporte" onchange="habilitarFechaHasta()" <?php echo "max='$currentDate'" ?>required>
          
        </div>

        <div class="form-group col-md-6">
          <label>Fecha Hasta</label>
          <input type="date" class="form-control" id="inputFechaHastaReporte" name="inputFechaHastaReporte" <?php echo "max='$currentDate'" ?> required disabled>
         
        </div>  
      </div>
        <button type="submit" class="btn btn-primary">Generar</button>   
    </form>
 

    
    
</div>

<script src="../administrador.js"></script>
<script src="fnReporteTemas.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../footer.html";
?>