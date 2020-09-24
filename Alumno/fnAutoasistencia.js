document.getElementById("btnVerificarCodIngresado").onclick = function(){
    var codigo = document.getElementById("inputCodigoIngresado").value; 
    var datos = {
        codigo: codigo
    }

    $.ajax({
        url:'/DayClass/Alumno/ingresarCodigoAutoasist.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            
            if(json.length !== 0){
                var resultado = json[0];
                var resultado2 = resultado[0];
                
                switch(resultado2){
                    case "noExiste":
                        document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>El código ingresado no existe.</h5><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        break;
                    default:
                        break;
                }   
            }else {
                alert("entra al else");
            }
            
        }
    })
}