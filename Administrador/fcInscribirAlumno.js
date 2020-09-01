function validarDNIIns() {
    eval ("debugger;");
    var elem = document.getElementById('inputDNI').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";

    if (cantDigitos > 6 && cantDigitos < 9) {
        rtdo = numbers(elem);
        if (rtdo == false) {
            msg = "En el DNI solo van números";
        }

    } else {
        msg = "El número de DNI deben ser 8 números";
    }

    changeColor('inputDNI', rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
    validar();
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
            msg = "El número de Legajo deben ser mas caracteres "; 
            rtdo = false;
        }else{
            msg = "El número de Legajo deben ser menos caracteres "; 
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
            msg = msg + " No se cumple la cantidad de Letras ";  
        }
        
        if(numeros == 1 && verifNumeros ==false){
            msg = msg + "No se cumple la cantidad de Numeros ";
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
    validar();
    return rtdo; 
    
}


function validar() {
    var v_dni = document.getElementById('inputDNI').style.backgroundColor;
    var v_legajo = document.getElementById('inputLegajo').style.backgroundColor;
    
    
    var esDNI = document.getElementById('esDNI').value;
    
    if(esDNI == 1){
        if (v_dni == "azure") {
            document.getElementById('btnCrear').disabled = false;
        } else {
            document.getElementById('btnCrear').disabled = true;
        }
    }else{
        if (v_dni == "azure" && v_legajo == "azure" ) {
            document.getElementById('btnCrear').disabled = false;
        } else {
            document.getElementById('btnCrear').disabled = true;
        }

    
    }


   
}

function validarDNIyLegajoIns(){
    eval("debugger;");
   
    var esDNI = document.getElementById('esDNI').value;
    
    if(esDNI == 1){
        var elem = document.getElementById('inputDNI').value;
        var dni = validarDNI();
        document.getElementById('inputLegajo').value = elem;
        return dni;
    }else{
        var legajo = validarLegajo();
        var dni = validarDNI();
    
    if(legajo && dni){
        return true;
    }
        return false;
    }
    
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
