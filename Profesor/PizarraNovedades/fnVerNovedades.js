function setearPublicacion(id){
    var datosEntrada = {
        idPublicacion: id
    }
    $.ajax({
        url:'/DayClass/Profesor/PizarraNovedades/buscarMensaje.php',
        type: 'POST',
        data: datosEntrada,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            document.getElementById('verAsunto').value = json.asunto;
            document.getElementById('verMensaje').value = json.mensaje;
        }
    });
}

function limpiarModal(){
    document.getElementById('verAsunto').value = "";
    document.getElementById('verMensaje').value = "";
}