<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";


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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 25")->fetch_assoc(); // <-- Cambia
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

$id_curso = $_POST['idCursoCargar'];
$fecha = $_POST['fechaCargar'];

$consultaInscriptos = $con->query("SELECT usuario.id, apellidoUsuario, nombreUsuario, legajoUsuario 
FROM usuario, alumnocursoactual, curso, cursoestadoalumno, alumnocursoestado 
WHERE usuario.id = alumnocursoactual.alumno_id 
    AND usuario.fechaBajaUsuario IS NULL 
    AND alumnocursoactual.curso_id = curso.id 
    AND curso.id = '$id_curso' 
    AND alumnocursoactual.fechaHastaAlumCurAc > '$fecha' 
    AND alumnocursoactual.fechaDesdeAlumCurAc<= '$fecha' 
    AND alumnocursoactual.id = alumnocursoestado.alumnoCursoActual_id 
    AND alumnocursoestado.fechaInicioEstado <= '$fecha' 
    AND alumnocursoestado.fechaFinEstado > '$fecha' 
    AND alumnocursoestado.cursoEstadoAlumno_id = cursoestadoalumno.id 
    AND UPPER(cursoestadoalumno.nombreEstado) = 'INSCRIPTO' 
ORDER BY apellidoUsuario ASC");

$nombreCurso = $con->query("SELECT * FROM curso WHERE id = '$id_curso'")->fetch_assoc();

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Carga de asistencias</h1>   
        <a href="/DayClass/Profesor/GestionarAsistencia/gestionarAsistencia.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="my-4">
        <h4 class="font-weight-normal"><b>Curso: </b><?php echo $nombreCurso['nombreCurso'] ?></h4>
        <h4 class="font-weight-normal"><b>Fecha: </b><?php setlocale(LC_ALL, 'Spanish');
    $fechaFormateada = strftime("%d de %B del %Y", strtotime($fecha)); echo $fechaFormateada; ?></h4>
    </div>
    <input type="text" id="cantInscriptos" <?php echo "value='".$consultaInscriptos->num_rows."'"; ?> hidden>
    <div id="sinInscriptos" class="alert alert-warning" role="alert" hidden>
        <h5><i class='fa fa-exclamation-circle mr-2'></i>No hay alumnos inscriptos en el curso seleccionado.</h5>
    </div>
    <div class="table-responsive" id="tablaAsistencias" hidden>
        <table class="table table-secondary table-bordered">
            <thead>
                <th>Legajo</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Modificar</th>
            </thead>
            <tbody>
            <?php
                while($i = $consultaInscriptos->fetch_assoc()){
                    echo "<tr>
                        <td>".$i['legajoUsuario']."</td>
                        <td>".$i['apellidoUsuario']."</td>
                        <td>".$i['nombreUsuario']."</td>
                        <td name='asistencias' id='".$i['id']."'>PRESENTE</td>
                        <td class='text-center'><button onclick='modificar(".$i['id'].");' class='btn btn-warning'><i class='fa fa-retweet'></i></button></td>
                    </tr>";
                }
            ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="guardarCambios();"><i class="fa fa-save mr-1"></i>Guardar cambios</button>
    </div>
</div>

<script src="../profesor.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['usuario']['nombreUsuario'] . " " . $_SESSION['usuario']['apellidoUsuario'] . "'" ?>
</script>

<script>
    colorearAsistencia();
    verificarSiHayInscriptos();

    function verificarSiHayInscriptos(){
        var cantidad = document.getElementById("cantInscriptos").value;
        if(cantidad == 0){
            document.getElementById('sinInscriptos').hidden = false;
            document.getElementById('tablaAsistencias').hidden = true;
        } else {
            document.getElementById('tablaAsistencias').hidden = false;
            document.getElementById('sinInscriptos').hidden = true;
        }
    }

    function guardarCambios(){
        var datos = [];
        var asistencias = document.getElementsByName('asistencias');
        for (let i = 0; i < asistencias.length; i++) {
            var id = asistencias[i].id;
            var asistencia = asistencias[i].innerHTML;
            datos.push({
                id: id,
                asistencia: asistencia
            });
        }
        //alert(JSON.stringify(datos));
        var json = "json_string=" + (JSON.stringify(datos))
        $.ajax({
            url: <?php echo "'/DayClass/Administrador/Asistencias/guardarCambios.php?fecha=".$fecha."&&curso=".$id_curso."'";?>,
            type: 'POST',
            data: json,
            success: function(datosRecibidos) {
                //alert(datosRecibidos);
                json = JSON.parse(datosRecibidos);
                if(json.actualizados == json.total){
                    location.href = '/DayClass/Profesor/GestionarAsistencia/gestionarAsistencia.php?resultado=1';
                } else {
                    location.href = '/DayClass/Profesor/GestionarAsistencia/gestionarAsistencia.php?resultado=2';
                }
                
            }
        });
    }

    function modificar(id){
        eval("debugger;");
        var campo = document.getElementById(id);
        if(campo.innerHTML == 'PRESENTE'){
            campo.innerHTML = 'AUSENTE';
        } else {
            if(campo.innerHTML == 'AUSENTE'){
                campo.innerHTML = 'PRESENTE';
            } 
        }
        colorearAsistencia();
    }

    function colorearAsistencia() {
        var cell = $('td'); 

        cell.each(function() { //loop through all td elements ie the cells

            var cell_value = $(this).html(); //get the value

            if (cell_value == 'PRESENTE'){ //if then for if value is 1
                $(this).css({'color' : 'green'});
                $(this).css({'font-weight' : 'bold'});    // changes td to red.
            };
            if (cell_value == 'AUSENTE'){ //if then for if value is 1
                $(this).css({'color' : 'red'});
                $(this).css({'font-weight' : 'bold'});   // changes td to red.
            }
            if (cell_value == 'JUSTIFICADO'){ //if then for if value is 1
                $(this).css({'color' : '#ffc107'});
                $(this).css({'font-weight' : 'bold'});   // changes td to red.
            }
        });
    }
</script>

<?php
include "../../footer.html";
?>