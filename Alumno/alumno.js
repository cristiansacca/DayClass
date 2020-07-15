cambiarContenidoNavbar();

function cambiarContenidoNavbar(){
    var contenido = "";
    contenido += "<li class='nav-item'><a class='nav-link' href='Index.php'>Inicio</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#'>Novedades</a></li>";
    contenido += "<li class='nav-item'><a class='nav-link' href='#' onclick='abrirModal()'>Auto-asistencia</a></li>";
    contenido += "<li class='nav-item'><input type='button' class='btn btn-secondary' value='Cerrar sesión' /></li>";
    document.getElementById("contenidoNavbar").innerHTML = contenido;
}

function abrirModal(){
    $("#staticBackdrop").modal("show");
}

$('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});

function validarLongCodIngresado(){

    var codigoIngresado = document.getElementById('inputCodigoIngresado').value;
    var rtdo = false ; 
    var msg = "";
    if (codigoIngresado.length == 0){

       msg =  "El código esta vacío" ;
        
    } else {
        if(codigoIngresado.length < 11 || codigoIngresado.length > 11){
            msg = "El código no está completo" ;
        } else {

       			 var letras = codigoIngresado.substring(0,2); 
       			 var num = codigoIngresado.substring(2,11); 

                    if(letters(letras)){
                        if(numbers(num)){
                            msg ="Código Válido";
                            rtdo= true; 
                        }else {
                            msg ="Código No Válido";
                        }
                    }else {
                        msg ="Código No Válido";
                    }
        }
  }
  setValitationMesage("msgValidacionCodigo", rtdo, msg);

}

function letters(letras){
	var patron = /^[A-Z]*$/;
	return patron.test(letras);
}

function numbers(nros){
	var patron = /^[0-9]*$/;
	return patron.test(nros);
}

function setValitationMesage(elementID, rtdo, msg){
    if(rtdo == false){
        document.getElementById(elementID).style.visibility='visible';
        document.getElementById(elementID).style.display='contents';
        document.getElementById(elementID).style.color = "Red"
        document.getElementById(elementID).innerHTML = msg;
    }else{
        document.getElementById(elementID).style.visibility='visible';
        document.getElementById(elementID).style.display='contents';
        document.getElementById(elementID).style.color = "Green"
        document.getElementById(elementID).innerHTML = msg;
    }
      
}

document.getElementById("btnCerrar").onclick = limpiarContenidoModal();

function limpiarContenidoModal(){
    document.getElementById("inputCodigoIngresado").value = "";
}