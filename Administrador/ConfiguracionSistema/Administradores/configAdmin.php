<?php
//Se inicia o restaura la sesión
session_start();

include "../../../header.html";
 
//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['administrador'])) 
{
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
  
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<style>
    .custom-file-label::after {
        content: "Elegir";
    }
</style>


<div class="container">

    <div class="jumbotron my-4 py-4">
        <p class="card-text">Administrador</p>
        <h1>Administradores<i class="fa fa-user-tie ml-2"></i></h1>
        <a href="../../index.php" class="btn btn-info"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>

    <?php
    
    if(isset($_GET["resultado"])){
        switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Usuario agregado exitosamente, se le ha enviado un mail al correo proporcionado con la constraseña.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El documento o legajo ingresado ya se encuentra registrado.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Baja exitosa.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la baja.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 5:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>Error en el registro del administrativo, intente nuevamente.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 6:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>El email ingresado ya se encuentra regsitrado por otro usuario.</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
            }
    }

    ?>

    <div class="my-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user-plus mr-1"></i>Crear nuevo</button>
    </div>

    <div class="my-4 table-responsive">

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
                include "../../../databaseConection.php";

                $consulta1 = $con->query("SELECT `legajoAdm`,`apellidoAdm`,`nombreAdm`,`dniAdm`,`id`  FROM `administrativo` where `fechaBajaAdm` IS NULL ORDER BY apellidoAdm ASC");

                while ($resultado1 = $consulta1->fetch_assoc()) {
                    
                    $url = 'bajaAdmin.php?id='.$resultado1["id"];
                    $id = $resultado1["id"];
                    echo "<tr>
                    <td>" . $resultado1['legajoAdm'] . "</td>
                    <td>" . $resultado1['apellidoAdm'] . "</td>
                    <td>" . $resultado1['nombreAdm'] . "</td>
                    <td>" . $resultado1['dniAdm'] . "</td>
                    <td class='text-center'><a class='btn btn-danger' data-emp-id=".$id." onclick='return confirmDelete()' href='$url'><i class='fa fa-trash mr-1'></i>Baja</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="../../administrador.js"></script>
<script src="fnAgregarAdmin.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="../../paginadoDataTable.js"></script>

<!-- Modal nuevo administrador -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Nuevo Administrador</h5>
            </div>
            <form method="POST" id="insertAdmin" name="insertAdmin" action="insertAdmin.php" enctype="multipart/form-data" role="form" onsubmit="return validarA()">
                
                <?php
                    include "../../../databaseConection.php";
                    $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
                    $rtdo = false;
                    $dni = null;

                    if (!($consultaParamLeg->num_rows) == 0) {
                        $formatoLegajo = $consultaParamLeg->fetch_assoc();
                        $rtdo = true;
                        $dni = $formatoLegajo["esDNI"];

                        echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
                        if ($dni) {
                        }else {

                            $letras = $formatoLegajo["tieneLetras"];
                            $numeros = $formatoLegajo["tieneNumeros"];

                            $cantTotal = $formatoLegajo["cantTotalCaracteres"];
                            echo "<input type='text' id='cantTotal' name='cantTotal' value='$cantTotal' hidden>";

                            echo "<input type='text' id='letras' name='letras' value='$letras' hidden>";
                            echo "<input type='text' id='numeros' name='numeros' value='$numeros' hidden>";


                            if ($letras) {
                                $cantLetras = $formatoLegajo["cantLetras"];

                                echo "<input type='text' id='cantLetras' name='cantLetras' value='$cantLetras' hidden>";
                            }
                            if ($numeros) {
                                $cantNumeros = $formatoLegajo["cantNumeros"];

                                echo "<input type='text' id='cantNumeros' name='cantNumeros' value='$cantNumeros' hidden>";
                            }
                        }
                    }else{
                        echo "<div class='alert alert-warning' role='alert'>
                            <h5><i class='fa fa-exclamation-circle mr-2'></i>No se ha definido un formato de legajo, no se puede ingresar un nuevo administrador.</h5>
                        </div>";
                    } 

                ?>

        <div class="modal-body" <?php if($dni == null){ echo "hidden ";} ?>>
            <div class="form-row">
                <div class="form-group col-md-6">
                      <label for="inputName4">Nombre</label>
                      <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre" onchange="validarNombreA()" required>
                      <h9 class="msg" id="msjValidacionNombre"></h9>
                </div>
                <div class="form-group col-md-6">
                      <label for="inputSurname4">Apellido</label>
                      <input type="text" class="form-control" id="inputSurname" name="inputSurname" placeholder="Apellido" onchange="validarApellidoA()" required>
                      <h9 class="msg" id="msjValidacionApellido"></h9>
                </div>
            </div>

          <div class="form-row">
                <div <?php if($dni){ echo "class='form-group col-md-12' ";}else{ echo "class='form-group col-md-6' "; }?>>
                      <label for="inputDNI">DNI</label>
                      <input type="number" class="form-control" id="inputDNI" name="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNIA()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
                      <h9 class="msg" id="msjValidacionDNI"></h9>
                </div>
                <div class="form-group col-md-6" <?php if($dni){ echo "hidden ";}else{echo "required ";} ?>>
                      <label for="inputLegajo">Legajo</label>
                      <input type="text" class="form-control" id="inputLegajo" name="inputLegajo" placeholder="Legajo" onchange="validarLegajoA()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110">
                      <h9 class="msg" id="msjValidacionLegajo"></h9>
                </div>
          </div>

          <div class="form-row">
                <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" onchange="validarEmailA()" required>
                      <h9 class="msg" id="msjValidacionEmail"></h9>
                </div>
                <div class="form-group col-md-6">
                      <label for="inputDate">Fecha de nacimiento</label>
                      <input id="inputDate" name="inputDate" type="date" class="form-control" onkeydown="return false" onchange="validarFechaNacA()" required>
                      <h9 class="msg" id="msjValidacionFchNac"></h9>
                </div>
          </div>

          <div class="form-row">
                
          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnRegistrarse"> Crear</button>
        </div>
        </form>

        </div>

    </div>
</div>
<script type="text/javascript">
  function mostrarPassword() {
    var cambio = document.getElementById("inputPassword4");
    if (cambio.type == "password") {
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  }
</script>

<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../../../footer.html";
?>