<?php
include "../header.html";
?>
<script src="administrador.js"></script>


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
        
        <?php
            include "../databaseConection.php";
            $id_curso = $_GET['id'];
            
            $consultaCurso = $con->query("SELECT * FROM `curso` WHERE `id` =  $id_curso");
            $resultado = $consultaCurso->fetch_assoc();
            $fchDesde = $resultado["fechaDesdeCursado"];
            $fchHasta = $resultado["fechaHastaCursado"];
            $nombreCurso = $resultado["nombreCurso"];
        
            echo "<h1>$nombreCurso</h1>";
            
            echo "<h6>Inicio del curso: ".strftime('%d/%m/%Y', strtotime($fchDesde))."</h6>";
            echo "<h6>Finalización de curso: ".strftime('%d/%m/%Y', strtotime($fchHasta))."</h6>";
        
        ?>
        <a href="index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    
    <div class="my-3">
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-square mr-1"></i>Agregar Docente</a>
    </div>
   
        

    <div class="my-4">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>Legajo</th>
                <th>Nombre </th>
                <th>Cargo</th>
                <th>Estado</th>
                <th>Ingresar Licencia</th>
            </thead>
            <tbody>
                <?php
                include "../databaseConection.php";
                
                $id_curso = $_GET['id'];
            date_default_timezone_set('America/Argentina/Mendoza');
                $currentDateTime = date('Y-m-d H:i:s');
                
                 
                
                $consulta2 = $con->query("SELECT alumno_id FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` < '$currentDateTime' AND `fechaHastaAlumCurAc` > '$currentDateTime' AND `curso_id` =  $id_curso");
                
                //echo "SELECT alumno_id FROM `alumnocursoactual` WHERE `fechaDesdeAlumCurAc` < '$currentDateTime' AND `fechaHastaAlumCurAc` > '$currentDateTime' AND `curso_id` =  $id_curso";

                while($alumnocursoactual = $consulta2->fetch_assoc()){
                    $alumno = $con->query("SELECT * FROM alumno WHERE id = '".$alumnocursoactual['alumno_id']."'")->fetch_assoc();
                    
                    //$url = 'bajaAlum.php?id='.$resultado1["id"];
                   // $id = $resultado1["id"];
                    
                    echo "<tr>
                        <td>".$alumno['legajoAlumno']."</td>
                        <td>".$alumno['apellidoAlum']."</td>
                        <td>".$alumno['nombreAlum']."</td>
                        <td>".$alumno['dniAlum']."</td>
                        <td class='text-center'><a class='btn btn-danger btn-sm' data-emp-id= onclick='return confirmDelete()' href=''><i class='fa fa-trash'></i></a></td>
                    </tr>";
                }
            
                ?>
                
                </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Agregar docente</h5>
            </div>
            <form method="POST" id="insertAlumno" name="insertAlumno" action="inscribir_UnAlumno.php" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    
                    <div class="my-2">
                        <h5 class="msg" id="msjValidacionApellido">Ingrese el DNI o Legajo del alumno que desea inscribir</h5>
                    </div>
                    <div class="form-inline my-2">
                        <label for="selectcargo">Cargo   </label>
                        <select id="selectcargo" class="custom-select mx-2" style="width:200px">
                            <?php
                                  include "../databaseConection.php";
                                

                                  $consultaD = $con->query("SELECT * FROM `cargo`");
                        
                                //"SELECT * FROM `division`"

                                  while ($cargo = $consultaD->fetch_assoc()) {
                                      

                                      echo "<option value='".$cargo['id']."'>".$cargo['nombreCargo']."</option>";

                                  }
                            ?>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="inputLegajo">Legajo</label>
                        <input type="number" name="inputLegajo" id="inputLegajo" class="form-control" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Legajo" required>
                        <h9 class="msg" id="msjValidacionLegajo"></h9>
                    </div>
                    <div class="my-2">
                        <label for="inputDNI">DNI</label>
                        <input type="text" name="inputDNI" id="inputDNI" class="form-control" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" placeholder="Documento Nacional de Identidad" required>
                        <h9 class="msg" id="msjValidacionDNI"></h9>
                    </div>
                    
                    
                    
                    <input type="text" name="cursoId" id="cursoId" <?php echo"value= '".$id_curso."'"; ?> hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Crear</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="administrador.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="paginadoDataTable.js"></script>


    <?php
include "../footer.html";
?>