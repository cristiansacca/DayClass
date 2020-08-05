
cambiarContenidoNavbar();

function cambiarContenidoNavbar() {
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'><i class='fa fa-home fa-lg mr-1'></i>Inicio</a></li>";
    /*contenido += "<li class='nav-item'><a class='nav-link' href='#'><i class='fa fa-bell mr-1'></i>Novedades</a></li>";*/
    contenido += "<li class='nav-item'><a class='nav-link' href='#' onclick='abrirModal()'><i class='fa fa-check-square mr-1'></i>Auto-asistencia</a></li>";
    contenido += "<li class='nav-item'><button class='btn btn-danger' id='btnSalir'><i class='fa fa-sign-out mr-1'></i>Salir</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

//El botón salir vuelve al Login
document.getElementById("btnSalir").onclick = function () {
    location.href = "/DayClass/logout.php";
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
        msg = "Lo que se ha escrito no es una dirección de mail valida, revisar @ , .com y espacio al final";
    }

    changeColor('inputEmail', rtdo);
    setValitationMesage('msjValidacionEmail', rtdo, msg);
}

function validarContrasenia(){
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

}

function validarRepeticion() {
    eval("debugger;");
    var contrasenna = document.getElementById('inputPassNewRep').value;
    var rtdo = validar_clave(contrasenna);
    var c = document.getElementById('inputPassNew').value;
    var msg = "";
    var dev = true;

    if (contrasenna != c) {
        msg = 'Las Cotraseñas no coinciden';
        dev = false;
    }
    
    if(c == ""){
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
    let cont = document.getElementsByClassName("checkMateria");
    let al_menos_uno = false;
    
    for (let index = 0; index < cont.length; index++) {
        if (cont[index].checked) {
            al_menos_uno = true;
        }   
    }
    if(desde!=""&&hasta!=""){
        if(desde>hasta){
            setValitationMesage("msgDesde",false,"El periodo no es válido");
            setValitationMesage("msgHasta",false,"El periodo no es válido");
            $("#btnCargar").attr("disabled", "disabled" );
        }
        else{
            setValitationMesage("msgDesde",true,"");
            setValitationMesage("msgHasta",true,"");
            if(al_menos_uno){
                $("#btnCargar").removeAttr("disabled");
            }
        }
    }
}

function validar_checkbox() {
    let desde = document.getElementById("fechaDesde").value;
    let hasta = document.getElementById("fechaHasta").value;
    let cont = document.getElementsByClassName("checkMateria");
    let al_menos_uno = false;
    
    for (let index = 0; index < cont.length; index++) {
        if (cont[index].checked) {
            al_menos_uno = true;
        }   
    }

    if(!al_menos_uno){
        setValitationMesage("msgMaterias",false,"Seleccione al menos una materia");
        $("#btnCargar").attr("disabled", "disabled" );
    }else{
        setValitationMesage("msgMaterias",true,"");
        if(desde!=""&&hasta!=""){
            if(desde<=hasta){
                $("#btnCargar").removeAttr("disabled");  
            }
        }
    }
}

function validarCampos(){
    eval("debugger;");
    let check = validar_checkbox();
    let just = validarFechasJustificativo();
    if(check==true && just==true){
        return true;
    }
    else{
        return false;
    }
}