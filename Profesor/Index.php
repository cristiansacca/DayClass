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

?>


<link rel="stylesheet" href="../styleCards.css">



<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1><?php echo " " . $_SESSION["profesor"]["nombreProf"] . " " . $_SESSION["profesor"]["apellidoProf"] ?></h1>
        <a href="editar_perfil.php" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Editar Perfil</a>
    </div>
    <h3 class="font-weight-normal">Cursos que dicta actualmente:</h3><br>
    <!-- Page Features -->
    <div class="row text-center">


        <?php
        $contador = 0;
        $id_prof = $_SESSION['profesor']['id'];
        $consultaCargo = $con->query("SELECT * FROM cargoprofesor WHERE profesor_id= '$id_prof'");

        while ($cargos = $consultaCargo->fetch_assoc()) {
            if ($contador == 4) {
                $contador = 0;
            }
            
            $consultaCursos = $con->query("SELECT * FROM curso WHERE id='" . $cargos['curso_id'] . "'");
            $resultadoCursos = $consultaCursos->fetch_assoc();

            echo "<div class='col-lg-6 col-md-3 mb-4' >
                <div class='card h-100 color$contador' >
                    <div class='card-body'>
                        <h4 class='card-title'>".$resultadoCursos["nombreCurso"]."</h4>
                    </div>
                    <div class='card-footer'>
                        <a href='indexCurso.php?id_curso=".$resultadoCursos["id"]."' class='btn btn-primary btn-lg'>Ingresar</a>
                    </div>
                </div>
            </div>";

            $contador++;
        }

        ?>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="profesor.js"></script>
<script>
    $("#temaDia").attr("hidden", "hidden")
</script>

<?php
include "../footer.html";
?>