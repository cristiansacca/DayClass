<?php
include "../header.html";

?>
<script src="administrador.js"></script>

<link rel="stylesheet" href="../styleCards.css">

<div class="container ">
    <div class="my-5">
      <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#staticBackdrop">Nuevo Curso </a>
    </div>
   

    <div class="my-4">

        <table id="dataTable" class="table table-info table-bordered table-hover table-sm">
            <thead>
                <th>Nombre</th>
                <th>Division</th>
                <th>Modalidad</th>
                <th></th>
            </thead>

            <tbody>
                <?php
                include "../databaseConection.php";
                
               
                
                $id_materia = $_GET["id"];
                $consulta1 = $con->query("SELECT * FROM curso WHERE materia_id = '$id_materia'");
                

                while ($resultadoCurso = $consulta1->fetch_assoc()) {
                    
                $division = $resultadoCurso['division_id'];
               // echo "<script>alert('$division')</script>";
                
                $consulta2 =  $con->query("SELECT * FROM division WHERE id = '$division'");
                $resultado2 = $consulta2->fetch_assoc();
                
                $modalidad = $resultado2['modalidad_id'];
                 //echo "<script>alert('$modalidad')</script>";
                $consulta3 = $con->query("SELECT * FROM modalidad WHERE id = '$modalidad'");
                $resultado3 = $consulta3->fetch_assoc();
                
                 //echo "<script>alert('entra a la fc php $id_materia')</script>";
                    
                    $url = 'bajaAlum.php?id=';
                    $id = $resultadoCurso["id"];
                    //echo "$url";
                    
                    echo "<tr>
                    <td>" . $resultadoCurso['nombreCurso'] . "</td>
                    <td>" . $resultado2['nombreDivision'] . "</td>
                    <td>" . $resultado3['nombre'] . "</td>
                    <td class='text-center'><a class='btn btn-danger btn-sm' data-emp-id=".$id." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash'></i></a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel"> Añadir Curso</h5>
            </div>
            <form>
            <div class="modal-body">
                <div class="my-2">
                    
                    <label for="divisiones"> Divisiones </label>
                    <select name="divisiones" id="divisiones" class="custom-select">
                       
                            <?php
                                  include "../databaseConection.php";

                                  $consultaD = $con->query("SELECT * FROM `division`");
                                

                                  while ($divisiones = $consultaD->fetch_assoc()) {
                                      

                                      echo "<option value='".$divisiones['id']."'>".$divisiones['nombreDivision']."</option>";

                                  }
                            ?>

                    </select>
                     
                </div>
            <div class="form-group">
                
                
        <table id="dataTable" class="table">
            <thead>
                <th>Dia</th>
                <th>Hora desde</th>
                <th>Hora hasta</th>
                
            </thead>

            <tbody>
                <?php
                        include "../databaseConection.php";

                        $consulta = $con->query("SELECT * FROM `cursoDia`");

                        while ($dias = $consulta->fetch_assoc()){
                                          
                            echo "<tr>
                            <td> <input class='checkDia' type='checkbox' id='".$dias['nombreDia']."' onclick='habilitarTimeP(this.id)'><label class='ml-2' name='dia[]'>".$dias['nombreDia']."</label></td>
                            <td><input type='time'  id='".$dias['nombreDia']."1' onchange='habilitar2do(this.id)' disabled></td>
                            <td><input type='time' id='".$dias['nombreDia']."2' onchange='validar(this.id)' disabled> </td>
                            </tr>";
                        }
                ?>
            </tbody>
        </table>
                 
            </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="Submit" class="btn btn-primary" data-dismiss="modal"> Crear </button>
            </div>
             </form>   
        </div>
    </div>
</div>

<script src="validarDiasCurso.js"></script>

<?php
include "../footer.html";
?>