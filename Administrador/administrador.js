
cambiarContenidoNavbar();

function cambiarContenidoNavbar() {
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><li class='nav-item dropdown'>";
    contenido += "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Configuraciones</a>";
    contenido += "<div class='dropdown-menu' aria-labelledby='navbarDropdown'><a class='dropdown-item' href='config_profesores.php'>Profesores</a><div class='dropdown-divider'></div>";
    contenido += "<a class='dropdown-item' href='config_alumno.php'>Alumnos</a><div class='dropdown-divider'></div><a class='dropdown-item' href='config_parametros.php'>Parametros</a></div></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'><i class='fa fa-bell'></i></a></li>";
    contenido += "<li class='nav-item'><button class='btn btn-danger' id='btnSalir'><i class='fa fa-sign-out'></i>Salir</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

//El botón salir vuelve al Login
document.getElementById("btnSalir").onclick = function () {
    location.href = "/DayClass/Index.php";
}

function letters(letras) {
    var patron = /^[A-Za-z]*$/;
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
}

function validarContrasenia() {
    var contrasenna = document.getElementById('inputPassNew').value;
    var rtdo = validar_clave(contrasenna);
    var msg = "";

    if (rtdo == true) {
        msg = 'Cotraseña fuerte';
    }
    else {
        msg = 'La contraseña ingresada no es fuerte';
    }

    changeColor('inputPassNew', rtdo);
    setValitationMesage('msjValidacionPass', rtdo, msg);

}

function validarRepeticion() {
    var contrasenna = document.getElementById('inputPassNewRep').value;
    var rtdo = validar_clave(contrasenna);
    var c = document.getElementById('inputPassNew').value;
    var msg = "";

    if (rtdo != c) {
        msg = 'Cotraseña no coincide';
    }

    changeColor('inputPassNewRep', rtdo);
    setValitationMesage('msjValidacionRepeticion', rtdo, msg);

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

    if (estado == "Validado"){

        document.getElementById('estadoBtn').innerHTML = "Aprobado" ;

    } else if( estado == "Denegado"){
        document.getElementById('estadoBtn').innerHTML = "Denegado" ;
    }
}

document.getElementById("btnconfirmar").onclick = function() {
    var elem = document.reporteadmin.tipo.value;

    if (elem == "curso") {
        location.href = "/DayClass/Administrador/reporte_curso.php";
    }
    else if (elem == "alumno") {
        location.href = "/DayClass/Administrador/reporte_alumno.php";
    }

}

document.getElementById("btnaceptar").onclick = function(){
    var elem = document.getElementById("cursoseleccionado").value;

    if (elem == "Seleccione un curso") {
        
        alert("Por favor seleccione un curso");
    } else {
        location.href = "/DayClass/Administrador/validar_justificativos.php";
    }
}
/*Para importar lista de profesores*/
function comprobar(){
    eval("debugger;");
    var elem = document.getElementById('inpGetFile').value;
        if(elem == ""){
            alert("No esta cargado el documento");
        }else{
            document.getElementById('btnImportFile').disabled = false;
        }
}

$('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});

/*Para importar lista de alumnos*/
function comprobarListaAlumnos(){
    eval("debugger;");
    var elem = document.getElementById('inpGetFil').value;
        if(elem == ""){
            alert("No esta cargado el documento");
        }else{
            document.getElementById('btnImportFile').disabled = false;
        }
}