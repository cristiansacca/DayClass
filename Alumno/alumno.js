cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'>Novedades</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#' onclick='abrirModal()'>Auto-asistencia</a></li>";
    contenido += "<li class='nav-item'><input type='button' class='btn btn-secondary' value='Cerrar sesión' /></li>"
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

function abrirModal(){
    $("#staticBackdrop").modal("show");
}
