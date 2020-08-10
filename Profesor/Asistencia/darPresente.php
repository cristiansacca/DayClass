<?php

echo "<script>alert('entre')</script>";


$data = json_decode($_POST['array']);
var_dump($data);

if(isset($_POST['data'])){
    $datos = $_POST['data'];
    echo "al menos entra";
    echo "$datos";
}else{
 echo "no entra";   
}
?>