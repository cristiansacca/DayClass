<?php
include "../header.html";
?>

<script src="signIn_funciones.js"></script>

<div class="container">
    <div class="jumbotron my-4 py-4">
        <h1>Registro de nuevo usuario</h1>
        <h6 class="text-muted">Los datos aquí ingresados serán validados con los de la institución, cualquier falsedad en los mismos puede derivar en una panalización por parte de la institución.</h6>
        <a href="/DayClass/index.php" class="btn btn-success"><i class="fa fa-arrow-circle-left mr-1"></i>Volver</a>
    </div>
    <form action="sign_inParte2.php" method="POST" onsubmit="return validarDNIyLegajo()">
        
        <!--Mensajes de error o exito de registro-->
        <?php
        if (isset($_GET["resultado"])) {

            switch ($_GET["resultado"]) {
                case 1:
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <h5>Registro Exitoso</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Datos no localizados</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 3:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>Usuario ya registrado</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
                case 4:
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <h5>El Correo Electronico, ya es utilizado por otro usuario, proporcione otro</h5>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    break;
            }
        }

        ?>

        <?php
        include "../databaseConection.php";
        $consultaParamLeg = $con->query("SELECT * FROM parametrolegajo");
        $rtdo = false;
        $dni = null;

        if (!($consultaParamLeg->num_rows) == 0) {
            $formatoLegajo = $consultaParamLeg->fetch_assoc();
            $rtdo = true;
            $dni = $formatoLegajo["esDNI"];

            echo "<input type='text' id='esDNI' name='esDNI' value='$dni' hidden>";
            if ($dni) {
            } else {

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
        } else {
            echo "<div class='alert alert-success' role='alert'>
                <h5>Su institucion no ha definido un formato de legajo, no se podrá registrar</h5>
            </div>";
        }

        ?>

        <div class="fill_fields text-center m-auto" <?php 
                                    if($dni == null){ 
                                        echo "hidden ";} ?>>
             <label for="">Ingrese el/los datos solictados</label>
            <div class="form-row" >
                <input type="number" class="form-control" id="inputDNI" name="inputDNI" placeholder="Documento Nacional de Identidad" onchange="validarDNI()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110" required>
                <h9 class="msg" id="msjValidacionDNI"></h9>
            </div>
            <br>
            <div class="form-row" <?php 
                                    if($dni){ 
                                        echo "hidden ";} ?>>
                <input type="text" class="form-control" id="inputLegajo" name="inputLegajo" placeholder="Legajo" onchange="validarLegajo()" onkeydown="return event.keyCode !== 69 && event.keyCode !== 109 && event.keyCode !== 107 && event.keyCode !== 110">
                <h9 class="msg" id="msjValidacionLegajo"></h9>
            </div>

            
                <br>
                <button type="submit" class="btn btn-primary" id="btnRegistrarse">Registrarse</button>
           

        </div>
    </form>
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

<?php
include "../footer.html";
?>