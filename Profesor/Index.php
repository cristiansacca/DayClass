<?php
include "../header.html";
?>


<link rel="stylesheet" href="../styleCards.css">



<div class="container">

    <div class="jumbotron my-4">
        <h3 class="">ApellidoUsuario, NombreUsuario</h3>
        <p class="lead"></p>
        <a href="editar_perfil.php" class="btn btn-primary btn-lg">Ver Perfil</a>
    </div>

    <!-- Page Features -->
    <div class="row text-center">

        
    <?php
        $contador = 0;
        for ($i = 0; $i < 5; $i++) {
            if($contador == 4){
                $contador = 0;
            }
            
            
            $aux = $i+1;
            echo "<div class='col-lg-6 col-md-3 mb-4' >
            <div class='card h-100 color$contador' id='tajeta$i' >
                <div class='card-body'>
                    <h4 class='card-title'>Materia $aux</h4>
                    <h5 class='card-title'>Curso 1</h5>
                </div>

                <div class='card-footer'>
                    <a href='indexCurso.php' class='btn btn-primary btn-lg'>Ingresar</a>
                </div>
            </div>
        </div>";
            
            $contador ++;
       
        }
        
    ?>
       
    </div>

</div>

        


<script src="profesor.js"></script>

<?php
include "../footer.html";
?>