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
?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Tema del día</h1>
        <h4><?php echo " " . $curso["nombreCurso"] ?></h4>
        <a <?php echo "href='/DayClass/Profesor/indexCurso.php?id_curso=$id_curso'"; ?> class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
         <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-bookmark mr-2"></i>Temas Dados</button>
    </div>

    <?php
        if(isset($_GET['resultado'])){
            if($_GET['resultado'] == 1){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <h5>El tema se cargó correctamente</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            } elseif($_GET['resultado'] == 0) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <h5>Ocurrió un error al cargar el tema</h5>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button></div>";
            }
        }
    ?>

    <form action="cargarTemaDia.php" method="POST" class=" form-group">
        <h5>Indique el tema del día</h5>
        <input type="text" name="id_curso" <?php echo "value=$id_curso" ?> hidden >
        <div class="my-2">
            <select id="temas" name="tema" class="custom-select" required>
                <option value="" selected>Seleccione</option>
                <?php
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $currentDateTime = date('Y-m-d');

                $materia = $con->query("SELECT * FROM materia WHERE id = '".$curso["materia_id"]."'")->fetch_assoc();
                $programa = $con->query("SELECT * FROM programamateria WHERE materia_id = '".$materia["id"]."'")->fetch_assoc();
                $consultaTemas = $con->query("SELECT * FROM temasmateria WHERE programaMateria_id = '".$programa["id"]."' AND (fechaHastaTemMat < '$currentDateTime' OR fechaHastaTemMat IS NULL)");

                while($temas = $consultaTemas->fetch_assoc()){
                    echo "<option value='".$temas["id"]."'>".$temas["nombreTema"]."</option>";
                }

                ?>
            </select>
        </div>
        <div class="my-2">
            <textarea name="comentario" cols="60" rows="5" style="resize: none;" class="form-control form-inline"
                placeholder="Escriba un comentario (Opcional)"></textarea>
        </div>
        <button class="btn btn-success my-2" type="submit">Aceptar</button>
    </form>

</div>


<!-- Modal ver temas dados -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Temas dados</h3>
            </div>
            <div class="modal-body">

                <div>
                    <h9>Temas dados anteriormente</h9>

                    <table class="table text-center table-striped">
                        
                        
                        
                            <?php
                                include "../databaseConection.php";
                                $id_curso = $_GET["id_curso"];

                                $consulta1 = $con->query("SELECT temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia ASC");
                            
                            
                                if(($consulta1->num_rows) == 0){
                                    echo "<div class='alert alert-warning' role='alert'>
                                            <h5>Todavia no se han cargado temas en este curso</h5>
                                        </div>";
                                }else{
                                   echo "<thead>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Comentario</th>
                                        </thead>
                                       <tbody> ";
                                

                                    while ($resultado1 = $consulta1->fetch_assoc()) {

                                        echo "<tr>
                                        <td>" . $resultado1['fechaTemaDia'] . "</td>
                                        <td>" . $resultado1['nombreTema'] . "</td>
                                        <td>" . $resultado1['comentarioTema'] . "</td>
                                        </tr>";
                                    }
                                    
                                    echo " </tbody>";
                                }
                            ?>
                        
                       
                    </table>

                </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    var tema = document.getElementById("temas").value;
    document.getElementById("unidadpopup").innerHTML
</script>

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