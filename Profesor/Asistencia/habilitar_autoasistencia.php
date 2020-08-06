<?php
include "../../header.html";
include "../../databaseConection.php";

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
        <h1>Habilitar auto-asistencia</h1>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-secondary"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <?php
        if(isset($_GET['codigo'])){
            $codigo = $_GET['codigo'];
            if(!$codigo == ""){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h5>El código <b>$codigo</b> se habilitó correctamente</h5>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <h5>Ocurrió un error al habilitar el código</h5>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
            }
        }
    ?>
    <div class="mt-4">
        <form action="habilitarCodigo.php" method="POST">
            <div class="text-center row">
                <div class="form-group col-md-6">
                    <h3>Código de auto-asistencia</h3>
                    <br>
                    <input type="text" class="form-control m-auto text-center" style="width: auto" id="outCodigoAutoasist" name="codigoAsis" readonly>
                    <br>
                    <button type="button" class="btn btn-primary" id="btnCodigoAutoasist" onclick="generarCodigo(); return false;"><i class="fa fa-refresh mr-2"></i>Generar</button>
                </div>    
                <div class="form-group col-md-6">
                    <h3>Duración del código</h3><br>
                    <select class="form-control m-auto" name="tiempo" style="width: auto;" required>
                        <option value="" selected>Seleccione</option>
                        <option value="5">5 minutos</option>
                        <option value="10">10 minutos</option>
                        <option value="15">15 minutos</option>
                        <option value="20">20 minutos</option>
                        <option value="30">30 minutos</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="text" <?php echo "value='$id_curso'"; ?> name="id_curso" hidden>
                <button type="submit" id="btnHabilitar" class="btn btn-success" disabled = "disabled"><i class="fa fa-check-circle mr-2"></i>Habilitar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="../profesor.js"></script>
<script src="funciones_habilitarAutoasistencia.js"></script>

<?php
include "../../footer.html";
?>