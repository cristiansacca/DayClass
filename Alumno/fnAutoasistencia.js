document.getElementById("btnVerificarCodIngresado").onclick = function(){
    var codigo = document.getElementById("inputCodigoIngresado").value; 
    
    if(validarLongCodIngresado()){
    var datos = {
        codigo: codigo
    }

    $.ajax({
        url:'/DayClass/Alumno/ingresarCodigoAutoasist.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
             //alert (datosRecibidos);
            json = JSON.parse(datosRecibidos);
           
            if(json.length !== 0){
                var resultado = json[0];
                var resultado2 = resultado[0];
                
                switch(resultado2){
                    case "noExiste":
                        document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>El código ingresado no existe.</h5></div>";
                        break;
                    case "noInscripto":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Se ingresó un código para un curso en el que no está inscripto.</h5></div>";
                        break;
                    case "alumnoLibre":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Actualmente se encuentra libre en este curso. No se puede registrar su presente.</h5></div>";
                        break;
                    case "exito":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-success alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Código de asistencia ingresado correctamente. Se ha registrado su presente.</div>";
                        break;
                    case "falloCarga":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Falla al cargar el código. Consulte con el administrador.</h5></div>";
                        break;
                    case "noVigente":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>El código ingresado ya no se encuentra vigente.</h5></div>";
                        break;
                    case "yaPresente":
                        document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Ya se encuentra presente en el curso.</h5></div>";
                        break;
                    default:
                        break;
                }   
            }else {
                alert("entra al else");
            }
            
        }
    })
    }
}

function validarLongCodIngresado() {
    eval("debugger;");
    var codigoIngresado = document.getElementById('inputCodigoIngresado').value;
    var rtdo = false;
    var msg = "";
    
    var dev = false;
    if (codigoIngresado.length == 0) {

        msg = "El código está vacío.";

    } else {
        if (codigoIngresado.length < 11 || codigoIngresado.length > 11){
            
            if(codigoIngresado.length < 11){
               document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger'><h5><i class='fa fa-exclamation-circle mr-2'></i>Faltan caracteres para ser un código válido.</h5></div>";  
            }else{
                document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger'><h5><i class='fa fa-exclamation-circle mr-2'></i>Sobran caracteres para ser un código válido.</h5></div>";  
                
            }
        } else {

            var letras = codigoIngresado.substring(0, 2);
            var num = codigoIngresado.substring(2, 11);

            if (letters(letras)) {
                if (numbers(num)) {
                    rtdo = true;
                    dev = true;
                } else {
                    document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger'><h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la cantidad de letras.</h5></div>";  
                }
            } else {
                document.getElementById("resultadoMostrar").innerHTML ="<div class='alert alert-danger'><h5><i class='fa fa-exclamation-circle mr-2'></i>Error en la cantidad de números.</h5></div>";  
            }
        }
    }
    
    return dev;
}

function letters(letras) {
    var patron = /^[A-Z]*$/;
    return patron.test(letras);
}

function numbers(nros) {
    var patron = /^[0-9]*$/;
    return patron.test(nros);
}

function borrarDatos(){
    document.getElementById("inputCodigoIngresado").value = ""; 
    document.getElementById("resultadoMostrar").innerHTML = "";
}