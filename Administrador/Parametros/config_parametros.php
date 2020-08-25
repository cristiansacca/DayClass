<?php
include "../../header.html";
include "../../databaseConection.php";
?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Parámetros</h1>
        <a href="../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
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
                            <h5>Error al crear la división</h5>";
                break;
            case 6:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Ya existe una división con el mismo nombre</h5>";
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
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-briefcase fa-lg mr-2"></i>Modalidades</a>
            <a class="list-group-item list-group-item-action" href="" data-toggle="modal" data-target="#staticBackdrop2"><i class="fa fa-hashtag fa-lg mr-2"></i>Divisiones</a>
            <a class="list-group-item list-group-item-action" href=""><i class="fa fa-check-circle fa-lg mr-2"></i>Tipo de asistencias</a>
            <a class="list-group-item list-group-item-action" href=""><i class="fa fa-clock-o fa-lg mr-2"></i>Tiempo límite código de auto-asistencia</a>
            <a class="list-group-item list-group-item-action" href=""><i class="fa fa-sign-out fa-lg mr-2"></i>Vigencia de sesión</a>
            <a class="list-group-item list-group-item-action" href=""><i class="fa fa-info-circle fa-lg mr-2"></i>Mínimo de asistencia y estados</a>
        </div>
    </div>
</div>

<!-- Modal nueva division -->
<div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <button type="Submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal nueva modalidad -->
<div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <button type="Submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../administrador.js"></script>

<?php
include "../../footer.html";
?>