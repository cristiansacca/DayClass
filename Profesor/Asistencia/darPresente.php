<?php
include "../../header.html";
include "../../databaseConection.php";

if(isset($_POST['array'])){
    
    $json = $_POST['array'];
    
    print_r($json);
    
    
}

include "../../footer.html";
?>