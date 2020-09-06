<?php
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if (isset($_GET["id_curso"])) {
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
} else {
    header("location:/DayClass/Profesor/index.php");
}

$id_curso = $_GET["id_curso"];

$consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
$curso = $consulta1->fetch_assoc();


date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$consultaAsistMismoDia = $con->query("SELECT * FROM `asistenciadia`, asistencia, curso WHERE curso.id = $id_curso AND curso.id = asistencia.curso_id AND asistencia.id = asistenciadia.asistencia_id AND asistenciadia.fechaHoraAsisDia LIKE '$currentDate%'");

if(!($consultaAsistMismoDia)==0){
    header("location: /DayClass/Profesor/indexCurso.php?id_curso=$id_curso&&resultado=3");
}

?>


<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1 class="my-2">Asistencia</h1>
        <h5 class="my-2"><?php echo $curso["nombreCurso"] ?></h5>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-secondary"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="text-center">
        <?php
        
        echo " <input type='text' hidden id='idCurso' name='idCurso' value='$id_curso'>";

        date_default_timezone_set('America/Argentina/Mendoza');
        $currentDateTime = date('Y-m-d H:i:s');
        

        $consulta1 = $con->query("SELECT alumno.id, apellidoAlum, nombreAlum, legajoAlumno FROM alumno, alumnocursoactual, curso WHERE alumno.id = alumno_id AND curso_id = curso.id AND curso.id = '$id_curso' AND `fechaHastaAlumCurAc` > '$currentDateTime'");

        $contador = 1;
        while ($resultado1 = $consulta1->fetch_assoc()) {
            $nombreAlum = $resultado1["nombreAlum"];
            $apellidoAlum = $resultado1["apellidoAlum"];
            $idAlum = $resultado1["id"];
            $legajoAlum = $resultado1["legajoAlumno"];

            $aux = $contador + 1;
            $ausente = "Ausente";
            $presente = "Presente";

            echo "<div class='mySlides'>
                <i class='fa fa-user-circle-o fa-5x'></i>
                <br>
                <label id='labelLegajo' style='font-size:xx-large;'>$legajoAlum</label>
                <br>
                <label id='labelNombreApellido' style='font-size:xx-large;'>$apellidoAlum, $nombreAlum</label>
                
                <div>
                    <button class='btn btn-lg btn-danger mx-2' id='$ausente-$nombreAlum-$apellidoAlum' onclick='currentSlide($aux,this.id,$legajoAlum)'><i class='fa fa-ban mx-1'></i>Ausente</button>
                    <button class='btn btn-lg btn-success mx-2' id='$presente-$nombreAlum-$apellidoAlum' onclick='currentSlide($aux,this.id,$legajoAlum)'><i class='fa fa-check mx-1'></i>Presente</button>
                </div>
            </div>";

            $contador++;
        }

        ?>
    </div>
   

<div id="dvTable" class="justify-content-center"></div>
    

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script src="funciones_tradicional.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>

<?php
include "../../footer.html";
?>