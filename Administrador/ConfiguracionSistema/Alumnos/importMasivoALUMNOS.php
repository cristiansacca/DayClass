<?php
include "../../../databaseConection.php";
include "../../class.upload.php"; //libreria para subir el archivo excel al servidor
include "../../../header.html";
?>
<div class="container">//Oculta todos los Notice que muestra por el error en la libreria
    <?php
    $correcto = [];
    $yaInscriptos = [];
    $formatoIncorrecto = [];

    if (isset($_FILES["inpGetFile"])) {

        $up = new Upload($_FILES["inpGetFile"]);

        if ($up->uploaded) {
            $up->Process("./uploads/");
            if ($up->processed) {
                /// leer el archivo excel
                require_once '../../PHPExcel/Classes/PHPExcel.php'; //incluimos la librería PHPExcel con la cual leeremos el archivo y tipo de archivo.
                $archivo = "uploads/" . $up->file_dst_name;
                $inputFileType = PHPExcel_IOFactory::identify($archivo); //abrimos/identificamos el archivo.
                $objReader = PHPExcel_IOFactory::createReader($inputFileType); //creamos un objeto tipo Reader 
                $objPHPExcel = $objReader->load($archivo);
                $sheet = $objPHPExcel->getSheet(0);

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

                $currentDateTime = date('Y-m-d H:i:s');
                $consulta1 = $con->query('SELECT id FROM `permiso` WHERE nombrePermiso = "ALUMNO"');
                $resultado1 = $consulta1->fetch_assoc();
                $id_permiso = $resultado1['id'];

                $first_row = 1;
                
                $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
     
                $formatoLegajo = $consultaParamLeg->fetch_assoc();
                $dni = $formatoLegajo["esDNI"];

                if($dni) {
                    $dni = $sheet->getCell("A" . $first_row)->getValue();
                    $apellido = $sheet->getCell("B" . $first_row)->getValue();
                    $nombre = $sheet->getCell("C" . $first_row)->getValue();

                    //valido que la primera fila de la tabla excel sea
                    //dni, apellido, nombre, en ese orden, sino esta asi no importa la lista 

                    $dni_p = strtolower($dni);
                    $nombre_p = strtolower($nombre);
                    $apellido_p = strtolower($apellido);

                    if (($dni_p == "dni" || $dni_p == "documento") &&  $nombre_p == "nombre" && $apellido_p == "apellido") {
                        for ($row = 2; $row <= $highestRow; $row++) {

                            $dni = $sheet->getCell("A" . $row)->getValue();
                            $apellido = $sheet->getCell("B" . $row)->getValue();
                            $nombre = $sheet->getCell("C" . $row)->getValue();


                            $consulta2 = $con->query("SELECT nombreAlum FROM alumno WHERE dniAlum = '$dni'");
                            $resultado2 = $consulta2->fetch_assoc();

                            if (mysqli_num_rows($consulta2) == 0 && $apellido != "") {
                                
                                
                                if(validarDNI($dni)){
                                    $sql = 'INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("' . $nombre . '","' . $apellido . '", "' . $dni . '","' . $currentDateTime . '","' . $dni . '",' . $id_permiso . ');';
                                    $rtdo = $con->query($sql);
                                    array_push($correcto, $dni);
                                }else{
                                    array_push($formatoIncorrecto, $dni);
                                }

                                
                            }else{

                                array_push($yaInscriptos, $legajo);
                            }
                        }
                    } else {
                        //echo "<script> alert('error en el formato de la primera fila') </script>";
                        //header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=6");
                    }

                }else {
                    $dni = $sheet->getCell("A" . $first_row)->getValue();
                    $legajo = $sheet->getCell("B" . $first_row)->getValue();
                    $apellido = $sheet->getCell("C" . $first_row)->getValue();
                    $nombre = $sheet->getCell("D" . $first_row)->getValue();

                    //valido que la primera fila de la tabla excel sea
                    //dni, legajo, apellido nombre, en ese orden, sino esta asi no importa la lista 

                    $dni_p = strtolower($dni);
                    $legajo_p = strtolower($legajo);
                    $nombre_p = strtolower($nombre);
                    $apellido_p = strtolower($apellido);

                    if (($dni_p == "dni" || $dni_p == "documento") && $legajo_p == "legajo" && $nombre_p == "nombre" && $apellido_p == "apellido") {
                        for ($row = 2; $row <= $highestRow; $row++) {

                            $dni = $sheet->getCell("A" . $row)->getValue();
                            $legajo = $sheet->getCell("B" . $row)->getValue();
                            $apellido = $sheet->getCell("C" . $row)->getValue();
                            $nombre = $sheet->getCell("D" . $row)->getValue();


                            $consulta2 = $con->query("SELECT nombreAlum FROM alumno WHERE dniAlum = '$dni' AND legajoAlumno = '$legajo'");
                            $resultado2 = $consulta2->fetch_assoc();

                            if (mysqli_num_rows($consulta2) == 0 && $apellido != "") {
                                
                                //echo "llega a validacion de legajo y dni";
                                
                                if(validarDNI($dni) && validarLegajo($legajo)){
                                    
                                   // echo "pasa la validacion de legajo y dni";
                                    
                                    $sql = 'INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("' . $nombre . '","' . $apellido . '", "' . $dni . '","' . $currentDateTime . '","' . $legajo . '",' . $id_permiso . ');';
                                    $rtdo = $con->query($sql);

                                    array_push($correcto, $legajo);
                                }else{
                                    if(validarDNI($dni) == false){
                                        array_push($formatoIncorrecto, $dni);
                                    }else{
                                        array_push($formatoIncorrecto, $legajo);
                                    }
                                    
                                }
                                   
                            } else {

                                array_push($yaInscriptos, $legajo);
                            }
                        }
                    } else {
                        //echo "<script> alert('error en el formato de la primera fila') </script>";
                       // header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=6");
                    }


                    
                }

                unlink($archivo);
            }
        }
    }

 function validarLegajo($legajo){
    include "../../../databaseConection.php";
     
     
     $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
     
    $longitudLegajo = strlen($legajo);

        
    $formatoLegajo = $consultaParamLeg->fetch_assoc();
    $dni = $formatoLegajo["esDNI"];

    if($dni) {
        
    }else {

        $letras = $formatoLegajo["tieneLetras"];
        $numeros = $formatoLegajo["tieneNumeros"];
        
        $rtdoNumeros = false;
        $rtdoLetras = false;

        $cantTotal = $formatoLegajo["cantTotalCaracteres"];

        
        if($longitudLegajo == $cantTotal){
            if($letras){
                $cantLetras = $formatoLegajo["cantLetras"];
                $soloLetras = substr($legajo, 0, $cantLetras);
                $rtdoLetras = ctype_upper($soloLetras);
                return $rtdoLetras;
                
            }
            
            
            if($numeros){
                $cantNumeros = $formatoLegajo["cantNumeros"]; 
                
                if($letras){
                   $soloNumeros = substr($legajo, $cantLetras);
                    $rtdoNumeros = is_numeric($soloNumeros);
                    return $rtdoNumeros;
                }else{
                    $soloNumeros = substr($legajo, 0, $cantNumeros);
                    $rtdoNumeros = is_numeric($soloNumeros);
                    return $rtdoNumeros;
                }
            }
            
            
        }else{
            return false;
        }
    }
}

  
    
    
function validarDNI($dni){
    $rtdo = false;
    
    $longitudDNI = strlen($dni);
    if($longitudDNI > 6 && $longitudDNI < 9){
        $rtdo = is_numeric($dni);   
    }
    
    return $rtdo;
}
    
 
    ?>
