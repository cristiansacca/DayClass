<?php
//Se inicia o restaura la sesión
session_start();

include "../../header.html";
include "../../databaseConection.php";

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo']) && isset($_SESSION['limite'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $_SESSION['limite']) {
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

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<link rel="stylesheet" href="../../styleCards.css">


<div class="container ">
    <div class="py-4 my-3 jumbotron">
        <p class="card-text">Administrador</p>
        
        
        <?php
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $currentDate = date('Y-m-d');
            $id_permiso = $_GET["id_permiso"];

            $selectPermiso = $con->query("SELECT * FROM permiso WHERE permiso.id = '$id_permiso'");
            $permiso = $selectPermiso->fetch_assoc();

            $nombrePermiso = ucfirst(strtolower($permiso["nombrePermiso"]));


            echo "<h1>$nombrePermiso<i class='fa fa-user-tie ml-2'></i></h1>"
        
        ?>
        
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
        
    </div>
    <!-- Page Features -->
    <h2>Permisos del Rol</h2>
    <div class="py-4 my-3 jumbotron" style="background-color:PowderBlue;">
        <?php
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('Y-m-d');
        $id_permiso = $_GET["id_permiso"];

        $selectPermisosFuncion = $con->query("SELECT funcion.nombreFuncion, funcion.id FROM permiso, permisofuncion, funcion WHERE permiso.id = '$id_permiso' AND permiso.id = permisofuncion.id_permiso AND permisofuncion.fechaDesdePermisoFuncion <= '$currentDate' AND permisofuncion.fechaHastaPermisoFuncion IS NULL AND permisofuncion.id_funcion = funcion.id AND funcion.fechaDesdeFuncion <= '$currentDate' AND funcion.fechaHastaFuncion IS NULL");
        
        $contador = 0;
        while($permisosFuncion = $selectPermisosFuncion->fetch_assoc()){
            $nombreFuncion = $permisosFuncion["nombreFuncion"];
            $id_funcion = $permisosFuncion["id"];
                
           echo "<div class='col-lg-2 my-3' >
                <div class='card h-100 color$contador'>
                    <div class='card-body text-left'>
                        <label class='card-title'>$nombreFuncion</label>
                    </div>
                </div>
            </div>";    
        }
    
        ?>
    </div>
    
    <div>
        <h2>Usuarios asignados al Rol</h2>
        <div class="mb-4 table-responsive">

            <table id="dataTable" class="table table-secondary table-bordered table-hover">
                <thead>
                    <th>Legajo</th>
                    <th>Apellido</th>
                    <th>Nombre </th>
                    <th>DNI</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php

                    $consulta1 = $con->query("SELECT * FROM `usuario` WHERE id_permiso = '$id_permiso' ORDER BY legajoUsuario ASC");

                    while ($resultado1 = $consulta1->fetch_assoc()) {
                        if($resultado1['fechaBajaUsuario'] != NULL || $resultado1['fechaBajaUsuario'] != ""){
                                $urlReinc = 'reincAlum.php?id='.$resultado1["id"];
                                echo "<tr class='table-danger'>
                                    <td>" . $resultado1['legajoUsuario'] . "</td>
                                    <td>" . $resultado1['apellidoUsuario'] . "</td>
                                    <td>" . $resultado1['nombreUsuario'] . "</td>
                                    <td>" . $resultado1['dniUsuario'] . "</td> 
                                    <td class='text-center'><a class='btn btn-primary' onclick='return confirmComeBack()' href='$urlReinc'><i class='fa fa-undo mr-1'></i>Alta</a></td>
                                </tr>";
                            }else{
                                $urlBaja = 'bajaAlum.php?id='.$resultado1["id"];
                               echo "<tr>
                                    <td>" . $resultado1['legajoUsuario'] . "</td>
                                    <td>" . $resultado1['apellidoUsuario'] . "</td>
                                    <td>" . $resultado1['nombreUsuario'] . "</td>
                                    <td>" . $resultado1['dniUsuario'] . "</td> 
                                    <td class='text-center'><a class='btn btn-danger' onclick='return confirmDelete()' href='$urlBaja'><i class='fa fa-trash mr-1'></i>Baja</a></td>
                                </tr>"; 
                            }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    
    
    
    
    </div>

    

</div>




<script src="../administrador.js"></script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '" . $_SESSION['administrador']['nombreAdm'] . " " . $_SESSION['administrador']['apellidoAdm'] . "'" ?>
</script>

<?php
include "../../footer.html";
?>