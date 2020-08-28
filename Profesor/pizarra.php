<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Si la variable id_curso no está definida se vuelve al index
if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

$_SESSION["profesor"] = $con->query("SELECT * FROM profesor WHERE id = '".$_SESSION['profesor']['id']."'")->fetch_assoc();

?>
<div class="container">

    <div class="jumbotron my-4 py-4">
        <h1>Pizarra de novedades</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-secondary"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <button class="btn btn-success my-2" id="AniadirPublicacion " data-toggle="modal" data-target="#staticBackdrop">
        <i class="fa fa-commenting mr-1"></i>Añadir publicación</button>

    <?php
        if(isset($_GET['resultado'])){
            if($_GET['resultado']==1){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <h5>Se publicó correctamente</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5>Ocurrió un error al publicar</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            }
        }
    ?>
    <table class="table table-info table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>Tema</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody id= "Publicaciones">
        <?php
            setlocale(LC_ALL, 'Spanish');//Formato de fechas en español strftime("%A %d %B %Y %H:%M:%S", strtotime(fecha));
            $consulta2 = $con->query("SELECT * FROM notificacionprofe WHERE curso_id = '$id_curso'");
            
            if (($consulta2->num_rows) > 0) {
                while ($resultado2 = $consulta2->fetch_assoc()) {
                    $fechaFormateada = strftime("%d de %B del %Y %H:%M", strtotime($resultado2['fechaHoraNotif']));
                    echo "<tr>
                    <td>" . $resultado2['asunto'] . "</td>
                    <td>" . $resultado2['mensaje'] . "</td>
                    <td>" . $fechaFormateada . "</td>   
                    </tr>";
                }
            } else {
                
                echo "<br><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <h5>No se han realizado publicaciones</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div> ";
            }
        ?>
        </tbody>
    </table>
    
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Publicación </h5>
            </div>
            <form method="POST" id="insertPublicacion" name="insertPublcacion" action="insertPublicacion.php">
                <div class="modal-body">
                    <input type="text" name="id_curso" <?php echo "value=$id_curso"; ?> hidden>
                    <div>
                        <label for=""> Asunto </label>
                        <input type="text" name="inputAsunto" id="inputAsunto" class="form-control" placeholder="Escribir asunto" required>
                    </div>
                    <div class="my-2">
                        <label for=""> Mensaje </label>
                        <textarea class="form-control " name="textMensaje" id="textMensaje" cols="30" rows="10" style="resize:none;"
                            placeholder="Escribir mensaje" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                    <button type="submit" class="btn btn-success"  id="btnCrear"> Confirmar </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>
<?php
include "../footer.html";
?>