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

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');

$consultaMateria = $con->query("SELECT * FROM materia WHERE id = '".$curso["materia_id"]."'");
$materia = $consultaMateria->fetch_assoc();
$materia_id = $materia["id"];
               
$consultaPrograma = $con->query("SELECT * FROM programamateria WHERE materia_id = '$materia_id' AND programamateria.fechaDesdePrograma <= '$currentDate' AND programamateria.fechaHastaPrograma IS NULL");
$programa = $consultaPrograma->fetch_assoc();
$programa_id = $programa["id"];


$hab =false;
if($programa_id == "" || $programa_id == null){
    $hab = true;
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
    
    <?php
        if($hab){
                echo "<div class='alert alert-warning' role='alert'>
                <h5>Aún no se ha cargado el programa de esta materia, no podra leccionar temas de clase</h5>
                </div>";
        }
    ?>

    <form action="cargarTemaDia.php" method="POST" class=" form-group" <?php if($hab){echo "hidden";}  ?>>
        <h5>Indique el tema del día</h5>
        <input type="text" name="id_curso" <?php echo "value='$id_curso'" ?> hidden >
        <div class="my-2  form-inline">
            <select id="unidadTema" name="unidadTema" class="custom-select" class="custom-select" style="width:15%" required>
                <option value="" selected>Seleccione</option>
                <?php
                
                $consultaTemas = $con->query("SELECT DISTINCT temasmateria.unidadTema FROM temasmateria WHERE programaMateria_id = '$programa_id' ORDER BY temasmateria.unidadTema");

                while($temas = $consultaTemas->fetch_assoc()){
                    echo "<option value='".$temas["unidadTema"]."'>".$temas["unidadTema"]."</option>";
                }

                ?>
            </select>
            
            <select id="nombreTema" name="nombreTema" class="custom-select" style="width:85%" required disabled>
                <option value="" selected>Seleccione</option>
                
            </select>
            
            <input type="text" name="idPrograma" id="idPrograma" <?php echo "value='$programa_id'" ?> hidden >
            
        </div>
        <div class="my-2">
            <textarea name="comentario" cols="60" rows="5" style="resize: none;" class="form-control form-inline"
                placeholder="Escriba un comentario (Opcional)"></textarea>
        </div>
        <button class="btn btn-primary my-2" type="submit">Aceptar</button>
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
                                    echo "<h9>Temas dados anteriormente</h9>";
                                   echo "<thead>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Comentario</th>
                                        </thead>
                                       <tbody> ";
                                

                                    while ($resultado1 = $consulta1->fetch_assoc()) {
                                        
                                        
                                        $date=date_create($resultado1['fechaTemaDia']);
                                        $fecha = date_format($date,"d/m/Y");

                                        echo "<tr>
                                        <td>" . $fecha . "</td>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>

        </div>
    </div>
</div>




<script src="profesor.js"></script>
<script>
    document.getElementById("temaDia").innerHTML = <?php echo "'<a class=nav-link href=/DayClass/Profesor/tema-del-dia.php?id_curso=".$id_curso."><i id=icono ></i>Tema del día</a>';"; ?>
    $("#icono").addClass("fa fa-clipboard mr-1");
</script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['profesor']['nombreProf']." ".$_SESSION['profesor']['apellidoProf']."'" ?>
</script>
<script src="fnTemaDia.js"></script>
<?php
include "../footer.html";
?>