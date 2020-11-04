<?php
//-----------------------------------------------------------------------------------------------------------------------------
//Se inicia o restaura la sesión
session_start();

include "../../header.html"; // <-- Cambia
include "../../databaseConection.php"; // <-- Cambia

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 12")->fetch_assoc(); // <-- Cambia
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

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text"><?php echo $nombreRol;?></p>
        <h1>Validar justificativos</h1>
        <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    if(isset($_GET["resultado"])){          
        switch ($_GET["resultado"]) {
            case 0:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al validar el justificativo.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Justificativo validado correctamente.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;  
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>Ocurrió un error al reincoporar al alumno, tratar manualmente.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
        }
    }
    ?>

    <h4 class="font-weight-normal">Justificativos pendientes de evaluación</h4>
    <?php
    $consulta1 = $con->query("SELECT * FROM justificativo WHERE fechaRevision IS NULL ORDER BY fechaPresentacion");

    if(($consulta1->num_rows)==0){
        echo "<div class='alert alert-warning' role='alert'>
            <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay justificativos pendientes</h5>
        </div>";
    } else {
    ?>
    
    <table class="table table-bordered table-secondary">
        <thead>
            <th>Alumno</th>
            <th>Fecha presentación</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            while($justificativo = $consulta1->fetch_assoc()){
                $alumno = $con->query("SELECT * FROM alumno WHERE id = '".$justificativo['alumno_id']."'")->fetch_assoc();
                echo "<tr>
                    <td>".$alumno['apellidoAlum'].", ".$alumno['nombreAlum']."</td>
                    <td>".strftime("%d/%m/%Y", strtotime($justificativo['fechaPresentacion']))."</td>
                    <td class='text-center'><a class='btn btn-primary' href='verImagen.php?id=".$justificativo['id']."'><i class='fa fa-eye mr-1'></i>Ver</a></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    ?>

</div>

<script src="../administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'"; ?>
</script>

<?php
include "../../footer.html";
?>