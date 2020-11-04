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

    $consultaFuncionNecesaria = $con->query("SELECT * FROM funcion WHERE codigoFuncion = 8")->fetch_assoc(); // <-- Cambia
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

$consultaInscriptos = $con->query("SELECT alumno.id, legajoAlumno, nombreAlum, apellidoAlum, nombreCurso FROM alumno, asistencia, curso  WHERE asistencia.alumno_id = alumno.id AND asistencia.curso_id = curso.id AND curso.id = '$id_curso' ORDER BY apellidoAlum ASC");

$nombreCurso = $con->query("SELECT * FROM curso WHERE id = '$id_curso'")->fetch_assoc();

?>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <p><b>Rol: </b><?php echo "$nombreRol" ?></p>
        <h1>Carga de asistencias</h1>   
        <a href="/DayClass/Administrador/Asistencias/asistencias.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <div class="my-4">
        <h4 class="font-weight-normal"><b>Curso: </b><?php echo $nombreCurso['nombreCurso'] ?></h4>
        <h4 class="font-weight-normal"><b>Fecha: </b><?php echo $fecha ?></h4>
    </div>
    <div class="table-responsive">
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
                        <td>".$i['legajoAlumno']."</td>
                        <td>".$i['apellidoAlum']."</td>
                        <td>".$i['nombreAlum']."</td>
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

<script>
    colorearAsistencia();

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
                    location.href = '/DayClass/Administrador/Asistencias/asistencias.php?resultado=1';
                } else {
                    location.href = '/DayClass/Administrador/Asistencias/asistencias.php?resultado=2';
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
                campo.innerHTML = 'JUSTIFICADO';
            } else {
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