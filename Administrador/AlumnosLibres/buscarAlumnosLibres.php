<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}
?>

<div class="container">

<div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Revisión diaria de alumnos libres</h1>
        <a href="/DayClass/Administrador/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
</div>

<?php
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$currentDate = date('Y-m-d');
$cantLibres = 0;
$cantJustos = 0;

$selectParamMinimoAsistencia = $con->query("SELECT * FROM `paramminimoasistencia` WHERE paramminimoasistencia.fechaAltaMinimoAsistencia <= '$currentDate' AND paramminimoasistencia.fechaBajaMinimoAsistencia IS NULL")->fetch_assoc();

if($selectParamMinimoAsistencia != null){
    $porcentajeMinAsistencia = $selectParamMinimoAsistencia["porcentajeAsistencia"];
    
    $selectCursosVigentes = $con->query("SELECT * FROM `curso` WHERE curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'");
    
    if(mysqli_num_rows($selectCursosVigentes) != 0){
        while($selectCursosVigentes2 = $selectCursosVigentes->fetch_assoc()){
            $id_curso = $selectCursosVigentes2["id"];
            $nombre_curso = $selectCursosVigentes2["nombreCurso"];
            $totalDiasCursado = calcularDiasCursado($id_curso);
            
            //echo "$id_curso";
            //echo "$totalDiasCursado";
            
            if($totalDiasCursado != null){
               $selectAsistenciasAlumnoCurso = $con->query("SELECT asistencia.id, asistencia.alumno_id FROM asistencia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND curso.fechaDesdeCursado = asistencia.fechaDesdeFichaAsis AND curso.fechaHastaCursado = asistencia.fechaHastaFichaAsis");
            
            if(mysqli_num_rows($selectAsistenciasAlumnoCurso) != 0){
                while($selectAsistenciasAlumnoCurso2= $selectAsistenciasAlumnoCurso->fetch_assoc()){
                    $id_alumno = $selectAsistenciasAlumnoCurso2["alumno_id"];
                    
                    //echo "$id_alumno";
                                    
                    $selectEstadoAlumno = $con->query("SELECT cursoestadoalumno.nombreEstado FROM alumno, alumnocursoactual, curso, alumnocursoestado, cursoestadoalumno WHERE curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumno.id = '$id_alumno' AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.fechaDesdeAlumCurAc = curso.fechaDesdeCursado AND alumnocursoactual.fechaHastaAlumCurAc = curso.fechaHastaCursado AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado > '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id")->fetch_assoc();
                    
                    $estadoAlumno = $selectEstadoAlumno["nombreEstado"];
                    
                    if($estadoAlumno == "INSCRIPTO"){
                        $selectCantInasistenciasAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantAusentes FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$id_alumno' AND asistenciadia.asistencia_id = asistencia.id AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'AUSENTE'");
                        
                        if(mysqli_num_rows($selectCantInasistenciasAlumno) != 0){
                            $selectCantInasistenciasAlumno2 = $selectCantInasistenciasAlumno->fetch_assoc();
                            $cantAusentes = $selectCantInasistenciasAlumno2["cantAusentes"];
                            $rtdoCompararDias = compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantAusentes);
                            
                            switch($rtdoCompararDias){
                                case "JUSTO":
                                    $envioMail = alumnoSinInasistencias($id_alumno, $id_curso);
                                    $cantJustos ++;
                                    //echo "entro por justo";
                                    break;
                                 
                                case "LIBRE": 
                                   $envioMail = alumnoLibre($id_alumno, $id_curso);
                                    $cantLibres ++;
                                    //echo "entro libre";
                                    break;
                                    
                                default:
                                    //echo "entro default";
                                    break;
                                    
                            }  
                        }else{
                            //alumno que no registra ausentes
                            
                        }
                    }else{
                        //el alumno ya esta libre, no continua 
                        //echo "alumno libre";
                        
                    }
                    
                
                }
                
            }else{
                //no alumnos inscriptos en ese curso
                echo "<div class='alert alert-info' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>El curso $nombre_curso no tiene alumnos inscriptos.</h5>
                </div>";
                
            } 
            
                
            }else{
                //no hay dias de cursado
                echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>El curso $id_curso no tiene días de cursado definidos.</h5>
                </div>";
            } 
           
            
        }
        
    }else{
        //no hay cursos vigentes
         echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay cursos con fechas de cursado vigentes.</h5>
        </div>";
    }
    
}else{
    //no hay porcentaje de minimo de asistencia
    echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay un porcentaje mínimo de asistencias definido.</h5>
        </div>";
}



