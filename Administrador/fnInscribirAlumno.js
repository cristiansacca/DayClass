function validarDNIIns() {
    eval ("debugger;");
    var elem = document.getElementById('inputDNI').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";

    if (cantDigitos > 6 && cantDigitos < 9) {
        rtdo = numbers(elem);
        if (rtdo == false) {
            msg = "En el DNI sólo van números.";
        }

    } else {
        msg = "El número de DNI deben ser entre 7 y 8 números.";
    }

    changeColor('inputDNI', rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
    return rtdo;
}

function validarLegajoIns() {
    eval("debugger;");
    var elem = document.getElementById('inputLegajo').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(esDNI == 1){
    
    }else{
       var letras = document.getElementById('letras').value;
        var numeros = document.getElementById('numeros').value;
        var cantTotal = document.getElementById('cantTotal').value;
        var verifLetras = false;
        var verifNumeros = false;
        
    if(cantDigitos != cantTotal){
        if(cantDigitos < cantTotal){
            msg = "El número de Legajo debe contener más caracteres. "; 
            rtdo = false;
        }else{
            msg = "El número de Legajo debe contener menos caracteres. "; 
            rtdo = false;
        }
          
    }else{
        
        if(letras == 1){
            var cantLetras = document.getElementById('cantLetras').value;
            var soloLetras = elem.substring(0,cantLetras);
            verifLetras = letters(soloLetras);
            
        }
        
        if(numeros == 1){
            var cantNumeros = document.getElementById('cantNumeros').value;
            if(letras == 1){
                var cantLetras = document.getElementById('cantLetras').value;
                var soloNumeros = elem.substring(cantLetras,cantTotal);
                verifNumeros = numbers(soloNumeros);
                
            }else{
                var soloNumeros = elem.substring(0, cantNumeros);
                verifNumeros = numbers(soloNumeros);
                
            }
        }
        
        if(letras == 1 && verifLetras == false){
            msg = msg + " No se cumple la cantidad de letras. ";  
        }
        
        if(numeros == 1 && verifNumeros ==false){
            msg = msg + "No se cumple la cantidad de números. ";
        }
    }
        
        if(letras == 1 && numeros == 1 && verifLetras && verifNumeros){
            rtdo = true;
        }
        
        if(letras == 1 && numeros == 0 && verifLetras){
            rtdo = true;
        }
        
        if(letras == 0 && numeros == 1  && verifNumeros){
            rtdo = true;
        }
           
    }
    
    changeColor('inputLegajo',rtdo);
    setValitationMesage('msjValidacionLegajo', rtdo, msg);
    return rtdo;   
}



function validarDNIyLegajoIns(){
    eval("debugger;");
    var esDNI = document.getElementById('esDNI').value;
    var rtdo = null;
    
    if(esDNI == 1){
        var elem = document.getElementById('inputDNI').value;
        var dni = validarDNI();
        document.getElementById('inputLegajo').value = elem;
        return dni;
    }else{
        var legajo = validarLegajo();
        var dni = validarDNI();
    
    if(legajo && dni){
        var datos = {
            legajo: document.getElementById('inputLegajo').value,
            curso: document.getElementById('cursoId1').value
        }

        $.ajax({
            url:'verificarUsuario.php',
            type: 'POST',
            async: false,
            data: datos,
            success:function(datosRecibidos) {
                
                json = JSON.parse(datosRecibidos);
                //alert(datosRecibidos);
                
                switch(json){
                    case "noAsociado":
                        rtdo = true;
                        break;
                    case "siAsociado":
                        document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>El usuario ya se encuentra asociado al curso.</h5></div>";
                        rtdo = false;
                        break;
                    case "noExiste":
                       document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>Los datos ingresados no corresponden a un usuario existente.</h5></div>"; 
                        rtdo = false;
                        break;
                    case "deBaja":
                        document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>El usuario se encuentra dado de baja del sistema, reincorporar antes de asignar a un curso.</h5></div>"; 
                        rtdo = false;
                        break;
                }
            }
        })
        
    }else{
        rtdo = false;
    }
        
    }
    
    return rtdo;
    
}

function changeColor(elementID, rtdo) {
    if (rtdo == false) {
        document.getElementById(elementID).style.backgroundColor = "PeachPuff";
        document.getElementById(elementID).style.color = "Black";
    } else {
        document.getElementById(elementID).style.backgroundColor = "Azure";
        document.getElementById(elementID).style.color = "Black";
    }
}


function setValitationMesage(elementID, rtdo, msg) {
    if (rtdo == false) {
        document.getElementById(elementID).style.visibility = 'visible';
        document.getElementById(elementID).style.display = 'contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    } else {
        document.getElementById(elementID).style.visibility = 'hidden';
        document.getElementById(elementID).style.display = 'none';
    }

}

function numbers(nros) {
    var patron = /^[0-9]*$/;
    return patron.test(nros);
}



