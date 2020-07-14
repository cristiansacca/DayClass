cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'>Tema del día</a></li>";
    contenido += "<li class='nav-item'><input type='button' class='btn btn-secondary' value='Cerrar sesión' /></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}