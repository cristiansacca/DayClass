<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Profesores</h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Usuario agregado exitosamente</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El documento o Legajo ingresado ya se encuentra registrado</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                 case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Baja exitosa</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en la baja</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 5:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Profesores agregados exitosamente a la Base de datos</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 6:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error en el formato del archivo, genere uno nuevo</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    }

    ?>

    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user-plus mr-2"></i>Crear nuevo</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-download mr-2"></i>Importar lista</button>
    </div>

    <div class="my-4">
        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre </th>
                <th>DNI</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                
                include "../../../databaseConection.php";

                $consulta1 = $con->query("SELECT `apellidoProf`,`nombreProf`,`legajoProf`,`dniProf`, `id` FROM `profesor` WHERE `fechaBajaProf` IS NULL ORDER by apellidoProf ASC");
                
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    
                    $url = 'bajaProf.php?id='.$resultado1["id"];
                    $id = $resultado1["id"];
                        echo "<tr>
                    <td>" . $resultado1['legajoProf'] . "</td>
                    <td>" . $resultado1['apellidoProf'] . "</td>
                    <td>" . $resultado1['nombreProf'] . "</td>
                    <td>" . $resultado1['dniProf'] . "</td>
                    <td class='text-center'><a class='btn btn-danger btn-sm' data-emp-id=".$id." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash'></i></a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="../../administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="/Administrador/paginadoDataTable.js"></script>

<!-- Modal crear un Docente -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo profesor</h5>
            </div>
            <form method="POST" id="insertProfesor" name="insertProfesor" action="insertProf.php" enctype="multipart/form-data" role="form" onsubmit="return validarDNIyLegajo()">
                <?php
        include "../../../databaseConection.php";
        $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
        $rtdo = false;
        $dni = null;

        if (!($consultaParamLeg->num_rows) == 0) {
            $formatoLegajo = $consultaParamLeg->fetch_assoc();
            $rtdo = true;
            $dni = $formatoLegajo["esDNI"];

            echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
            if ($dni) {
            }else {

                $letras = $formatoLegajo["tieneLetras"];
                $numeros = $formatoLegajo["tieneNumeros"];

                $cantTotal = $formatoLegajo["cantTotalCaracteres"];
                echo "<input type='text' id='cantTotal' name='cantTotal' value='$cantTotal' hidden>";

                echo "<input type='text' id='letras' name='letras' value='$letras' hidden>";
                echo "<input type='text' id='numeros' name='numeros' value='$numeros' hidden>";


                if ($letras) {
                    $cantLetras = $formatoLegajo["cantLetras"];

                    echo "<input type='text' id='cantLetras' name='cantLetras' value='$cantLetras' hidden>";
                }
                if ($numeros) {
                    $cantNumeros = $formatoLegajo["cantNumeros"];

                    echo "<input type='text' id='cantNumeros' name='cantNumeros' value='$cantNumeros' hidden>";
                }
            }
        }else{
            echo "<div class='alert alert-warning' role='alert'>
                <h5>No se ha definido un formato de Legajo, no se podra ingresar un nuevo Profesor</h5>
            </div>";
        } 

        ?>

                <div class="modal-body" <?php 
                                    if($dni == null){ 
                                        echo "hidden ";} ?>>
                    <div class="my-2">
                        <label for="inputName">Nombre</label>
                        <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Nombre" onchange="validarNombre()" required>
                        <h9 class="msg" id="msjValidacionNombre"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputSurname">Apellido</label>
                        <input type="text" name="inputSurname" id="inputSurname" class="form-control" placeholder="Apellido" onchange="validarApellido()" required>
                        <h9 class="msg" id="msjValidacionApellido"></h9>
                    </div>
                    <div class="my-2" <?php 
                                    if($dni){ 
                                        echo "hidden ";} ?>>
                        <label for="inputLegajo">Legajo</label>
                        <input type="number" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo">
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" disabled>Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>               

<!-- Modal importar nomina completa de docentes -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Importar lista</h3>
            </div>
            <div class="modal-body">
                
                 <div>
                    <h9>La extension para la lista debe ser .xlsx y los campos deben estar ordenados como sigue: </h9>

                    <table class="table table-bordered text-center table-info">
                        <thead>
                            <th>DNI</th>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre </th>
                        </thead>
                    </table>

                </div>

                <form method="POST" id="importPlanilla" name="importPlanilla" action="importMasivoPROFES.php" enctype="multipart/form-data" role="form">
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="form-control-file"  name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>
                            
                        </div>
                    </div>
                    <!-- la funcion comrobar esta en administrador.js -->
                    <br>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled>Importar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../../footer.html";
?>