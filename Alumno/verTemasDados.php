<?php
//Se inicia o restaura la sesión
session_start();

include "../header.html";
include "../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Si la variable id_curso no está definida se vuelve al index

    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        
        <h1><?php echo " " . $curso["nombreCurso"] ?></h1>
        
        <h3 class='font-weight-normal'>Tema dados anteriormente</h3>
        <a class="btn btn-info" <?php echo "href='/DayClass/Alumno/cursoInfo.php?id_curso=$id_curso'"; ?>><i class="fa fa-arrow-circle-left mr-2"></i>Volver</a>
         
    </div>

    
    <div>
        <table class="table text-center table-striped table-light" id="dataTable">
            <?php
            
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDate = date('Y-m-d H:i:s');
                $consulta1 = $con->query("SELECT temadia.profesor_id, temadia.fechaTemaDia, temadia.comentarioTema, temasmateria.nombreTema FROM `temadia`, temasmateria, curso WHERE temadia.curso_id = '$id_curso' AND curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado >= '$currentDate' AND temadia.curso_id = curso.id AND temadia.temasMateria_id = temasmateria.id AND temadia.fechaTemaDia >= curso.fechaDesdeCursado AND temadia.fechaTemaDia <= curso.fechaHastaCursado ORDER BY temadia.fechaTemaDia DESC");
                                
                    if(($consulta1->num_rows) == 0){
                        echo "<div class='alert alert-warning' role='alert'>
                                <h5><i class='fa fa-exclamation-circle mr-2'></i>Todavía no se han cargado temas en este curso.</h5>
                                </div>";
                        }else{
                            echo "<thead>
                                    <th>Fecha</th>
                                    <th>Tema</th>
                                    <th>Comentario</th>
                                </thead>
                                <tbody> ";
                                
                            while ($resultado1 = $consulta1->fetch_assoc()) {
                                $profTema = $resultado1['profesor_id'];
                                
                                        
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
</div>

<script src="alumno.js"></script>
<script src="paginadoDataTable.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['alumno']['nombreAlum']." ".$_SESSION['alumno']['apellidoAlum']."'" ?>
</script>

<?php
include "modal-autoasistencia.php";
include "../footer.html";
?>