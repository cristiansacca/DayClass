function validarDNIA(){
    var elem = document.getElementById('inputDNI').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantDigitos > 6 && cantDigitos < 9){
        rtdo = numbers(elem);
        if(rtdo == false){
            msg = "En el DNI sólo van números.";
        }
        
    }else{
        msg = "El número de DNI debe contener más de 7 números.";
    }
    
    changeColor('inputDNI',rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
    return rtdo;
    
}

function validarLegajoA() {
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
            msg = "El número de Legajo debe ser de más caracteres. "; 
            rtdo = false;
        }else{
            msg = "El número de Legajo debe ser de menos caracteres. "; 
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

function validarNombreA(){
    eval("debugger;");
    var elem = document.getElementById('inputName').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantLetras >= 3 && cantLetras < 20){
        rtdo = letters(elem);
        
        if(rtdo == false){
            msg = "En el Nombre sólo van letras.";  
        }
    }else{
        msg= "El Nombre debe contener más de 3 y menos de 20 letras. ";
        
    }
    
    changeColor('inputName', rtdo);
    setValitationMesage('msjValidacionNombre', rtdo, msg);
    return rtdo;
}

function validarApellidoA(){
    var elem = document.getElementById('inputSurname').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantLetras >= 3 && cantLetras < 20){
        
        rtdo = letters(elem);
        if(rtdo == false){
            msg = "En el Apellido sólo van letras.";  
        }
        

    }else{
        msg = "El Apellido debe contener más de 3 y menos de 20 letras. "; 
    }
  
    changeColor('inputSurname',rtdo);
    setValitationMesage('msjValidacionApellido', rtdo, msg);
    return rtdo;
    
}

function validarEmailA(){
    var elem = document.getElementById('inputEmail').value;
    var rtdo = false;
    var msg = "";
    
    rtdo = validateEmail(elem);
    
    if(rtdo == false){
            msg = "Lo que se ha escrito no es una dirección de email válida, revisar @ y .com .";    
    }
    
    changeColor('inputEmail',rtdo);
    setValitationMesage('msjValidacionEmail', rtdo, msg);
    return rtdo;
}


function validarFechaNacA(){
    eval("debugger;");
    var elem = document.getElementById('inputDate').value;
    
    var rtdo = false;
    var msg = "";
    
    rtdo = validateDate(elem);
    
    if(rtdo == false){
        msg = "No es una fecha de nacimiento válida para este sistema."; 
    }
   
    
    changeColor('inputDate',rtdo);
    setValitationMesage('msjValidacionFchNac', rtdo, msg);
    return rtdo;
    
}

function validateDate(fecha){
    var rtdo = false;
    var date = new Date(fecha);
    var dateYear = date.getFullYear();
    
    var today = new Date();
    var todayYear = today.getFullYear();
    
    
    if(dateYear < todayYear-4){
        rtdo = true;
    }
    
    return rtdo;
}

function letters(letras){
	var patron = /^[A-Za-zÑñ ]*$/;
	return patron.test(letras);
}

function numbers(nros){
	var patron = /^[0-9]*$/;
	return patron.test(nros);
}

function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}



function changeColor(elementID, rtdo){
    if(rtdo == false){
            document.getElementById(elementID).style.backgroundColor = "PeachPuff";
            document.getElementById(elementID).style.color = "Black";
        }else{
            document.getElementById(elementID).style.backgroundColor = "Azure";  
            document.getElementById(elementID).style.color = "Black";
        }
}


function setValitationMesage(elementID, rtdo, msg){
    if(rtdo == false){
        document.getElementById(elementID).style.visibility='visible';
        document.getElementById(elementID).style.display='contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    }else{
        document.getElementById(elementID).style.visibility='hidden';
        document.getElementById(elementID).style.display='none';
    }
      
}

function validarA(){
    eval("debugger;");
    var v_dni = validarDNIA();
    var v_legajo = validarLegajoA();
    var v_name = validarNombreA();
    var v_surname = validarApellidoA();
    var v_mail = validarEmailA();
    var v_fchNac = validarFechaNacA();
    
    var esDNI = document.getElementById('esDNI').value;
    
    if(esDNI == 1){
        if (v_dni && v_name && v_surname && v_mail && v_pass && v_fchNac) {
            var dni = document.getElementById('inputDNI').value;
            document.getElementById('inputLegajo').value = dni;
            var contenido = "<span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Cargando...";
            document.getElementById("btnSpinner").innerHTML = contenido;
            return true;
        }else{
            return false;
        }
    }else{
        if(v_dni && v_name && v_surname && v_mail && v_pass && v_fchNac && v_legajo) {
            var contenido = "<span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Cargando...";
            document.getElementById("btnSpinner").innerHTML = contenido;
            return true;
        } else {
           return false;
        }

    
    }
}



