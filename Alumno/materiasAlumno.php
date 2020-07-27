<?php
include "../header.html";
?>
<script src="administrador.js"></script>
<link rel="stylesheet" href="../styleCards.css">



<div class="container ">
    <div class="my-5">
        <h3 class="">Materias en las que esta inscipto</h3>
        <p class="lead"></p>
    </div>
    <!-- Page Features -->
    <div class="row text-center my-5">

       <?php
        $contador = 0;
        for ($i = 0; $i < 7; $i++) {
            if($contador == 4){
                $contador = 0;
            }
            
            $nombre_div = "3k9";
            $aux = $i+1;
            
            
            echo "<div class='col-lg-6 col-md-12 mb-4' >
            <div class='card h-100 color$contador' id='tajeta$i'>
                <div class='card-body text-left'>
                    <h3 class='card-title'>Materia $aux</h3>
                    <h5 class='card-title'>Division $nombre_div</h5>
                    <h6  class='mx-5'>Profesores</h6>
                    <ul class='mx-5' style='list-style: none;'>
                       <li> Teoria: </li>
                       <li> Practica:</li>
                    </ul>
                </div>

                <div class='card-footer'>
                <a href='#' class='btn btn-dark m-2'>Ver Curso</a>
                    <a href='#' class='btn btn-dark m-2'>Novedades</a>
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