function validarDNI(){
    eval("debugger;");
    var elem = document.getElementById('inputDNI').value;
   
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantDigitos > 6 && cantDigitos < 9){
        rtdo = numbers(elem);
        
        if(rtdo){
            
        }else{
            
            msg = "En el DNI solo van números";
        }
        
    }else{
        msg = "El número de DNI deben ser 8 números";
    }
    
    changeColor('inputDNI',rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
    
    return rtdo;
    //validar();
}



function validarLegajo(){
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
    return rtdo; 
    

}

function validarNombre(){
    eval("debugger;");
    var elem = document.getElementById('inputName').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantLetras >= 3 && cantLetras < 20){
        rtdo = letters(elem);
        
        if(rtdo == false){
            msg = "En el Nombre solo van letras";  
        }
    }else{
        msg= "El nombre debe contener más de 3 y menos de 20 letras ";
        
    }
    
    changeColor('inputName', rtdo);
    setValitationMesage('msjValidacionNombre', rtdo, msg);
    validar();
}

function validarApellido(){
    var elem = document.getElementById('inputSurname').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantLetras >= 3 && cantLetras < 20){
        
        rtdo = letters(elem);
        if(rtdo == false){
            msg = "En el Apellido solo van letras";  
        }
        

    }else{
        msg = "El apellido debe contener más de 3 y menos de 20 letras "; 
    }
  
    changeColor('inputSurname',rtdo);
    setValitationMesage('msjValidacionApellido', rtdo, msg);
    validar()
    
}

function validarEmail(){
    var elem = document.getElementById('inputEmail').value;
    var rtdo = false;
    var msg = "";
    
    rtdo = validateEmail(elem);
    
    if(rtdo == false){
            msg = "Lo que se ha escrito no es una dirección de mail valida, revisar @ y .com";    
    }
    
    changeColor('inputEmail',rtdo);
    setValitationMesage('msjValidacionEmail', rtdo, msg);
    return rtdo;
    
    
    
}



function validarContrasenia()
{
    var contrasenna = document.getElementById('inputPassword4').value;
    var rtdo = validar_clave(contrasenna);
    var msg = "";

    if(rtdo == true)
    {
        msg ='Cotraseña fuerte';
    }
    else
    {
        msg = 'La contraseña ingresada no es fuerte';
    }

    changeColor('inputPassword4',rtdo);
    setValitationMesage('msjValidacionPass', rtdo, msg);
    
    return rtdo;
    
}



function validarFechaNac(){
    eval("debugger;");
    var elem = document.getElementById('inputDate').value;
    
    var rtdo = false;
    var msg = "";
    
    rtdo = validateDate(elem);
    
    if(rtdo == false){
        msg = "No es una fecha de nacimiento válida para este sistema"; 
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

function validar_clave(contrasenna)
{
    if(contrasenna.length >= 8)
    {		
        var mayuscula = false;
        var minuscula = false;
        var numero = false;
        
        
        for(var i = 0;i<contrasenna.length;i++)
        {
            if(contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90)
            {
                mayuscula = true;
            }
            else if(contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122)
            {
                minuscula = true;
            }
            else if(contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57)
            {
                numero = true;
            }
            
        }
        if(mayuscula == true && minuscula == true && numero == true)
        {
            return true;
        }
    }
    return false;
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


function valiarCampos(){
    var pass = validarContrasenia();
    var fchNac = validarFechaNac() ;
    var mail = validarEmail();
    
    if(pass && fchNac && mail){
        return true;
    }
    return false;
}

function validarDNIyLegajo(){
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


function validarRestPass(){
    var mail = validarEmail();
    var legDNI  = validarDNIyLegajo();
    
    if(mail && legDNI){
        return true;
    }else{
        return false;
    }
}
