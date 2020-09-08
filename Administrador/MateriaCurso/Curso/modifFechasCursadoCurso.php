<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

$id_admin = $_SESSION['administrador']["id"];

$consulta1 = $con->query("SELECT `legajoAdm`,`apellidoAdm`,`nombreAdm`,`dniAdm`, `emailAdm`, `fechaNacAdm`, `id` FROM `administrativo` WHERE id = '$id_admin'");
$resultado1 = $consulta1->fetch_assoc();

$_SESSION['administrador']= $resultado1;


?>

<script src="../../administrador.js"> </script>

<div class="container">
      
  <div class="jumbotron my-4 py-4">
      <p class="card-text">Administrador</p>
      
      <h5>Editar Curso</h5>
      
      <?php
            $id_curso = $_GET['id'];
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDateTime = date('Y-m-d H:i:s');
            $currentDate = date('Y-m-d');
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
        
            echo "<h1>$nombreCurso</h1>";
      
            $rtdo = false;
      
            if(($fchDesde < $currentDateTime &&  $fchHasta < $currentDateTime) || ($fchDesde == "" &&  $fchHasta == "")){
                echo "<div class='alert alert-danger' role='alert'>
                            <h5>Se deben ingresar las fechas de cursado para este año.</h5>
                        </div>";          
            }else{
                echo "<div class='alert alert-success' role='alert'>
                            <h5>Las fechas de cursado son correctas</h5>
                        </div>";
                $rtdo = true;
            }  
        
        ?>
      
      <a <?php echo "href='/DayClass/Administrador/MateriaCurso/Curso/admCurso.php?id=".$resultado['materia_id']."'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
  </div>
  <?php
        if(isset($_GET["resultado"])){

            switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Modificación exitosa</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Ocurrio un error en la actualizacion</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;

            }


        }

        ?>
  <div class="mt-2 mx-auto">
    <form method="post" id="editarCurso" name="editarCurso" action="modifCurso.php" onsubmit="" enctype="multipart/form-data" role="form">
      <div class="fill_fields">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputInicio">Inicio Cursado:</label>
            <input type="date" class="form-control" id="inputInicioCursado" name="inputInicioCursado" placeholder="Fecha Inicio Cursado" required 
                   <?php  
                        if($rtdo){
                            echo "disabled";
                            echo " value='".$fchDesde."'";
                        }else{
                            echo "onchange='habilitarSegundaFecha()'";
                            echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'";
                        }
                   ?>
                   >
              
            <h9 class="msg" id="msjValidacionFechaI"></h9>
          </div>
         
            <div class="form-group col-md-6">
            <label for="inputHasta">Fin Cursado:</label>
            <input type="date" class="form-control" id="inputFinCursado" name="inputFinCursado" placeholder="Fecha Fin Cursado" disabled required <?php echo "min='".date("Y")."-01-01' "."max='".date("Y")."-12-31'";
                 if($rtdo){
                            echo "disabled";
                            echo " value='".$fchHasta."'";
                        }  ?>>
            <h9 class="msg" id="msjValidacionFechaH"></h9>
          </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary" <?php  
                        if($rtdo){
                            echo "disabled";
                            
                        }
                   ?>>
        <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>
        <input type="text" name="todayDate" id="todayDate" <?php echo"value= '".$currentDate."' "; ?> hidden>
          
      </div>
    </form>
  </div>
</div>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../../../footer.html";
?>