function calcularDiasCursado($idCurso){
    include "../../databaseConection.php";
    
    //contar la cantidad de clases que se tiene por semana
    $selectCantClasesPorSemana = $con->query("SELECT COUNT(id) AS cantDias FROM `horariocurso` WHERE horariocurso.curso_id = '$idCurso'")->fetch_assoc();
    
    //si hay dias de la semana definidos para ese curso 
    if($selectCantClasesPorSemana != null){
        
        //leer la cantidad de clases que hay en una semana 
        $clasesPorSemana = $selectCantClasesPorSemana["cantDias"];
        
        //traer las fechas de cursado del curso en cuestion 
        $selectFechasCursadoCurso = $con->query("SELECT curso.fechaDesdeCursado, curso.fechaHastaCursado FROM `curso` WHERE curso.id = '$idCurso'")->fetch_assoc();
        $fechaDesdeCursado = $selectFechasCursadoCurso["fechaDesdeCursado"];
        $fechaHastaCursado = $selectFechasCursadoCurso["fechaHastaCursado"];
        
        //sacar la cantidad de semanas de cursado que hay entre las fechas de cursado
        $semanasCursado = (strtotime($fechaHastaCursado) - strtotime($fechaDesdeCursado) ) / (60 * 60 * 24 * 7);
        
        //redondear el numero de semanas, a un numero "redondo"
        $cantSemanasCursado = ceil($semanasCursado);
        //echo "cant semanas cursado:  $cantSemanasCursado\r\n";
        
        //sacar los dias de cursado, multiplicando las semanas de cursado por la cantidad de clases semanales
        $cantDiasCursado = $cantSemanasCursado * $clasesPorSemana;
        //echo "cant real de clases: $cantDiasCursado\r\n";
        
        //se quita una cantidad de dias por los dias que no hay clases y por la aproximacion de semanas
        $diasEfectivosCursado = $cantDiasCursado - 5;
        //echo "post resta de 5 dias: $diasEfectivosCursado";
        
        return $diasEfectivosCursado;
        
        
    }else{
        //el curso no tiene definido horarios 
        return null;
    }
     
}

function compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantInasistenciasAlumno){
    
    //echo "porcenyaje inasistencia: $porcentajeMinAsistencia";
   // echo "total dias cursado: $totalDiasCursado";
    //echo "cantidad inasistencias del alumno: $cantInasistenciasAlumno";
    
     //calculo de dias 
    $porcentajeInasistencias = 1-$porcentajeMinAsistencia;
    $maxInasistencias = ceil($totalDiasCursado * $porcentajeInasistencias);

    
   
    //echo "Ausentes permitidos: $maxInasistencias";
    
    if($cantInasistenciasAlumno == $maxInasistencias){
        //el alumno esta en el limite, enviar informativo de que no le quedan mas inasistencias
        //echo "Justo";
        return "JUSTO";
    }else{
        //echo "entra al else de cantInasistenciasAlumno == maxInasistencias";
        if($maxInasistencias < $cantInasistenciasAlumno){
           //alumnos libre, CAMBIAR ESTADO, ENVIAR MAIL  }}
            //echo "Libre";
            return "LIBRE";
        }else{
            
            //$cantInasistenciasAlumno < $ausentesPermitidos
            //le quedan inasistencias al alumno, NO HACE NADA 
            //echo "Nada";
            return "NADA";
            
        }
    }
}


function alumnoSinInasistencias($id_alumno, $id_curso){
    include "../../databaseConection.php";
    //buscar los datos del alumno
    $selectDatosAlumno = $con->query("SELECT * FROM `alumno` WHERE alumno.id = '$id_alumno'")->fetch_assoc();
    $nombreAlumno = $selectDatosAlumno["nombreAlum"];
    $apellidoAlumno = $selectDatosAlumno["apellidoAlum"];
    $mailAlumno = $selectDatosAlumno["emailAlum"];
    
    //buscar los datos del curso
    $selectDatosCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso'")->fetch_assoc();
    $nombreCurso =  $selectDatosCurso["nombreCurso"];
    
    // Mensaje al alumno 
    $mensaje = "$nombreAlumno $apellidoAlumno, \r\nEste correo electronico es para informale que NO le quedan mas inasistencias en $nombreCurso \r\nAnte una proxima ausencia pasará a quedar libre, puede revertir su situación justificando las ausencias que registra, en la sección correspondiente. \r\nEste correo electronico fue generado de mananera automatica, por favor no lo responda. \r\nSaludos.";

    // Si cualquier línea es más larga de 200 caracteres, se debería usar wordwrap()
    $mensaje = wordwrap($mensaje, 200, "\r\n");

    //direccion de mail destino, cambiar por el mail propio para porbar 
    $destino = "lea220197@gmail.com,$mailAlumno,dayclassdev@gmail.com";

    // Enviamos el email
    $rtdo = mail($destino, 'Aviso de limite de inasistencias alcanzado', $mensaje);
    
    
    echo "<div class='alert alert-info' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Se le ha informado a $nombreAlumno $apellidoAlumno que ha llegado al máximo de insistencias en $nombreCurso.</h5>
        </div>";

    return $rtdo;
}

