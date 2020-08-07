<?php
include "../databaseConection.php";

if(isset($_POST['dia'])) {
    $dias = $_POST['dia'];
    
    foreach ($dias as $diaCursado){
        
        
        
        echo $diaCursado;
    }

} 




    

    else {

    echo "You did not choose a color.";

    }







?>