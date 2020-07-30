
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
    location.href = "/DayClass/logout.php";
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
    }else {
        alert("Seleccione una opción por favor");
    }

}

document.getElementById("btnaceptar").onclick = function(){
    var elem = document.getElementById("modalidadseleccionado").value;

    if (elem == "Seleccione una modalidad") {
        
        alert("Por favor seleccione una modalidad");
    } else {
        location.href = "/DayClass/Administrador/validar_justificativos.php";
    }
}
/*Para importar lista de profesores y alumnos*/
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
function comprobarLista(){
    eval("debugger;");
    var elem = document.getElementById('inpGetFile').value;
        if(elem == ""){
            alert("No esta cargado el documento");
        }else{
            document.getElementById('btnImportar').disabled = false;
        }
}

document.getElementById("btnconfirmarestadistica").onclick = function() {
    eval("debugger;");
    var elem = document.estadisticaadmin.tipo1.value;

    if (elem == "curso") {
        location.href = "/DayClass/Administrador/estadistica_curso.php";
    }
    else if (elem == "materia") {
        location.href = "/DayClass/Administrador/estadistica_materia.php";
    }else {
        alert("Seleccione una opción por favor");
    }

}


//funciones para validar nombre, apellido, legajo y DNI de alumno y porfeso usan las funciones letters, numbers, changeColor y setValidationMessage
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
    validar();
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
    validar();
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

function validar(){
    var v_dni = document.getElementById('inputDNI').style.backgroundColor;
    var v_legajo = document.getElementById('inputLegajo').style.backgroundColor;
    var v_name = document.getElementById('inputName').style.backgroundColor;
    var v_surname = document.getElementById('inputSurname').style.backgroundColor;
    
    
    if(v_dni == "azure" && v_legajo == "azure" && v_name == "azure" && v_surname =="azure"){
       document.getElementById('btnCrear').disabled=false; 
    }else{
        document.getElementById('btnCrear').disabled=true;  
    }
         
}