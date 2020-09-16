<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
?>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Validar justificativos</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    if(isset($_GET["resultado"])){          
        switch ($_GET["resultado"]) {
            case 0:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <h5>Ocurrió un error al validar el justificativo.</h5>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                break;
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <h5>Justificativo validado correctamente.</h5>
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
            <h5>No hay justificativos pendientes</h5>
        </div>";
    } else {
    ?>
    
    <table class="table table-bordered table-info">
        <thead>
            <th>Nombre</th>
            <th>Fecha presentación</th>
            <th>Alumno</th>
            <th>Mostrar</th>
        </thead>
        <tbody>
            <?php
            while($justificativo = $consulta1->fetch_assoc()){
                $alumno = $con->query("SELECT * FROM alumno WHERE id = '".$justificativo['alumno_id']."'")->fetch_assoc();
                echo "<tr>
                    <td><a href='verImagen.php?id=".$justificativo['id']."'>".$justificativo['descripcionImagen']."</a></td>
                    <td>".strftime("%d/%m/%Y", strtotime($justificativo['fechaPresentacion']))."</td>
                    <td>".$alumno['apellidoAlum'].", ".$alumno['nombreAlum']."</td>
                    <td class='text-center'><a class='btn btn-success' href='verImagen.php?id=".$justificativo['id']."'><i class='fa fa-eye'></i></a></td>
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
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../../footer.html";
?>