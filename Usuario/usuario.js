cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += 
    "<li class='nav-item'>"+
        "<a class='nav-link' href='/DayClass/Usuario/inicioSesion.php'><i class='fa fa-home mr-1'></i>Inicio</a>"+
    "</li>";
    
    contenido += 
    "<li id='notificacionJustificativos' class='nav-item' hidden>"+
        "<a id='btnCampana' class='nav-link myPopover'><i id='iconoCampana' class='fa fa-bell fa-fw ml-n2'></i>"+
            "<div hidden id='nroNoti' class='count-container' data-region='count-container'>1</div>"+
        "</a>"+
    "</li>";
    
    contenido +=
    "<li>"+
        "<div class='dropdown'>"+
            "<button class='btn btn-primary pb-0 dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"+
                "<label id='nombreUsuarioNav'>Nombre Apellido</label><i class='fa fa-user-circle fa-lg ml-2'></i>"+
            "</button>"+
            "<div class='dropdown-menu'>"+
                "<a class='dropdown-item' href='/DayClass/Usuario/editar_perfil.php'><i class='fa fa-edit mr-1'></i>Editar perfil</a><div class='dropdown-divider'></div>"+
                "<a class='dropdown-item' href='/DayClass/logout.php'><i class='fa fa-sign-out mr-1'></i>Salir</a>"+
            "</div>"+
        "</div>"+
    "</li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

function letters(letras){
	var patron = /^[A-Za-zÑñáéíóúñüàè' ]*$/;
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

function validarEmail(){
    eval("debugger;");
    var elem = document.getElementById('inputEmailNew').value;
    var rtdo = false;
    var msg = "";
    
    rtdo = validateEmail(elem);
    
    if(rtdo == false){
            msg = "Lo que se ha escrito no es una dirección de email válida, revisar @ y .com .";    
    }
    
    changeColor('inputEmailNew',rtdo);
    setValitationMesage('msjValidacionEmail', rtdo, msg);
    return rtdo;
}

function validarContrasenia()
{
    eval("debugger;");
    var contrasenna = document.getElementById('inputPassNew').value;
    var rtdo = validar_clave(contrasenna);
    var msg = "";

    if (rtdo == true) {
        msg = 'Cotraseña fuerte';
        document.getElementById('inputPassNewRep').disabled = false;
    }
    else {
        msg = 'La contraseña ingresada no es fuerte.';
         document.getElementById('inputPassNewRep').disabled = true;
    }

    changeColor('inputPassNew', rtdo);
    setValitationMesage('msjValidacionPass', rtdo, msg);
    
}

function validarRepeticion()
{
    eval("debugger;");
    var contrasenna = document.getElementById('inputPassNewRep').value;
    var rtdo = validar_clave(contrasenna);
    var c = document.getElementById('inputPassNew').value;
    var msg = "";
    var dev = true;

    if (contrasenna != c) {
        msg = 'Las contraseñas no coinciden.';
        rtdo = false;
        dev = false;
    }
    
    if(c == ""){
        dev = true;
    }

    changeColor('inputPassNewRep', rtdo);
    setValitationMesage('msjValidacionRepeticion', rtdo, msg); 
    return dev;

    
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