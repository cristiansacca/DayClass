<?php
    include "../header.html";
    include "../databaseConection.php";
    //Se inicia o restaura la sesión
    session_start();
 
    //Si la variable sesión está vacía es porque no se ha iniciado sesión
    if (!isset($_SESSION['alumno'])) 
    {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php"); 
    }
    echo "<div class='container'>";
    $imagen = $_POST['imgJust'];
    $fechaDesde = $_POST['fechaDesde'];
    $fechaHasta = $_POST['fechaHasta'];
    $hoy = date('Y-m-d');

    $justificativo = $con->query("INSERT INTO justificativo (fechaPresentacion, imagenJustificativo, alumno_id) VALUES ('$hoy','$imagen', '".$_SESSION['alumno']['id']."')");
    $id_justificativo = $con->insert_id;
    $tipoasistencia = $con->query("SELECT * FROM tipoasistencia WHERE nombreTipoAsistencia = 'AUSENTE'")->fetch_assoc();
    
    if($justificativo && $id_justificativo!==null && $tipoasistencia!==null){
        foreach($_POST['materia'] as $id_curso){
            $consulta1 = $con->query("SELECT * FROM asistencia WHERE alumno_id ='".$_SESSION['alumno']['id']."' AND curso_id = '$id_curso'");
            while($asistencia = $consulta1->fetch_assoc()){
                
                $consulta2 = $con->query("SELECT * FROM asistenciadia 
                WHERE tipoasistencia_id ='".$tipoasistencia['id']."' AND asistencia_id = '".$asistencia['id']."' AND 
                fechaHoraAsisDia >= '$fechaDesde' AND fechaHoraAsisDia <= '$fechaHasta'");
                
                while($asistenciadia = $consulta2->fetch_assoc()){
    
                    $con->query("INSERT INTO justificativoasistenciadia (justificativo_id, asistenciaDia_id) 
                    VALUES ('$id_justificativo','".$asistenciadia['id']."')");
    
                }
    
            }
        }

        header("Location:/DayClass/Alumno/justificativos.php?resultado=1");
        
    } else {

        header("Location:/DayClass/Alumno/justificativos.php?resultado=1");

    }
    echo "</div>";
    include "../footer.html";
?>