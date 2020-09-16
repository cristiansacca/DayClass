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

include "../../../databaseConection.php";
?>

<script src="fcParametros.js"></script>
<script src="../../administrador.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Parámetros</h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php

    if (isset($_GET["resultado"])) {
        switch ($_GET["resultado"]) {
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Modalidad creada correctamente</h5>";
            break;
            case 2:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error al crear la modalidad</h5>";
                break;
            case 3:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Ya existe una modaliad con el mismo nombre</h5>";
                break;
            case 4:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>División creada correctamente</h5>";
                break;
            case 5:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error al crear división</h5>";
                break;
            case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Ya existe una división con el mismo nombre</h5>";
                break;
            case 7:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Parámetros de legajo cargados correctamente</h5>";
                break;
            case 8:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Tiempo máximo del código de auto-asistencia establecido exitosamente</h5>";
            break;
                case 9:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Error de carga del tiempo maximo del codigo de auto-asistencia, intente nuevamente</h5>";
            break;
                case 10:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <h5>Cargo creado correctamente</h5>";
            break;
                case 11:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <h5>Error al crear el cargo</h5>";
            break;
                case 12:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <h5>Ya existe un cargo con el mismo nombre</h5>";
            break;
                case 13:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <h5>Porcentaje de minimo de asistencias definido correctamente</h5>";
            break;
                case 14:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <h5>Error al cargar el minimo de asistencias</h5>";
            break;
        }
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    ?>

    <div>
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="institucion.php"><i class="fa fa-flag fa-lg mr-2"></i>Institución</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#formatoLegajo"><i class="fa fa-id-card-o fa-lg mr-2"></i>Formato Legajo</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#nuevaModalidad"><i class="fa fa-briefcase fa-lg mr-2"></i>Modalidades</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#nuevaDivision"><i class="fa fa-hashtag fa-lg mr-2"></i>Divisiones</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#tiempoAutoasistencia"><i class="fa fa-clock-o fa-lg mr-2"></i>Tiempo límite código de auto-asistencia</a>
            <a class="list-group-item list-group-item-action" href=""><i class="fa fa-sign-out fa-lg mr-2"></i>Vigencia de sesión</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#asistenciasMinimas" ><i class="fa fa-info-circle fa-lg mr-2"></i>Mínimo de asistencia</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#cargoDocente"><i class="fa fa-users fa-lg mr-2"></i>Cargos Docentes</a>
        </div>
    </div>
</div>

<!-- Modal nueva division -->
<div class="modal fade" id="nuevaDivision" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nueva división</h5>
            </div>
            <form action="nuevaDivision.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="nombreNombreDivision">Nombre división</label>
                        <input type="text" placeholder="División" name="nombreDivision" class="form-control" required>
                        <label for="comboModalidad">Modalidad</label>
                        <select name="comboModalidad" class="custom-select" required>
                            <option value="" selected>Seleccione...</option>
                            <?php
                                $consultaMod = $con->query("SELECT * FROM modalidad WHERE fechaBajaModalidad IS NULL");
                                while ($comboMod = $consultaMod->fetch_assoc()) {
                                    echo "<option value='".$comboMod["id"]."'>".$comboMod["nombre"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="my-2">
                        <?php
                            $consultaDiv = $con->query("SELECT division.nombreDivision, modalidad.nombre FROM division, modalidad WHERE division.modalidad_id = modalidad.id");
                            if(!($consultaDiv->num_rows)==0){
                                echo "<label>Divisiones existentes</label>";
                                echo "<table class='table table-sm bg-light table-bordered'>
                                        <thead>
                                            <th>División</th>
                                            <th>Modalidad</th>
                                        </thead>
                                        <tbody>";   
                                    while ($div = $consultaDiv->fetch_assoc()) {
                                        echo "<tr>
                                            <td>".$div["nombreDivision"]."</td>
                                            <td>".$div["nombre"]."</td>
                                        </tr>";
                                    }
                                echo "</tbody>
                                </table>";
                            } else {
                                echo "<div class='alert alert-warning'>No hay divisiones existentes</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal nueva modalidad -->
<div class="modal fade" id="nuevaModalidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nueva modalidad</h5>
            </div>
            <form action="nuevaModalidad.php" method="POST">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="nombreModalidad">Nombre modalidad</label>
                        <input type="text" placeholder="Modalidad" name="nombreModalidad" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <?php
                            $consultaMod = $con->query("SELECT * FROM modalidad WHERE fechaBajaModalidad IS NULL");
                            if(!($consultaMod->num_rows)==0){
                                echo "<label>Modalidades existentes</label>";
                                echo "<div class='list-group' >";   
                                    while ($modalidades = $consultaMod->fetch_assoc()) {
                                        echo "<a class='list-group-item list-group-item-action'>".$modalidades['nombre']."</a>";
                                    }
                                echo "</div>";
                            } else {
                                echo "<div class='alert alert-warning'>No hay modalidades existentes</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal tiempo autoasistencia -->
<div class="modal fade" id="tiempoAutoasistencia" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Tiempo limite codigo Autoasistencia</h5>
            </div>
            <form action="insertTiempoAutoAsist.php" method="POST" onsubmit="return minutosValidos()">
                
                <div class="my-6">
                
                </div>
                <div class="modal-body">
                    <?php
                    echo "<div hidden>";
                    $consultaLimite = $con->query("SELECT * FROM `tiempolimitecodigo`");
                    $limiteAnt = $consultaLimite->fetch_assoc();
                    $tiempoAnt = $limiteAnt["minutosLimite"];
                    echo "</div>";        

                    if($tiempoAnt == null){
                        echo "<div class='alert alert-warning' role='alert'>
                                <h5>No se ha definido un tiempo para los codigos de autoasistencia, habilite uno para que se pueda usar esta funcionalidad</h5>
                            </div>";        
                    }
                    echo "<input type='number' id='minutosCodigoAnt' value='$tiempoAnt' hidden>";
                     ?>
                    
                    <div class="my-2">
                        <label for="minutosCodigo">Tiempo maximo vigencia codigo Autoasistencia</label>
                            <input type="number" placeholder="Minutos" name="minutosCodigo" id="minutosCodigo" class="form-control col-md-6" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" step="5" onchange="minutosValidos()" required>
                        <h9 class="msg" id="msjValidacionCodigo"></h9>
                    </div>
                    <div class="my-2">
                        <?php
                            if($tiempoAnt != null){
                                echo "<h6>La duración anterior era de : $tiempoAnt minutos</h6>"; 
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal formato legajo -->
<div class="modal fade" id="formatoLegajo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Formato de Legajo</h5>
            </div>
            <form action="registrarFormatoLegajo.php" method="POST" onsubmit="return enviar()">
                <div class="modal-body">
                    
                    <div class="my-2">
                    <?php
                            $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                            $rtdo = false;
                    
                            if(!($consultaParamLeg->num_rows)==0){
                                
                                echo "<div class='alert alert-success' role='alert'>
                                        <h5>Ya se ha ingresado un formato de Legajo</h5>
                                    </div>";
                                $rtdo =true;
                            
                            $formatoLegajo = $consultaParamLeg->fetch_assoc();
                            $dni = $formatoLegajo["esDNI"];
                                
                                if($dni){
                                  echo "<h6>Se utiliza el número de DNI como legajo</h6>";  
                                }else{
                                    echo "<h6>Se utiliza un formato Personalizado como legajo, formado por: </h6>
                                    <ol>";
                                    
                                    $letras = $formatoLegajo["tieneLetras"];
                                    $numeros = $formatoLegajo["tieneNumeros"];
                                    
                                    if($letras){
                                        $cantLetras = $formatoLegajo["cantLetras"];
                                        echo "<li>$cantLetras letras mayusculas</li>";
                                    }
                                    if($numeros){
                                        $cantNumeros = $formatoLegajo["cantNumeros"];
                                        echo "<li>$cantNumeros números</li>";
                                    }
                                    
                                    
                                    echo "</ol>";
                                }
                                   
                            } 
                        ?>
                    </div>
                    
                    <div class="my-2" <?php 
                         if($rtdo){
                             echo " hidden";
                         }
                         
                         ?> >
                        
                        <h6>Seleccione el formato de legajo de su institucion</h6>
                            
                                <div class="radio">
                                    <label><input type="radio" name="optradio" checked onclick='hide()'> Documento Nacional de Identidad</label>
                                </div>

                                <div class="radio">
                                    <label><input type="radio" id="personalizado" name="optradio" onclick='unHide()'> Personalizado</label>
                                </div>
                                
                        
                        <div name="options" id="options" style="display:none">
                            <table id="dataTable" class="table">
                                <tbody>                                       
                                    <tr>
                                        <td> <input class='opciones' id="letras" type='checkbox' onclick='habilitarCant(this.id)'><label class='ml-2' name='dia[]'>Letras Mayusculas</label></td>
                                        <td><input class="form-control col-md-12" type='number' id="letrasC" disabled placeholder="Cantidad" min="1" max="5"></td>

                                    </tr>
                                    <tr>
                                        <td> <input class='opciones' id="numeros" type='checkbox' onclick='habilitarCant(this.id)'><label class='ml-2' name='dia[]'>Numeros</label></td>
                                        <td><input class="form-control col-md-12" type='number' id="numerosC" disabled placeholder="Cantidad" min="1" max="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
                        
                    </div>
                    
                    
                    
                    <div class="my-2">
                        <h9 class="msg" id="msjFormatoLegajo"></h9>
                    </div>
                    <input type="text" id="arregloTipos" name="arregloTipos" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary" <?php 
                         if($rtdo){
                             echo " style='display:none'";
                         }?> >Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal cargos docentes -->
<div class="modal fade" id="cargoDocente" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo cargo docente</h5>
            </div>
            <form action="nuevoCargoDocente.php" method="POST" onsubmit="capitalize(inputNombreCargo)">
                <div class="modal-body">
                    <div class="my-2">
                        <label for="nombreNombreDivision">Nombre cargo</label>
                        <input type="text" placeholder="Cargo" name="inputNombreCargo" id="inputNombreCargo" class="form-control" onchange="capitalize(this.id)" required>
                    </div>
                    <div class="my-2">
                        <?php
                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                            $currentDate = date('Y-m-d');
                            $consultaCargos = $con->query("SELECT * FROM `cargo` WHERE `fechaAltaCargo` <= '$currentDate' AND `fechaFinCargo` IS NULL");
                            if(!($consultaCargos->num_rows)==0){
                                echo "<label>Cargos existentes</label>";
                                echo "<table class='table table-sm bg-light table-bordered'>
                                        <thead>
                                            <th>Cargos</th>
                                        </thead>
                                        <tbody>";   
                                    while ($cargo = $consultaCargos->fetch_assoc()) {
                                        
                                        echo "<tr>
                                            <td>".$cargo["nombreCargo"]."</td>
                                        </tr>";
                                    }
                                echo "</tbody>
                                </table>";
                            } else {
                                echo "<div class='alert alert-warning'>No hay cargos existentes</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal porcentaje de asistencia -->
<div class="modal fade" id="asistenciasMinimas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Porcentaje mínimo de asistencia requerida</h5>
            </div>
            <form action="insertMinAsistencia.php" method="POST" onsubmit="return porcentajeValido()">
                
                <div class="my-6">
                
                </div>
                <div class="modal-body">
                    <?php
                    echo "<div hidden>";
                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $currentDate = date('Y-m-d');
                    $consultaPorcentajeVigente = $con->query("SELECT * FROM `paramminimoasistencia` WHERE `fechaAltaMinimoAsistencia` <= '$currentDate' AND `fechaBajaMinimoAsistencia` IS NULL");
                    
                    
                    $porcentajeVigente = $consultaPorcentajeVigente->fetch_assoc();
                    $porcentajeMinimoVigente = ($porcentajeVigente["porcentajeAsistencia"])*100;
                    
                    
                    echo "</div>"; 
                    
                    

                    if($porcentajeMinimoVigente == 0){
                        echo "<div class='alert alert-warning' role='alert'>
                                <h6>Todavia no se ha definido el porcentaje mínimo de asistencia requerido por la institución</h6>
                            </div>";        
                    }
                    echo "<input type='number' id='porctajeMinAnt' value='$porcentajeMinimoVigente' hidden>";
                     ?>
                    
                    <div class="my-2">
                        <label for="minimoAsistencia">Mínimo de asistencia requerido para no quedar libre</label>
                        
                        <div class="form-inline">
                            <input type="number"  name="minAsistencia" id="minAsistencia" class="form-control col-md-6" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" max="100" min="0" step="5" onchange="porcentajeValido()" required>
                            <h3 for="minutosCodigo">. %</h3>
                        </div>
                        
                        <h9 class="msg" id="msjValidacionMinAsistencia"></h9>
                    </div>
                    <div class="my-2">
                        <?php
                            if($porcentajeMinimoVigente != 0){
                                echo "<h6>El porcentaje vigente es del $porcentajeMinimoVigente%</h6>"; 
                            } 
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>

<?php
include "../../../footer.html";
?>