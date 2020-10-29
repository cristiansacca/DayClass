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

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo']) && isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $_SESSION['limite']) {
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

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<link rel="stylesheet" href="../../styleCards.css">


<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p class="card-text">Administrador</p>
        
        
        <?php
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDate = date('Y-m-d');
            $id_permiso = $_GET["id_permiso"];

            $selectPermiso = $con->query("SELECT * FROM permiso WHERE permiso.id = '$id_permiso'");
            $permiso = $selectPermiso->fetch_assoc();

            $nombrePermiso = ucfirst(strtolower($permiso["nombrePermiso"]));


            echo "<h1>$nombrePermiso<i class='fa fa-user-tie ml-2'></i></h1>"
        
        ?>
        
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        <button type="button" class="btn btn-warning" onclick="habilitarFunciones()">Modificar Permisos</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#ingresarUnUsuario"><i class="fa fa-user-plus mr-1"></i>Agregar Usuario</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#ingresarUsuarios"><i class="fa fa-user-plus mr-1"></i>Importar Lista de Usuarios</button>
        
    </div>
    <!-- Page Features -->
    <h2>Permisos del Rol</h2>
    <div>  
        <div>
            <form class="form-inline" onsubmit="return enviarRoles()" method="POST" id="insertPermisoFuncion" name="insertPermisoFuncion" action="insertFuncionesPerfiles.php" enctype="multipart/form-data" role="form">
                <div class="py-4 my-3 jumbotron overflow-auto col-sm-6" style="background-color:PowderBlue; height: 200px">
                    <?php
                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $currentDate = date('Y-m-d');
                        $id_permiso = $_GET["id_permiso"];

                        //$selectPermisosFuncion = $con->query("SELECT funcion.nombreFuncion, funcion.id FROM permiso, permisofuncion, funcion WHERE permiso.id = '$id_permiso' AND permiso.id = permisofuncion.id_permiso AND permisofuncion.fechaDesdePermisoFuncion <= '$currentDate' AND permisofuncion.fechaHastaPermisoFuncion IS NULL AND permisofuncion.id_funcion = funcion.id AND funcion.fechaDesdeFuncion <= '$currentDate' AND funcion.fechaHastaFuncion IS NULL");

                        $selectFuncion = $con->query("SELECT funcion.nombreFuncion, funcion.id FROM funcion WHERE funcion.fechaDesdeFuncion <= '$currentDate' AND funcion.fechaHastaFuncion IS NULL ORDER BY nombreFuncion ASC");

                        $contador = 0;
                        while($funciones = $selectFuncion->fetch_assoc()){
                            $nombreFuncion = $funciones["nombreFuncion"];
                            $id_funcion = $funciones["id"];

                            $selectFuncionesDePermiso = $con->query("SELECT * FROM `permisofuncion` WHERE `id_permiso` = '$id_permiso' AND `id_funcion` = '$id_funcion' AND `fechaDesdePermisoFuncion` <= '$currentDate' AND `fechaHastaPermisoFuncion` IS NULL");

                                echo "<div class='form-inline'>";
                                if(($selectFuncionesDePermiso -> num_rows) == 1){
                                    echo "
                                    <input class='checkFuncion' type='checkbox' id='".$id_funcion."' checked disabled>
                                    <label class='ml-2'>" .  $nombreFuncion. "</label> 
                                    </div>";
                                }else{
                                    echo "
                                    <input class='checkFuncion' type='checkbox' id='".$id_funcion."' disabled>
                                    <label class='ml-2'>" .  $nombreFuncion. "</label> </div>";
                                }
                                echo "";
                        }
                    ?>
                </div>  
                    <input type="text" name="permisoId" id="permisoId" <?php echo "value= '$id_permiso'"; ?> hidden>
                    <input type="text" id="arregloFunciones" name="arregloFunciones" hidden>

                <div class="col-sm-6" style="height: 200px; display:inline-block"> 
                    <button type="submit" class="btn btn-success" id="btnGuardar" style="display: none;">Guardar Cambios</button>
                </div>   
            </form> 
        </div>  
    <div>
        <h2>Usuarios asignados al Rol</h2>
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

                    $consulta1 = $con->query("SELECT * FROM `usuario` WHERE id_permiso = '$id_permiso' ORDER BY legajoUsuario ASC");

                    while ($resultado1 = $consulta1->fetch_assoc()) {
                        if($resultado1['fechaBajaUsuario'] != NULL || $resultado1['fechaBajaUsuario'] != ""){
                                $urlReinc = 'reincAlum.php?id='.$resultado1["id"];
                                echo "<tr class='table-danger'>
                                    <td>" . $resultado1['legajoUsuario'] . "</td>
                                    <td>" . $resultado1['apellidoUsuario'] . "</td>
                                    <td>" . $resultado1['nombreUsuario'] . "</td>
                                    <td>" . $resultado1['dniUsuario'] . "</td> 
                                    <td class='text-center'><a class='btn btn-primary' onclick='return confirmComeBack()' href='$urlReinc'><i class='fa fa-undo mr-1'></i>Alta</a></td>
                                </tr>";
                            }else{
                                $urlBaja = 'bajaAlum.php?id='.$resultado1["id"];
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

    
</div>
</div>


<!-- Modal agregar de a un usuario a Rol -->
<div class="modal fade" id="ingresarUnUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Agregar un usuario a Rol</h5>
            </div>
            <form method="POST" id="insertUsuarioRol" name="insertUsuarioRol" action="insertUsuarioRol.php" enctype="multipart/form-data" role="form" onsubmit="return validarDNIyLegajoIns()">
                <?php

                $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                $rtdo = false;
                $dni = null;

                if (!($consultaParamLeg->num_rows) == 0) {
                    $formatoLegajo = $consultaParamLeg->fetch_assoc();
                    $rtdo = true;
                    $dni = $formatoLegajo["esDNI"];

                    echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
                    if ($dni) {
                    } else {

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
                } else {
                    echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se puede ingresar un nuevo alumno.</h5>
                        </div>";
                }

                ?>

                <div class="modal-body" <?php
                                        if ($dni == null) {
                                            echo "hidden ";
                                        } ?>>

                    <div class="my-2">
                        <h5 class="msg">Ingrese los datos solicitados</h5>
                    </div>
                    <div class="my-2" <?php
                                        if ($dni) {
                                            echo "hidden ";
                                        } ?>>
                        <label for="inputLegajo">Legajo</label>
                        <input type="text" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajoIns()" placeholder="Legajo" onkeydown="return event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" >
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNIIns()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>



                    <input type="text" name="permisoId" id="permisoId" <?php echo "value= '$id_permiso'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear">Aceptar</button>
                </div>
            </form>

        </div>

    </div>
</div>


<!-- Modal agregar lista completa de usuarios a rol -->
<div class="modal fade" id="ingresarUsuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title " id="staticBackdropLabel">Importar lista de usuarios</h3>
            </div>
            
            <?php
                include "../../databaseConection.php";
                $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                $rtdo = false;
                $dni = null;

                if (!($consultaParamLeg->num_rows) == 0) {
                    $formatoLegajo = $consultaParamLeg->fetch_assoc();
                    $rtdo = true;
                    $dni = $formatoLegajo["esDNI"];
                }else{
                    echo "<div class='alert alert-warning' role='alert'>
                        <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se pueden ingresar nuevos alumnos.</h5>
                    </div>";
                } 

        ?>
             <form method="POST" id="importPlanilla" name="importPlanilla" action="importMasivoALUMNOS.php" enctype="multipart/form-data" role="form">
            
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
                <input type="text" name="permisoId" id="permisoId" <?php echo "value= '$id_permiso'"; ?> hidden>
                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btnImportar" type="submit" class="btn btn-primary " disabled <?php if($dni == null){echo "style='display:none' ";} ?>>Aceptar</button>
                    </div>

                </form>
            

        </div>
    </div>
</div>


<script src="../administrador.js"></script>
<script src="perfiles.js"></script>


<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>