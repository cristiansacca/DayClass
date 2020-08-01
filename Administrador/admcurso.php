<?php
include "../header.html";
include "../databaseConection.php";
$id_materia = $_GET["id"];
$consulta1 = $con->query("SELECT * FROM `curso` WHERE materia_id= '$id_materia'");
$resultadoCurso= $consulta1->fetch_assoc();
$division = $resultadoCurso['division_id'];
$consulta2 =  $con->query("SELECT * FROM `division` WHERE id= '$division'");
$resultado2 = $consulta2->fetch_assoc();

?>
<script src="administrador.js"></script>

<link rel="stylesheet" href="../styleCards.css">

<div class="container ">
    <div class="my-5">
      <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#staticBackdrop">Nuevo Curso </a>
    </div>
    <!-- Page Features -->
    <div class="row text-center my-5">

       <?php
        $contador = 0;
        for ($i = 0; $i < 20; $i++) {
            if($contador == 4){
                $contador = 0;
            }
            
            
            $aux = $i+1;
            
            while ($resultado1 = $consulta1->fetch_assoc()) {
            echo "<div class='col-lg-12 col-md-12 mb-4' >
            <div class='card h-100 color$contador' id='tajeta$i'>
                <div class='card-body text-left'>
                    <h3 class='card-title'>Curso " . $resultado1['nombreCurso'] . "</h3>
                    <h5 class='card-title'>Division " . $resultado2['nombreDivision'] . "</h5>
                    <h6  class='mx-5'>Profesores</h6>
                    <ul class='mx-5' style='list-style: none;'>
                       <li> Adjunto: </li>
                       <li> Titular:</li>
                    </ul>
                </div>
           
                <div class='card-footer'>
                <a href='cargarPlanillaAlumnos/import_planillaAlumnos.php' class='btn btn-dark m-2'>Importar Alumnos</a>
                    <a href='añadirProfesor.php' class='btn btn-dark m-2'>Añadir Profesores</a>
                </div>
            </div>
        </div>" ;
        $contador ++;
    }
            
       
        }
        
    ?> 
        
        
     
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
            <div class="modal-body">
                <div class="my-2">
                    <label for="nombrecurso"> Nombre Curso </label>
                    <select name="nombrecurso" id="nombrecurso"class="custom-select">
                       <option>IA</option>
                       <option>Lengua</option>
                       <option>Frances</option>
                    </select>
                    
                </div>
                <div class="my-2">
                    <label for="selectdivision"> Division </label>
                    <select id="selectdivision" name="selectdivision" class="custom-select">
                       <option>3k9</option>
                       <option>3k10</option>
                       <option>2x10</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"> Crear </button>
            </div>
        </div>
    </div>
</div>


<?php
include "../footer.html";
?>