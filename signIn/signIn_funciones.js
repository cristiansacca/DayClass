cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += "<li class='nav-item'><button class='btn btn-primary' id='btnVolver'><i class='fa fa-arrow-circle-left mx-1'></i>Volver</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

document.getElementById("btnVolver").onclick=function(){
    location.href="/DayClass/Index.php"
}

function validarDNI() {
    var elem = document.getElementById('inputDNI').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantDigitos > 6 && cantDigitos < 9){
        rtdo = numbers(elem);
        if(rtdo == false){
            msg = "En el DNI solo van números";
        }
        
    }else{
        msg = "El número de DNI deben ser 8 números";
    }
    
    changeColor('inputDNI',rtdo);
    setValitationMesage('msjValidacionDNI', rtdo, msg);
}

function validarLegajo() {
    var elem = document.getElementById('inputLegajo').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    var msg = "";
    
    if(cantDigitos == 5){
        rtdo = numbers(elem);
        if(rtdo == false){
            msg = "En el Legajo solo van números";  
        }
        
       }else{
           msg = "El número de Legajo deben ser 5 números";
       }
    
    changeColor('inputLegajo',rtdo);
    setValitationMesage('msjValidacionLegajo', rtdo, msg);
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
    
}



function validarFechaNac(){
    var elem = document.getElementById('inputDate').value;
    var date = new Date(elem);
    var dateYear = date.getFullYear();
    var rtdo = false;
    var msg = "";
    
    var today = new Date();
    var todayYear = today.getFullYear();
    
    if(dateYear < todayYear-4){
        rtdo = true;
    }else{
        msg = "No es una fecha de nacimiento válida para este sistema";  
    }
    
    changeColor('inputDate',rtdo);
    setValitationMesage('msjValidacionFchNac', rtdo, msg);
    
}


function letters(letras){
	var patron = /^[A-Za-z]*$/;
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