</div>

<div class="container">
    <?php

    if (count($yaInscriptos) > 0) {
        echo "<div class='alert alert-warning mt-4' role='alert'>
        <h5>Alumnos ya ingresados anteriormente</h5>
    <ul>";

        for ($i = 0; $i < count($yaInscriptos); $i++) {
            $consultaIns = $con->query("SELECT * FROM alumno WHERE legajoAlumno = '" . $yaInscriptos[$i] . "'")->fetch_assoc();
            echo "<li>" . $consultaIns['apellidoAlum'] . ", " . $consultaIns['nombreAlum'] . "</li>";
        }

        echo "</ul>
    </div>";
    }
    
    if(count($formatoIncorrecto) > 0){
        echo "<div class='alert alert-warning mt-4' role='alert'>
            <h5>Alumnos que tienen formato de legajo o dni incorrecto</h5>
        <ul>";

        for ($i=0; $i < count($formatoIncorrecto) ; $i++) { 
            echo "<li>Legajo: ".$formatoIncorrecto[$i]." </li>";
        }

        echo "</ul>
        </div>";
    }


    if (count($correcto) > 0) {
        echo "<div class='alert alert-success mt-4' role='alert'>
        <h5>Alumnos ingresados en el sistema satisfactoriamente</h5>
    <ul>";

        for ($i = 0; $i < count($correcto); $i++) {
            $consultaCorrecto = $con->query("SELECT * FROM alumno WHERE legajoAlumno = '" . $correcto[$i] . "'")->fetch_assoc();
            echo "<li>" . $consultaCorrecto['apellidoAlum'] . ", " . $consultaCorrecto['nombreAlum'] . "</li>";
        }

        echo "</ul>
    </div>";
    }
    ?>

    <a class="btn btn-primary" <?php echo "href='/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php'" ?>><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>

</div>

<script>
    document.getElementById("contenidoNavbar").innerHTML = "";
</script>

<?php
include "../../../footer.html";
?>