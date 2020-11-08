<?php


//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
include "../../../databaseConection.php";

//-----------------------------------------------------------------------------------------------------------------------------

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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 13")->fetch_assoc(); // <-- Cambia
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Usuarios<i class="fa fa-user ml-2"></i></h1>
        <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuario agregado exitosamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El documento o legajo ingresado ya se encuentra registrado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 5:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuarios agregados exitosamente a la base de datos.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 6:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en el formato del archivo. Por favor genere uno nuevo.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 7:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Reincorporación exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 8:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la reincorporación.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
        }
    
    }

    ?>
    
    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user-plus mr-1"></i>Crear nuevo</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-upload mr-1"></i>Importar lista</button>
    </div>

    <?php
        include "../../../databaseConection.php";
        $cantidadActivos = $con->query("SELECT id FROM usuario WHERE usuario.legajoUsuario IS NOT NULL AND fechaBajaUsuario IS NULL")->num_rows;
        $cantidadInactivos = $con->query("SELECT id FROM usuario WHERE usuario.legajoUsuario IS NOT NULL AND fechaBajaUsuario IS NOT NULL")->num_rows;
    ?>

    <div class="mb-2">
        <label><?php echo "Activos: ".$cantidadActivos." Inactivos: ".$cantidadInactivos ?></label>
    </div>

    <div class="mb-4 table-responsive">

        <table id="dataTable" class="table table-secondary table-bordered table-hover">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre </th>
                <th>DNI</th>
                <th></th>
            </thead>

            <tbody>
                <?php

                $consulta1 = $con->query("SELECT `legajoUsuario`,`apellidoUsuario`,`nombreUsuario`,`dniUsuario`,`id`,`fechaBajaUsuario` FROM `usuario` WHERE usuario.legajoUsuario IS NOT NULL ORDER BY legajoUsuario ASC");

                while ($resultado1 = $consulta1->fetch_assoc()) {
                    
                    if($resultado1['fechaBajaUsuario'] != NULL || $resultado1['fechaBajaUsuario'] != ""){
                            $urlReinc = 'reincUsuario.php?id='.$resultado1["id"];
                            echo "<tr class='table-danger'>
                                <td>" . $resultado1['legajoUsuario'] . "</td>
                                <td>" . $resultado1['apellidoUsuario'] . "</td>
                                <td>" . $resultado1['nombreUsuario'] . "</td>
                                <td>" . $resultado1['dniUsuario'] . "</td> 
                                <td class='text-center'><a class='btn btn-primary' onclick='return confirmComeBack()' href='$urlReinc'><i class='fa fa-undo mr-1'></i>Alta</a></td>
                            </tr>";
                        }else{
                            $urlBaja = 'bajaUsuario.php?id='.$resultado1["id"];
                           echo "<tr>
                                <td>" . $resultado1['legajoUsuario'] . "</td>
                                <td>" . $resultado1['apellidoUsuario'] . "</td>
                                <td>" . $resultado1['nombreUsuario'] . "</td>
                                <td>" . $resultado1['dniUsuario'] . "</td> 
                                <td class='text-center'><a class='btn btn-danger' onclick='return confirmDelete()' href='$urlBaja'><i class='fa fa-trash mr-1'></i>Baja</a></td>
                            </tr>"; 
                        }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../administrador.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../../paginadoDataTable.js"></script>

<!-- Modal ingresar un usuario -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        
        <div class="modal-content " >
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo usuario</h5>
            </div>
            <form method="POST" id="insertusuario" name="insertusuario" action="insertUsuario.php" enctype="multipart/form-data" role="form" onsubmit="return validarDNIyLegajo()">
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
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se puede ingresar un nuevo usuario.</h5>
            </div>";
        } 

        ?>

                
                <div class="modal-body" <?php if($dni == null){echo "hidden ";} ?>>
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
                    <div class="my-2" <?php if($dni){echo "hidden ";} ?>>
                        <label for="inputLegajo">Legajo</label>
                        <input type="text" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110"  placeholder="Legajo" <?php if($dni == false){echo " required ";} ?>>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear" <?php if($dni == null){echo "style='display:none' ";} ?>>Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<!-- Modal importar nomina completa de usuarios -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Importar lista</h3>
            </div>
            
            <?php
                include "../../../databaseConection.php";
                $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                $rtdo = false;
                $dni = null;

                if (!($consultaParamLeg->num_rows) == 0) {
                    $formatoLegajo = $consultaParamLeg->fetch_assoc();
                    $rtdo = true;
                    $dni = $formatoLegajo["esDNI"];
                }else{
                    echo "<div class='alert alert-warning' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se pueden ingresar nuevos usuarios.</h5>
                    </div>";
                } 

        ?>
             <form method="POST" id="importPlanilla" name="importPlanilla" action="importMasivousuarioS.php" enctype="multipart/form-data" role="form">
            
            <div class="modal-body" <?php 
                                    if($dni == null){ 
                                        echo "hidden ";} ?>>

               
                
                <div>
                    <h9>La extension para la lista debe ser .xlsx y los campos deben estar ordenados como se muestra a continuación: </h9>

                    <table class="table table-bordered text-center table-info">
                        <?php
                        
                            if($dni){
                                echo "<thead>
                                        <th>DNI</th>
                                        <th>Apellido</th>
                                        <th>Nombre </th>
                                    </thead>";
                            }else{
                                echo "<thead>
                                        <th>DNI</th>
                                        <th>Legajo</th>
                                        <th>Apellido</th>
                                        <th>Nombre </th>
                                    </thead>";
                            }
                        
                        ?>
                    </table>

                </div>

                
                    <div class="container" style="margin-top:50px;">

                        <div class="custom-file">
                            <input type="file" class="form-control-file" name="inpGetFile" id="inpGetFile" accept=".xlsx" onchange="comprobarLista()" lang="es" required>

                        </div>
                    </div>
                
                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled <?php if($dni == null){echo "style='display:none' ";} ?>>Importar</button>
                    </div>

                </form>
            

        </div>
    </div>
</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['usuario']['nombreUsuario']." ".$_SESSION['usuario']['apellidoUsuario']."'" ?>
</script>

<?php
include "../../../footer.html";
?>