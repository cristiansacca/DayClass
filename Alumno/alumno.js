
cambiarContenidoNavbar();

function cambiarContenidoNavbar() {
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'>Novedades</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#' onclick='abrirModal()'>Auto-asistencia</a></li>";
    contenido += "<li class='nav-item'><button class='btn btn-danger' id='btnSalir'><i class='fa fa-sign-out'></i>Salir</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

//El botón salir vuelve al Login
document.getElementById("btnSalir").onclick = function () {
    location.href = "/DayClass/Index.php";
}

function abrirModal() {
    $("#staticBackdrop").modal("show");
}

//Si se cierra el popup de Auto-asistencia se borra el codigo escrito
document.getElementById("btnCerrar").onclick = function () {
    document.getElementById("inputCodigoIngresado").value = "";
}

$(".custom-file-input").on("change", function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
});

function validarLongCodIngresado() {
    eval("debugger;");
    var codigoIngresado = document.getElementById('inputCodigoIngresado').value;
    var rtdo = false;
    var msg = "";
    if (codigoIngresado.length == 0) {

        msg = "El código esta vacío";

    } else {
        if (codigoIngresado.length < 11 || codigoIngresado.length > 11) {
            msg = "El código no está completo";
        } else {

            var letras = codigoIngresado.substring(0, 2);
            var num = codigoIngresado.substring(2, 11);

            if (letters(letras)) {
                if (numbers(num)) {
                    msg = "Código Válido";
                    rtdo = true;
                } else {
                    msg = "Código No Válido";
                }
            } else {
                msg = "Código No Válido";
            }
        }
    }
    setValitationMesageAutoAsist("msgValidacionCodigo", rtdo, msg);

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
    var elem = document.getElementById('inputEmailNew').value;
    var rtdo = false;
    var msg = "";

    rtdo = validateEmail(elem);

    if (rtdo == false) {
        msg = "Lo que se ha escrito no es una dirección de mail valida, revisar @ y .com";
    }

    changeColor('inputEmail', rtdo);
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

function setValitationMesageAutoAsist(elementID, rtdo, msg) {
    if (rtdo == false) {
        document.getElementById(elementID).style.visibility = 'visible';
        document.getElementById(elementID).style.display = 'contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    } else {
        document.getElementById(elementID).style.visibility = 'visible';
        document.getElementById(elementID).style.display = 'contents';
        document.getElementById(elementID).style.color = "Green"
        document.getElementById(elementID).innerHTML = msg;
    }

}

function validarFechasJustificativo(){
    let desde = document.getElementById("fechaDesde").value;
    let hasta = document.getElementById("fechaHasta").value;
    if(desde!=""&&hasta!=""){
        if(desde>hasta){
            setValitationMesage("msgDesde",false,"El periodo no es válido");
            setValitationMesage("msgHasta",false,"El periodo no es válido");
            return false;
        }
        else{
            setValitationMesage("msgDesde",true,"");
            setValitationMesage("msgHasta",true,"");
            return true;
        }
    }else{
        return false;
    }
}

function validar_checkbox() {
    let cont = document.getElementsByName("materia");
    let i = 0;
    let al_menos_uno = false;
    while (i < cont.length) {
        // Verifica si esta checked
        if (cont[i].checked) {
            al_menos_uno = true;
        }
        i++
    }
    if(!al_menos_uno){
        setValitationMesage("msgMaterias",false,"Seleccione al menos una materia");
    }else{
        setValitationMesage("msgMaterias",true,"");
    }
    return al_menos_uno;
}

function validarCampos(){
    if(validarFechasJustificativo() && validar_checkbox()){
        return true;
    }
    else{
        return false;
    }
}