cambiarContenidoNavbar();

function cambiarContenidoNavbar() {
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='/DayClass/Administrador/index.php'><i class='fa fa-home fa-lg mr-1'></i>Inicio</a></li>";
    
    contenido += "<li class='nav-item dropdown'>";
    contenido += "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-gear fa-lg mr-1'></i>Configuraciones</a>";
    contenido += "<div class='dropdown-menu' aria-labelledby='navbarDropdown'><a class='dropdown-item' href='/DayClass/Administrador/ConfiguracionSistema/Profesores/configProf.php'>Profesores</a><div class='dropdown-divider'></div>";
    contenido += "<a class='dropdown-item' href='/DayClass/Administrador/ConfiguracionSistema/Alumnos/configAlum.php'>Alumnos</a><div class='dropdown-divider'></div><a class='dropdown-item' href='/DayClass/Administrador/ConfiguracionSistema/Administradores/configAdmin.php'>Administradores</a><div class='dropdown-divider'></div><a class='dropdown-item' href='/DayClass/Administrador/ConfiguracionSistema/Parametros/config_parametros.php'>Parametros</a></div></li>";
    
    contenido += "<li class='nav-item'><a id='btnCampana' class='nav-link myPopover'><i id='iconoCampana' class='fa fa-bell fa-fw'></i><div hidden id='nroNoti' class='count-container' data-region='count-container'>1</div></a></li>";
    
    contenido += "<li><div class='dropdown'>";
    contenido += "<button class='btn btn-primary pb-0 dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><label id='nombreUsuarioNav'>Nombre Apellido</label><i class='fa fa-user-circle fa-lg ml-2'></i></button>";
    contenido += "<div class='dropdown-menu'><a class='dropdown-item' href='/DayClass/Administrador/EditarPerfil/editarPerfilAdmin.php'><i class='fa fa-edit mr-1'></i>Editar perfil</a><div class='dropdown-divider'></div>";
    contenido += "<a class='dropdown-item' href='/DayClass/logout.php'><i class='fa fa-sign-out mr-1'></i>Salir</a></div></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

window.onload = function(){
    $.ajax({
        url: '/DayClass/Administrador/Justificativos/buscarJustificativos.php',
        type: 'POST',
        success: function(datosRecibidos) {
            //alert(datosRecibidos);
            if(datosRecibidos!==0){
                //alert("Entra al if");
                $('.myPopover').popover({
                    placement: 'bottom',
                    title: 'Justificativos',
                    html: true,
                    content: '<a href="/DayClass/Administrador/Justificativos/validar_justificativos.php">Hay justificativos pendientes de revisión</a>'
                });
                document.getElementById("nroNoti").innerHTML = datosRecibidos;
                $('#nroNoti').removeAttr("hidden");
            } else {
                $('.myPopover').popover({
                    //trigger: 'focus',
                    placement: 'bottom',
                    title: 'Justificativos',
                    html: true,
                    content: 'No hay justificativos pendientes de revisión.'
                });
            }           
        }
    })
}

document.getElementById("btnCampana").onclick = function(){
    $("#nroNoti").attr("hidden", "hidden" );
    document.getElementById("nroNoti").innerHTML = 0;
}

function letters(letras) {
    var patron = /^[A-Za-zÑñ ]*$/;
    return patron.test(letras);
}

function numbers(nros) {
    var patron = /^[0-9]*$/;
    return patron.test(nros);
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validarEmail() {
    eval("debugger;");
    var elem = document.getElementById('inputEmailNew').value;
    var rtdo = false;
    var msg = "";

    rtdo = validateEmail(elem);

    if (rtdo == false) {
        msg = "Lo que se ha escrito no es una dirección de mail valida, revisar @ y .com";
    }

    changeColor('inputEmailNew', rtdo);
    setValitationMesage('msjValidacionEmail', rtdo, msg);
    return rtdo;
}

function validarContrasenia() {
    eval("debugger;");
    var contrasenna = document.getElementById('inputPassNew').value;
    var rtdo = validar_clave(contrasenna);
    var msg = "";

    if (rtdo == true) {
        msg = 'Cotraseña fuerte';
        document.getElementById('inputPassNewRep').disabled = false;
    }
    else {
        msg = 'La contraseña ingresada no es fuerte';
        document.getElementById('inputPassNewRep').disabled = true;
    }

    changeColor('inputPassNew', rtdo);
    setValitationMesage('msjValidacionPass', rtdo, msg);
    return rtdo;

}

function validarRepeticion() {
    var contrasenna = document.getElementById('inputPassNewRep').value;
    var rtdo = validar_clave(contrasenna);
    var c = document.getElementById('inputPassNew').value;
    var msg = "";
    var dev = true;

    if (contrasenna != c) {
        msg = 'Las Cotraseñas no coinciden';
        dev = false;
    }

    if (c == "") {
        dev = true;
    }

    changeColor('inputPassNewRep', rtdo);
    setValitationMesage('msjValidacionRepeticion', rtdo, msg);
    return dev;

}

function validar_clave(contrasenna) {
    if (contrasenna.length >= 8) {
        var mayuscula = false;
        var minuscula = false;
        var numero = false;


        for (var i = 0; i < contrasenna.length; i++) {
            if (contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90) {
                mayuscula = true;
            }
            else if (contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122) {
                minuscula = true;
            }
            else if (contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57) {
                numero = true;
            }

        }
        if (mayuscula == true && minuscula == true && numero == true) {
            return true;
        }
    }
    return false;
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

function setEstado(estado) {
    eval("debugger;");

    if (estado == "Validado") {

        document.getElementById('estadoBtn').innerHTML = "Aprobado";

    } else if (estado == "Denegado") {
        document.getElementById('estadoBtn').innerHTML = "Denegado";
    }
}

/*Para importar lista de profesores y alumnos*/
function comprobar() {
    eval("debugger;");
    var elem = document.getElementById('inpGetFile').value;
    if (elem == "") {
        alert("No esta cargado el documento");
    } else {
        document.getElementById('btnImportFile').disabled = false;
    }
}

$('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

/*Para importar lista de alumnos*/
function comprobarLista() {
    eval("debugger;");
    var elem = document.getElementById('inpGetFile').value;
    if (elem == "") {
        alert("No esta cargado el documento");
    } else {
        document.getElementById('btnImportar').disabled = false;
    }
}

//funciones para validar nombre, apellido, legajo y DNI de alumno y profesor, usan las funciones letters, numbers, changeColor y setValidationMessage
function validarDNI() {
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
    return rtdo;
}

function validarLegajo() {
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

function validarNombre() {
    eval("debugger;");
    var elem = document.getElementById('inputName').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";

    if (cantLetras >= 3 && cantLetras < 20) {
        rtdo = letters(elem);

        if (rtdo == false) {
            msg = "En el Nombre solo van letras";
        }
    } else {
        msg = "El nombre debe contener más de 3 y menos de 20 letras ";

    }

    changeColor('inputName', rtdo);
    setValitationMesage('msjValidacionNombre', rtdo, msg);
    return rtdo;
}

function validarApellido() {
    var elem = document.getElementById('inputSurname').value;
    var cantLetras = elem.length;
    var rtdo = false;
    var msg = "";

    if (cantLetras >= 3 && cantLetras < 20) {

        rtdo = letters(elem);
        if (rtdo == false) {
            msg = "En el Apellido solo van letras";
        }


    } else {
        msg = "El apellido debe contener más de 3 y menos de 20 letras ";
    }

    changeColor('inputSurname', rtdo);
    setValitationMesage('msjValidacionApellido', rtdo, msg);
    return rtdo;

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


//para elimiar registros, la usan config_admin, config_alumno y config_profesor

function confirmDelete() {
    var confirmar = confirm("¿Realmente desea eliminarlo? ");
    if (confirmar) {
        return true;
    } else {
        return false;
    }
}

function confirmComeBack() {
    var confirmar = confirm("¿Realmente desea reincorporarlo? ");
    if (confirmar) {
        return true;
    } else {
        return false;
    }
}


function habilitarSegundaFecha() {
    eval("debugger;");
    var fchDesde = document.getElementById('inputInicioCursado').value;
    var fchHoy = document.getElementById('todayDate').value;
    
    if(fchDesde < fchHoy){
       document.getElementById('inputFinCursado').value = fchHoy;
        document.getElementById('inputFinCursado').min = fchHoy; 
    }else{
        document.getElementById('inputFinCursado').value = fchDesde;
        document.getElementById('inputFinCursado').min = fchDesde; 
    }
    
    
    document.getElementById('inputFinCursado').disabled = false;
    document.getElementById('inputFinCursado').readonly = false;

}