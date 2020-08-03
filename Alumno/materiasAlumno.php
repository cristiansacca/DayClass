<?php
include "../header.html";

//Se inicia o restaura la sesión
session_start();
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['alumno'])) 
{
   //Nos envía a la página de inicio
   header("location:/DayClass/index.php"); 
}

?>

<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="py-4 my-3 jumbotron bg-light">
        <h2>Materias en las que está inscipto</h2>
        <a class="btn btn-info" href="/DayClass/Alumno/index.php"><i class="fa fa-arrow-circle-left mr-2"></i>Atras</a>
    </div>
    <!-- Page Features -->
    <div class="row text-center my-5">

       <?php
        include "../databaseConection.php";

        //Busca todas las instanias de AlumnoCursoActual que están asociadas al alumno que ingresó
        $consulta1 = $con->query("SELECT * FROM alumnocursoactual WHERE alumno_id = '".$_SESSION['alumno']['id']."'");
        $contador = 0;
        
        while ($alumnocursoactual = $consulta1->fetch_assoc()) {
            if($contador == 4){
                $contador = 0;
            }
            //Por cada instancia de AlumnoCursoActual se obtiene el curso asociado
            $consulta2 = $con->query("SELECT * FROM curso WHERE id = '".$alumnocursoactual['curso_id']."'");
            $curso = $consulta2->fetch_assoc();

            //Se buscan todos los CargoProfesor de ese curso
            $consulta3 = $con->query("SELECT * FROM cargoprofesor WHERE curso_id ='".$curso['id']."'");
            
            echo "<div class='col-lg-6 col-md-12 mb-4' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <h3 class='card-title'>".$curso["nombreCurso"]."</h3>
                        <h6  class='mx-3'>Profesores</h6>
                        <ul style='list-style: none;'>";
                            while($cargoprofesor = $consulta3->fetch_assoc()){
                                //Por cada CargoProfesor obtiene el cargo
                                $cargo = $con->query("SELECT * FROM cargo WHERE id ='".$cargoprofesor['cargo_id']."'")->fetch_assoc();

                                //Por cada CargoProfesor obtiene el profesor
                                $profesor = $con->query("SELECT * FROM profesor WHERE id ='".$cargoprofesor['profesor_id']."'")->fetch_assoc();

                                echo "<li>".$cargo['nombreCargo'].": ".$profesor['nombreProf']." ".$profesor['apellidoProf']."</li>";
                            }
            echo "      </ul>
                    </div>
                    <div class='card-footer'>
                        <a href='#' class='btn btn-primary m-2'>Ver curso</a>
                        <a href='#' class='btn btn-success m-2'>Novedades</a>
                    </div>
                </div>
            </div>" ;
            
            $contador ++;
       
        }
        
    ?> 
        
        
     
    </div>

</div>

<?php
include "modal-autoasistencia.html";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="alumno.js"></script>
<?php
include "../footer.html";
?>