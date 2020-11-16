function validarDNI(){
    var elem = document.getElementById('inputDNI').value;
   
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantDigitos > 6 && cantDigitos < 9){
        rtdo = numbers(elem);
        
        if(rtdo){
            
        }else{
            
            msg = "En el DNI sólo van números.";
        }
        
    }else{
        msg = "El DNI debe ser de más de 7 números.";
    }
    
    changeColor('inputDNI',rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
    
    return rtdo;
    //validar();
}



function validarLegajo(){
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

function validarNombre(){
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
            msg = "En el Apellido sólo van letras.";  
        }
        

    }else{
        msg = "El Apellido debe contener más de 3 y menos de 20 letras. "; 
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
            msg = "Lo que se ha escrito no es una dirección de email válida, revisar @ y .com .";
            return false;
            
    }else{
    
        var datos = {
            eMail: elem
        }

        $.ajax({
            url:'buscarMail.php',
            type: 'POST',
            async: false,
            data: datos,
            success:function(datosRecibidos) {
                json = JSON.parse(datosRecibidos);
                rtdo =json;
                if(json){
  
                }else{
                    msg = "Esa dirección de correo electrónico ya se encuentra registrada.";  
                    
                }
            }
        })
    
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
        msg ='Contraseña fuerte.';
    }
    else
    {
        msg = 'La contraseña ingresada no es fuerte.';
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
    var passRep = validarRepeticion();
    
    if(pass && fchNac && mail && passRep){
        document.getElementById('btnRegistrarse').innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registrando...';
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

function validarRepeticion() {
    eval("debugger;");
    var contrasenna = document.getElementById('inputPassword4').value;
    var c = document.getElementById('inputPassNew').value;
    var rtdo = validar_clave(c);
    var msg = "";
    var dev = true;

    if (contrasenna != c) {
        msg = 'Las contraseñas no coinciden.';
        rtdo = false;
        dev = false;
    }
    
    changeColor('inputPassNew', rtdo);
    setValitationMesage('msjValidacionRepeticion', rtdo, msg); 
    return dev;

}

function validarRestPass(){
    var mail = validarEmail();
    var legDNI  = validarDNIyLegajo();
    
    if(mail && legDNI){
        var contenido = "<span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span>Cargando...";
        document.getElementById("btnSpinner").innerHTML = contenido;
        return true;
    }else{
        return false;
    }
}

