cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'>Tema del día</a></li>";
    contenido += "<li class='nav-item'><button class='btn btn-danger' id='btnSalir'><i class='fa fa-sign-out'></i>Salir</button></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

//El botón salir vuelve al Login
document.getElementById("btnSalir").onclick = function(){
    location.href="/DayClass/Index.php";
}

function generarCodigo(){
    eval("debugger;");
    var nroAleatorio = randomInt();
    var cadenaAleatoria = randomString();
    
    var codigoGenerado = cadenaAleatoria + nroAleatorio;
    
    var grupo1 = codigoGenerado.substring(0,2);
    var grupo2 = codigoGenerado.substring(2,5);
    var grupo3 = codigoGenerado.substring(5,8);
    var grupo4 = codigoGenerado.substring(8,11);
    
    while(grupo4.length < 3){
        grupo4 = grupo4 + "0";
    }

    var codigoMostrar = grupo1 + " " +grupo2 + " " + grupo3 + " " + grupo4;

    document.getElementById('outCodigoAutoasist').value = codigoMostrar;
}

function randomInt() {
  return Math.floor(Math.random() * 1000000000);
}

function randomString() { 
  var len = 2;
  charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  var randomString = ''; 
  for (var i = 0; i < len; i++) { 
    var randomPoz = Math.floor(Math.random() * charSet.length); 
    randomString += charSet.substring(randomPoz,randomPoz+1); 
  } 
 return randomString; 
}