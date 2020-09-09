<?php
include "../../../databaseConection.php";
include "../../class.upload.php"; //libreria para subir el archivo excel al servidor
include "../../../header.html";
?>
<div class="container"><!--Oculta todos los Notice que muestra por el error en la libreria-->
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


                            $consultaAl = $con->query("SELECT * FROM alumno WHERE dniAlum = '$dni'");
                            $consultaPr = $con->query("SELECT * FROM profesor WHERE dniProf = '$dni'");
                            $consultaAd = $con->query("SELECT * FROM administrativo WHERE dniAdm = '$dni'");
                            
                            

                            if (mysqli_num_rows($consultaAl) == 0 && mysqli_num_rows($consultaPr) == 0 && mysqli_num_rows($consultaAd) == 0) {
                                
                                
                                if(validarDNI($dni)){
                                    $sql = 'INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("' . $nombre . '","' . $apellido . '", "' . $dni . '","' . $currentDateTime . '","' . $dni . '",' . $id_permiso . ');';
                                    $rtdo = $con->query($sql);
                                    array_push($correcto, $dni);
                                }else{
                                    $nombreCompleto = $apellido . ", ".$nombre; 
                                    array_push($formatoIncorrecto, $nombreCompleto);
                                }

                                
                            }else{

                                array_push($yaInscriptos, $dni);
                            }
                        }
                    } else {
                        //echo "<script> alert('error en el formato de la primera fila') </script>";
                        header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=6");
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


                            $consultaAl = $con->query("SELECT * FROM alumno WHERE dniAlum = '$dni' AND legajoAlumno = '$legajo'");
                            $consultaPr = $con->query("SELECT * FROM profesor WHERE dniProf = '$dni' AND legajoProf = '$legajo'");
                            $consultaAd = $con->query("SELECT * FROM administrativo WHERE dniAdm = '$dni' AND legajoAdm = '$legajo'");
                            

                            if (mysqli_num_rows($consultaAl) == 0 && mysqli_num_rows($consultaPr) == 0 && mysqli_num_rows($consultaAd) == 0) {
                                
                                if(validarDNI($dni) && validarLegajo($legajo)){
                                    
                                    $sql = 'INSERT INTO `alumno`(`nombreAlum`,`apellidoAlum`, `dniAlum`, `fechaAltaAlumno`, `legajoAlumno`, `permiso_id`) VALUES ("' . $nombre . '","' . $apellido . '", "' . $dni . '","' . $currentDateTime . '","' . $legajo . '",' . $id_permiso . ');';
                                    $rtdo = $con->query($sql);

                                    array_push($correcto, $legajo);
                                }else{
                                    $nombreCompleto = $apellido . ", ".$nombre; 
                                    array_push($formatoIncorrecto, $nombreCompleto);
                                }
                                   
                            } else {

                                array_push($yaInscriptos, $legajo);
                            }
                        }
                    } else {
                        //echo "<script> alert('error en el formato de la primera fila') </script>";
                    header("Location:/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php?resultado=6");
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
         
    $dev = false;

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
            }
            
            
            if($numeros){
                $cantNumeros = $formatoLegajo["cantNumeros"]; 
                
                if($letras){
                   $soloNumeros = substr($legajo, $cantLetras);
                    $rtdoNumeros = is_numeric($soloNumeros);
                }else{
                    $soloNumeros = substr($legajo, 0, $cantNumeros);
                    $rtdoNumeros = is_numeric($soloNumeros);
                }
            }
            
            
            if($letras && $numeros && $rtdoNumeros && $rtdoLetras){
                $dev = true;
            }
            
            if($letras && $numeros == false && $rtdoLetras){
                $dev = true;
            }
        
            if($letras == false && $numeros  && $rtdoNumeros){
                $dev = true;
            }
            
            return $dev;
            
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
        <h5>Ya registrados en el sistema:</h5>
    <ul>";

        for ($i = 0; $i < count($yaInscriptos); $i++) {
            $consultaInsAl = $con->query("SELECT * FROM alumno WHERE legajoAlumno = '$yaInscriptos[$i]'");
            
            if((mysqli_num_rows($consultaInsAl) != 0)){
                $consultaInsAl= $consultaInsAl->fetch_assoc();
                echo "<li>" . $consultaInsAl['apellidoAlum'] . ", " . $consultaInsAl['nombreAlum'] . "</li>";
            }else{
                $consultaInsPr = $con->query("SELECT * FROM profesor WHERE legajoProf = '$yaInscriptos[$i]'");
                if((mysqli_num_rows($consultaInsPr) != 0)){
                    $consultaInsPr=$consultaInsPr->fetch_assoc();
                    echo "<li>" . $consultaInsPr['apellidoProf'] . ", " . $consultaInsPr['nombreProf'] . "</li>";
                }else{
                    $consultaInsAd = $con->query("SELECT * FROM administrativo WHERE legajoAdm = '$yaInscriptos[$i]'")->fetch_assoc();
                    echo "<li>" . $consultaInsAd['apellidoAdm'] . ", " . $consultaInsAd['nombreAdm'] . "</li>";
                }
            }
            
        }

        echo "</ul>
    </div>";
    }
    
    if(count($formatoIncorrecto) > 0){
        echo "<div class='alert alert-warning mt-4' role='alert'>
            <h5>Alumnos que tienen formato de legajo o DNI incorrecto:</h5>
        <ul>";

        for ($i=0; $i < count($formatoIncorrecto) ; $i++) { 
            echo "<li>".$formatoIncorrecto[$i]." </li>";
        }

        echo "</ul>
        </div>";
    }


    if (count($correcto) > 0) {
        echo "<div class='alert alert-success mt-4' role='alert'>
        <h5>Alumnos ingresados en el sistema satisfactoriamente:</h5>
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