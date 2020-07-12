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
}

function validarLegajo() {
    var elem = document.getElementById('inputLegajo').value;
    var cantDigitos = elem.length;
    var rtdo = false;
    
    if(cantDigitos == 5){
        rtdo = numbers(elem);
        if(rtdo == false){
            alert("En el Legajo solo van números");  
        }
        changeColor('inputLegajo',rtdo);
        
       }else{
           alert("El número de Legajo deben ser 5 números");
           changeColor('inputLegajo',rtdo);
       }
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
        msg= "El nombre debe contener mas de 3 y menos de 20 letras ";
        
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
        msg = "El apellido debe contener mas de 3 y menos de 20 letras ";
    }
  
    changeColor('inputSurname',rtdo);
    setValitationMesage('msjValidacionApellido', rtdo, msg);
    
}

function validarEmail(){
    var elem = document.getElementById('inputEmail').value;
    var rtdo = false;
    
    rtdo = validateEmail(elem);
    alert(rtdo);
    if(rtdo == false){
            alert("Lo que se ha escrito no es una direccion de mail valida falta el @");  
        }
    changeColor('inputEmail',rtdo);
}

function validarFechaNac(){
    var elem = document.getElementById('inputDate').value;
    var date = new Date(elem);
    var dateYear = date.getFullYear();
    var rtdo = false;
    
    var today = new Date();
    var todayYear = today.getFullYear();
    
    if(dateYear < todayYear-4){
        rtdo = true;
    }else{
        alert("No es una fecha de nacimeinto valida para este sistema");  
    }
    
    changeColor('inputDate',rtdo);
    
}


function letters(letras){
	var patron = /^[A-Za-z]*$/;
	return patron.test(letras);
}

function numbers(nros){
	var patron = /^[0-9]*$/;
	return patron.test(nros);
}

function passvalidation(pass){
    var patron = /^[A-Za-z0-9]*$/;
    return patron.test(pass);
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
        document.getElementById(elementID).style.display='show';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    }else{
        document.getElementById(elementID).style.visibility='hidden';
        document.getElementById(elementID).style.display='none';
    }
    
    
}