function alumnoLibre($id_alumno, $id_curso){
    
    include "../../databaseConection.php";
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d');
    
   $selectAlumnoCursoEstado = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado FROM alumnocursoactual, alumno, curso, alumnocursoestado, cursoestadoalumno WHERE alumno.id = '$id_alumno' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' AND alumnocursoestado.fechaFinEstado > '$currentDateTime' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO'");

    if(!($selectAlumnoCursoEstado->num_rows) == 0){
        $alumnoCursoEstado = $selectAlumnoCursoEstado->fetch_assoc();
        $id_alumnoCursoEstado = $alumnoCursoEstado["idAlumnoCursoEstado"];
        $fechaFinAlumnoCursoEstado = $alumnoCursoEstado["fechaFinEstado"];
        $id_alumnoCursoActual = $alumnoCursoEstado["alumnoCursoActual_id"];

        //actulizar la fecha hasta del estado inscripto hasta hoy 
        $updateAlumnoCursoEstado = $con->query("UPDATE `alumnocursoestado` SET `fechaFinEstado`='$currentDateTime' WHERE `id` = $id_alumnoCursoEstado");

        if($updateAlumnoCursoEstado){
            //crear una instancia nueva de estado, relacionada a estado = libre, a partir de hoy y hasta el fin del cursado
            $insertAlumnoCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fechaFinAlumnoCursoEstado','$currentDateTime','$id_alumnoCursoActual','2')");

                if($insertAlumnoCursoEstado){
                    //se dio de baja al alumno en el curso
                    //disparar la funcion mail 
                    return avisoAlumnoLibre($id_alumno, $id_curso);

                }else{
                    //error 
                    //header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
                }
        }else{
                //error 
                //header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
        }

    }else{
        //error 
       // header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
    } 
}

function avisoAlumnoLibre($id_alumno, $id_curso){
    include "../../databaseConection.php";
    //buscar los datos del alumno
    $selectDatosAlumno = $con->query("SELECT * FROM `alumno` WHERE alumno.id = '$id_alumno'")->fetch_assoc();
    $nombreAlumno = $selectDatosAlumno["nombreAlum"];
    $apellidoAlumno = $selectDatosAlumno["apellidoAlum"];
    $mailAlumno = $selectDatosAlumno["emailAlum"];
    
    //buscar los datos del curso
    $selectDatosCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso'")->fetch_assoc();
    $nombreCurso =  $selectDatosCurso["nombreCurso"];
    
    // Mensaje al alumno 
    $mensaje = "$nombreAlumno $apellidoAlumno, \r\nEste correo electrónico es para informale que que ha quedado LIBRE en $nombreCurso \r\nSu asistencia ya no será contabilizada, ante un error en esta situacion pongase en contacto con administración. \r\nEste correo electronico fue generado de mananera automatica, por favor no lo responda. \r\nSaludos. ";

    // Si cualquier línea es más larga de 200 caracteres, se debería usar wordwrap()
    $mensaje = wordwrap($mensaje, 200, "\r\n");

    //direccion de mail destino, cambiar por el mail propio para porbar 
    $destino = "lea220197@gmail.com,$mailAlumno,dayclassdev@gmail.com";

    // Enviamos el email
    $rtdo = mail($destino, 'Aviso de estado libre', $mensaje);
    
    
    echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>Se le ha informado a $nombreAlumno $apellidoAlumno que ha quedado libre en $nombreCurso.</h5>
        </div>";

    return $rtdo;
}

?>

<?php
    if($cantLibres == 0){
        echo "<div class='alert alert-success' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Ningún alumno ha quedado libre el día de hoy.</h5>
            </div>";
    }
    
    if($cantJustos == 0){
        echo "<div class='alert alert-success' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay alumnos que tengan la cantidad máxima de faltas permitidas.</h5>
            </div>";
    }
?>
    
    
</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>