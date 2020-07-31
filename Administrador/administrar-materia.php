<?php
include "../header.html";
include "../databaseConection.php";
//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

$consulta1 = $con->query("SELECT `nombreMateria`,`id` FROM `materia` ORDER BY id ASC");

?>

<div class="container">
    <h1 class="display-4">Materias</h1>
    <div class="form-inline">
        <div class="form-inline my-2">
            <label for="selectEstadoMateria" style="margin-right: 8px;">Mostrar:</label>
            <select id="selectEstadoMateria" class="custom-select" style="margin-right: 8px;">
                <option value="1">Habilitadas</option>
                <option value="2">No habilitadas</option>
                <option value="3" selected>Todas</option>
            </select>
        </div>
        <div class="form-inline my-2">
            <label for="buscarMateria" style="margin-right: 8px;">Nombre: </label>
            <input type="text" id="buscarMateria" class="form-control" style="margin-right: 8px;">
            <button class="btn btn-outline-primary my-2" id="btnBuscarMateria">Buscar</button>
        </div>
    </div>
    <button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Nueva materia</button>
    <div class="my-2">
        <table class="table table-bordered text-center table-info">
            <thead>
                <th>N°</th>
                <th>Nombre materia</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Cargar programa</th>
            </thead>
            <tbody>
            <?php
                
                $aux=1 ;
                while ($resultado1 = $consulta1->fetch_assoc()) {
                    
                    echo "<tr>
                    <td>$aux</td>
                    <td><a id='storage' href='admcurso.php' onclick='guardarStorage();' >" . $resultado1['nombreMateria'] . "</a></td>
                    <td>Habilitada</td>
                    <td><button class='btn btn-primary' onClick='guardarStorage'><i class='fa fa-edit'></i></button></td>
                    <td><button class='btn btn-success'><i class='fa fa-upload'></i></button></td>
                    </tr>";
                   
                    $aux++ ;
                    $resultado= $resultado1['nombreMateria'] ;
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
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva materia</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-success" data-dismiss="modal"> Confirmar </button>
            </div>
        </div>
    </div>
</div>

<script src="administrador.js"></script>



<script>

  function guardarStorage(){
    var storage= document.getElementById("storage")

   localStorage.setItem("Materia", "<?php echo $resultado; ?>")

  }
 </script>
    


<?php
include "../footer.html";
?>