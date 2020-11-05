<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";


//-----------------------------------------------------------------------------------------------------------------------------

//Si la variable sesión está vacía es porque no se ha iniciado sesión
$funcionCorrecta = false;
$nombreRol = "Sin rol asignado";

if (!isset($_SESSION['usuario'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(!($_SESSION['usuario']['id_permiso'] == NULL || $_SESSION['usuario']['id_permiso'] == "")){
    $permiso = $con->query("SELECT * FROM permiso WHERE id = '".$_SESSION['usuario']['id_permiso']."'")->fetch_assoc();
    $consultaFunciones = $con->query("SELECT * FROM permisofuncion WHERE id_permiso = '".$permiso['id']."' AND fechaHastaPermisoFuncion IS NULL");

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 21")->fetch_assoc(); // <-- Cambia
    $idFuncionNecesaria = $consultaFuncionNecesaria['id'];

    while ($fn = $consultaFunciones->fetch_assoc()) {
        if ($fn['id_funcion'] == $idFuncionNecesaria) {
            $funcionCorrecta = true;
            break;
        }
    }

    $nombreRol = $permiso['nombrePermiso'];
}

if(!$funcionCorrecta){
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo'])&&isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
  
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $_SESSION['limite'])
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        header("Location: /DayClass/index.php?resultado=3");
  
        exit();
    }
  }
  $_SESSION['tiempo'] = time();

//-----------------------------------------------------------------------------------------------------------------------------


?>

<?php
    

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');


    $selectAlumnosLibresHoy = $con->query("SELECT `id`, `fechaAlumnosLibres`, `id_admin` FROM `alumnosLibres` WHERE alumnoslibres.fechaAlumnosLibres LIKE '$currentDate%'");
    
    if(($selectAlumnosLibresHoy->num_rows) != 0){
        header("location: /DayClass/Usuario/inicioSesion.php?error=4");
    }

?>


<script src="../administrador.js"></script>

<div class="container">

    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Revisión de alumnos libres</h1>
        <a href="/DayClass/index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(($selectAlumnosLibresHoy->num_rows) == 0){
        
    include "../../databaseConection.php";
        
    $cantLibres = 0;
    $cantJustos = 0;

    $selectParamMinimoAsistencia = $con->query("SELECT * FROM `paramminimoasistencia` WHERE paramminimoasistencia.fechaAltaMinimoAsistencia <= '$currentDate' AND paramminimoasistencia.fechaBajaMinimoAsistencia IS NULL")->fetch_assoc();

    if ($selectParamMinimoAsistencia != null) {
        $porcentajeMinAsistencia = $selectParamMinimoAsistencia["porcentajeAsistencia"];

        $selectCursosVigentes = $con->query("SELECT * FROM `curso` WHERE curso.fechaDesdeCurActual <= '$currentDate' AND curso.fechaHastaCurActul IS NULL AND curso.fechaDesdeCursado <= '$currentDate' AND curso.fechaHastaCursado > '$currentDate'");

        if (mysqli_num_rows($selectCursosVigentes) != 0) {
            while ($selectCursosVigentes2 = $selectCursosVigentes->fetch_assoc()) {
                $id_curso = $selectCursosVigentes2["id"];
                $nombre_curso = $selectCursosVigentes2["nombreCurso"];
                $totalDiasCursado = calcularDiasCursado($id_curso);

                if ($totalDiasCursado != null) {
                    $selectAsistenciasAlumnoCurso = $con->query("SELECT asistencia.id, asistencia.alumno_id FROM asistencia, curso WHERE curso.id = '$id_curso' AND asistencia.curso_id = curso.id AND curso.fechaDesdeCursado = asistencia.fechaDesdeFichaAsis AND curso.fechaHastaCursado = asistencia.fechaHastaFichaAsis");

                    if (mysqli_num_rows($selectAsistenciasAlumnoCurso) != 0) {
                        while ($selectAsistenciasAlumnoCurso2 = $selectAsistenciasAlumnoCurso->fetch_assoc()) {
                            $id_alumno = $selectAsistenciasAlumnoCurso2["alumno_id"];

                            $selectEstadoAlumno = $con->query("SELECT cursoestadoalumno.nombreEstado FROM usuario, alumnocursoactual, curso, alumnocursoestado, cursoestadoalumno WHERE curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND usuario.id = '$id_alumno' AND alumnocursoactual.alumno_id = usuario.id AND alumnocursoactual.fechaDesdeAlumCurAc = curso.fechaDesdeCursado AND alumnocursoactual.fechaHastaAlumCurAc = curso.fechaHastaCursado AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoestado.fechaInicioEstado <= '$currentDate' AND alumnocursoestado.fechaFinEstado > '$currentDate' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id")->fetch_assoc();

                            $estadoAlumno = $selectEstadoAlumno["nombreEstado"];

                            if ($estadoAlumno == "INSCRIPTO") {
                                $selectCantInasistenciasAlumno = $con->query("SELECT COUNT(asistenciadia.tipoAsistencia_id) AS cantAusentes FROM asistencia, asistenciadia, tipoasistencia WHERE asistencia.alumno_id = '$id_alumno' AND asistencia.curso_id = '$id_curso' AND asistenciadia.asistencia_id = asistencia.id AND asistencia.fechaDesdeFichaAsis <= asistenciadia.fechaHoraAsisDia AND asistencia.fechaHastaFichaAsis >= asistenciadia.fechaHoraAsisDia AND asistenciadia.tipoAsistencia_id = tipoasistencia.id AND tipoasistencia.nombreTipoAsistencia = 'AUSENTE'");

                                if (mysqli_num_rows($selectCantInasistenciasAlumno) != 0) {
                                    $selectCantInasistenciasAlumno2 = $selectCantInasistenciasAlumno->fetch_assoc();
                                    $cantAusentes = $selectCantInasistenciasAlumno2["cantAusentes"];
                                    $rtdoCompararDias = compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantAusentes);

                                    switch ($rtdoCompararDias) {
                                        case "JUSTO":
                                            $envioMail = alumnoSinInasistencias($id_alumno, $id_curso);
                                            $cantJustos++;
                                            break;

                                        case "LIBRE":
                                            $envioMail = alumnoLibre($id_alumno, $id_curso);
                                            $cantLibres++;
                                            break;

                                        default:
                                            break;
                                    }
                                } else {
                                    //alumno que no registra ausentes

                                }
                            } else {
                                //el alumno ya esta libre, no continua 
                                //echo "alumno libre";

                            }
                        }
                    } else {
                        //no alumnos inscriptos en ese curso
                        echo "<div class='alert alert-info' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>El curso $nombre_curso no tiene alumnos inscriptos.</h5>
                </div>";
                    }
                } else {
                    //no hay dias de cursado
                    echo "<div class='alert alert-warning' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>El curso $id_curso no tiene días de cursado definidos.</h5>
                </div>";
                }
            }
        } else {
            //no hay cursos vigentes
            echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay cursos con fechas de cursado vigentes.</h5>
        </div>";
        }
    } else {
        //no hay porcentaje de minimo de asistencia
        echo "<div class='alert alert-warning' role='alert'>
                <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay un porcentaje mínimo de asistencias definido.</h5>
        </div>";
    }
        
    }



    function calcularDiasCursado($idCurso){
        include "../../databaseConection.php";

        //contar la cantidad de clases que se tiene por semana
        $selectCantClasesPorSemana = $con->query("SELECT COUNT(id) AS cantDias FROM `horariocurso` WHERE horariocurso.curso_id = '$idCurso'")->fetch_assoc();

        //si hay dias de la semana definidos para ese curso 
        if ($selectCantClasesPorSemana != null) {
            
            //traer todos los dias de la semana que se dicta ese curso
            $selectDiasClasePorSemana = $con->query("SELECT cursodia.dayName FROM `horariocurso`, cursodia WHERE horariocurso.curso_id = '$idCurso' AND cursodia.id = horariocurso.cursoDia_id");
            
            //armar un arreglo con los dias de cursado de la semana 
            $arregloDiasClasePorSemana = [];
            while ($row = $selectDiasClasePorSemana->fetch_assoc()) {
                $dayName = $row["dayName"];
                array_push($arregloDiasClasePorSemana, $dayName);
            }

            //leer la cantidad de clases que hay en una semana 
            $clasesPorSemana = $selectCantClasesPorSemana["cantDias"];

            //traer las fechas de cursado del curso en cuestion 
            $selectFechasCursadoCurso = $con->query("SELECT curso.fechaDesdeCursado, curso.fechaHastaCursado FROM `curso` WHERE curso.id = '$idCurso'")->fetch_assoc();
            $fechaDesdeCursado = $selectFechasCursadoCurso["fechaDesdeCursado"];
            $fechaHastaCursado = $selectFechasCursadoCurso["fechaHastaCursado"];

            //sacar la cantidad de semanas de cursado que hay entre las fechas de cursado
            $semanasCursado = (strtotime($fechaHastaCursado) - strtotime($fechaDesdeCursado)) / (60 * 60 * 24 * 7);

            //redondear el numero de semanas, al entero mas cercano
            $cantSemanasCursado = ceil($semanasCursado);

            //sacar los dias de cursado, multiplicando las semanas de cursado por la cantidad de clases semanales
            $cantDiasCursado = $cantSemanasCursado * $clasesPorSemana;

            //traer los dias sin clases que entran durante el cursado de la materia 
            $selectDiasSinClases= $con->query("SELECT diassinclases.fechaDiaSinClases FROM diassinclases,curso WHERE curso.id = '$idCurso' AND diassinclases.fechaDiaSinClases >= curso.fechaDesdeCursado AND diassinclases.fechaDiaSinClases <= curso.fechaHastaCursado AND diassinclases.fechaBajaDiaSinClases IS NULL");
            
            $cantDiaSinClases = 0;
            
            if(($selectDiasSinClases->num_rows) != 0){
                
                while($diaSinClases = $selectDiasSinClases->fetch_assoc()){
                    $noClasesDay = $diaSinClases["fechaDiaSinClases"];
                    
                    $nombreDiaSinClases = date('l', strtotime($noClasesDay));
                    
                    //echo "Nombre dia sin clases: ".$nombreDiaSinClases;
                    for($i = 0; $i < count($arregloDiasClasePorSemana); $i++){
                        
                        $nombreDiaClases = $arregloDiasClasePorSemana[$i];
                        
                        //echo "Nombre dia de clases: " . $nombreDiaClases;
                        
                        //si el nombre del dia feriado/sinClases coincide un un dia de cusado se aumenta la cantidad de dias sin clases
                        if($nombreDiaClases == $nombreDiaSinClases){
                            $cantDiaSinClases ++;
                            break;
                        }
                    }
                }
            }
            
            
            //se le resta a los dias de cursado calculados (clasePorSemana * cantSemanas) los dias caen feriado o dia sin clases, de los que se cursa esa materia
            $diasEfectivosCursado = $cantDiasCursado - $cantDiaSinClases;
            
            //echo "Cantidad dias cursado: " . $cantDiasCursado;
            
            //echo "Cantidad dias sin clases: " . $cantDiaSinClases;
            
            //echo "Cantidad total de clases: " . $diasEfectivosCursado;
            
            return $diasEfectivosCursado;
        } else {
            //el curso no tiene definido horarios 
            return null;
        }
    }

    function compararDias($porcentajeMinAsistencia, $totalDiasCursado, $cantInasistenciasAlumno) {
        //calculo de dias 
        $porcentajeInasistencias = 1 - $porcentajeMinAsistencia;
        $maxInasistencias = ceil($totalDiasCursado * $porcentajeInasistencias);

        if ($cantInasistenciasAlumno == $maxInasistencias) {
            //el alumno esta en el limite, enviar informativo de que no le quedan mas inasistencias
            return "JUSTO";
        } else {

            if ($maxInasistencias < $cantInasistenciasAlumno) {
                //alumnos libre, CAMBIAR ESTADO, ENVIAR MAIL  }}
                return "LIBRE";
            } else {

                //$cantInasistenciasAlumno < $ausentesPermitidos
                //le quedan inasistencias al alumno, NO HACE NADA 
                return "NADA";
            }
        }
    }


    function alumnoSinInasistencias($id_alumno, $id_curso) {
        include "../../databaseConection.php";
        
        $selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'ALUMNO'");
        $permiso = $selectPermiso->fetch_assoc();
        $id_permiso = $permiso["id"];
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d H:m:s');
        $fechaAlumnoLibre = date_create($currentDate);
        $fechaAlumnoLibre =  date_format($fechaAlumnoLibre, "d/m/Y H:m:s");
        
        //buscar los datos del alumno
        $selectDatosAlumno = $con->query("SELECT * FROM `usuario` WHERE usuario.id = '$id_alumno' AND id_permiso = '$id_permiso'")->fetch_assoc();
        $nombreAlumno = $selectDatosAlumno["nombreUsuario"];
        $apellidoAlumno = $selectDatosAlumno["apellidoUsuario"];
        $mailAlumno = $selectDatosAlumno["emailUsuario"];

        //buscar los datos del curso
        $selectDatosCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso'")->fetch_assoc();
        $nombreCurso =  $selectDatosCurso["nombreCurso"];

        // Mensaje al alumno 
        $mensaje = "                                                                                                      $fechaAlumnoLibre
Hola, $nombreAlumno $apellidoAlumno. 

Se le informa que el día $fechaAlumnoLibre ha alcanzado el máximo de inasistencias permitidas en el curso $nombreCurso. Luego de la próxima inasistencia quedará en estado LIBRE. 
Puede revertir su situación justificando las ausencias que registra hasta el momento, en la sección correspondiente. 
Este correo fue enviado de mananera automática, por favor no responda. 

Saludos. 
Equipo de DayClass.";

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

    function alumnoLibre($id_alumno, $id_curso) {

        include "../../databaseConection.php";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDateTime = date('Y-m-d');
        
        $selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'ALUMNO'");
        $permiso = $selectPermiso->fetch_assoc();
        $id_permiso = $permiso["id"];
        
        

        $selectAlumnoCursoEstado = $con->query("SELECT cursoestadoalumno.nombreEstado, alumnocursoestado.id AS idAlumnoCursoEstado, alumnocursoestado.alumnoCursoActual_id, alumnocursoestado.fechaFinEstado, alumnocursoestado.fechaInicioEstado FROM alumnocursoactual, usuario, curso, alumnocursoestado, cursoestadoalumno WHERE usuario.id = '$id_alumno' AND usuario.id_permiso = '$id_permiso' AND curso.id = '$id_curso' AND alumnocursoactual.curso_id = curso.id AND alumnocursoactual.alumno_id = alumno.id AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id AND alumnocursoactual.fechaDesdeAlumCurAc <= '$currentDateTime' AND alumnocursoactual.fechaHastaAlumCurAc > '$currentDateTime' AND (alumnocursoactual.fechaDesdeAlumCurAc <= alumnocursoestado.fechaInicioEstado) AND (alumnocursoactual.fechaHastaAlumCurAc >= alumnocursoestado.fechaFinEstado) AND alumnocursoestado.fechaInicioEstado <= '$currentDateTime' AND alumnocursoestado.fechaFinEstado > '$currentDateTime' AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id AND cursoestadoalumno.nombreEstado = 'INSCRIPTO'");

        if (!($selectAlumnoCursoEstado->num_rows) == 0) {
            $alumnoCursoEstado = $selectAlumnoCursoEstado->fetch_assoc();
            $id_alumnoCursoEstado = $alumnoCursoEstado["idAlumnoCursoEstado"];
            $fechaFinAlumnoCursoEstado = $alumnoCursoEstado["fechaFinEstado"];
            $id_alumnoCursoActual = $alumnoCursoEstado["alumnoCursoActual_id"];

            //actulizar la fecha hasta del estado inscripto hasta hoy 
            $updateAlumnoCursoEstado = $con->query("UPDATE `alumnocursoestado` SET `fechaFinEstado`='$currentDateTime' WHERE `id` = $id_alumnoCursoEstado");

            if ($updateAlumnoCursoEstado) {
                //crear una instancia nueva de estado, relacionada a estado = libre, a partir de hoy y hasta el fin del cursado
                $insertAlumnoCursoEstado = $con->query("INSERT INTO `alumnocursoestado`(`fechaFinEstado`, `fechaInicioEstado`, `alumnoCursoActual_id`, `cursoEstadoAlumno_id`) VALUES ('$fechaFinAlumnoCursoEstado','$currentDateTime','$id_alumnoCursoActual','2')");

                if ($insertAlumnoCursoEstado) {
                    //se dio de baja al alumno en el curso
                    //disparar la funcion mail 
                    return avisoAlumnoLibre($id_alumno, $id_curso);
                } else {
                    //error 
                    //header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
                }
            } else {
                //error 
                //header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
            }
        } else {
            //error 
            // header("Location:/DayClass/Administrador/MateriaCurso/Curso/alumnosCurso.php?id=$id_curso&&resultado=4");
        }
    }

    function avisoAlumnoLibre($id_alumno, $id_curso) {
        include "../../databaseConection.php";
        
        
        $selectPermiso = $con->query("SELECT * FROM permiso WHERE nombrePermiso = 'ALUMNO'");
        $permiso = $selectPermiso->fetch_assoc();
        $id_permiso = $permiso["id"];
        
        $currentDate = date('Y-m-d H:m:s');
        $fechaAlumnoLibre = date_create($currentDate);
        $fechaAlumnoLibre =  date_format($fechaAlumnoLibre, "d/m/Y H:m:s");
        
        //buscar los datos del alumno
        $selectDatosAlumno = $con->query("SELECT * FROM `usuario` WHERE usuario.id = '$id_alumno' AND usuario.id_permiso = '$id_permiso' ")->fetch_assoc();
        $nombreAlumno = $selectDatosAlumno["nombreUsuario"];
        $apellidoAlumno = $selectDatosAlumno["apellidoUsuario"];
        $mailAlumno = $selectDatosAlumno["emailUsuario"];

        //buscar los datos del curso
        $selectDatosCurso = $con->query("SELECT * FROM `curso` WHERE curso.id = '$id_curso'")->fetch_assoc();
        $nombreCurso =  $selectDatosCurso["nombreCurso"];

        // Mensaje al alumno 
        $mensaje = "                                                                                                      $fechaAlumnoLibre
Hola, $nombreAlumno $apellidoAlumno. 

Se le informa que el día $fechaAlumnoLibre ha quedado LIBRE en el curso $nombreCurso por lo que su asistencia ya no será contabilizada. 
Ante un error en esta situación póngase en contacto con administración. 

Este correo fue enviado de mananera automática, por favor no responda. 

Saludos. 
Equipo de DayClass";

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
    if(($selectAlumnosLibresHoy->num_rows) == 0){
    if ($cantLibres == 0) {
        echo "<div class='alert alert-success' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>Ningún alumno ha quedado libre el día de hoy.</h5>
            </div>";
    }

    if ($cantJustos == 0) {
        echo "<div class='alert alert-success' role='alert'>
                    <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay alumnos que tengan la cantidad máxima de faltas permitidas.</h5>
            </div>";
    }
    
    $id_admin = $_SESSION['usuario']['id'];
    
    $insertAlumnosLibres = $con->query("INSERT INTO `alumnosLibres`(`fechaAlumnosLibres`, `id_admin`) VALUES ('$currentDateTime','$id_admin')");
    }
    ?>


</div>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>