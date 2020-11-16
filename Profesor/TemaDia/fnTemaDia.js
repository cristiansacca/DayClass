document.getElementById("unidadTema").onchange = function(){
    eval("debugger;");
    var nro_unidad = document.getElementById("unidadTema").value;
    var id_programa = document.getElementById("idPrograma").value;
    
    var contenido = null;
    
if(nro_unidad !== "" && nro_unidad >= 0){
    var datos = {
        nro_unidad: nro_unidad, id_programa: id_programa
    }

    $.ajax({
        url:'listarTemasUnidad.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            //alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            contenido="<option value='' selected>Tema</option>";
            if(json.length !== 0){
                for (let index = 0; index < json.length; index++) {
                    contenido += "<option value='"+json[index].id+"'>"+json[index].nombreTema+"</option>";
                    document.getElementById("nombreTema").innerHTML = contenido;
                    $("#nombreTema").removeAttr("disabled"); 
                    $("#nombreTema").attr("required", "required" );
                    $("#comentario").removeAttr("required");
                    $('#comentario').attr('placeholder','Escriba un comentario (Opcional). Máximo 40 carácteres');
                    
                }
            } else {
                document.getElementById("nombreTema").innerHTML = contenido;
                $("#nombreTema").attr("disabled", "disabled" );
                $("#nombreTema").attr("required", "required" );
                $("#comentario").removeAttr("required");
                $('#comentario').attr('placeholder','Escriba un comentario (Opcional). Máximo 40 carácteres');
            }
            
        }
    })
}else{
   var codTema = null;
        if(nro_unidad == "examen"){
            contenido="<option value='1' selected>Tema</option>";
            $("#nombreTema").attr("disabled", "disabled" );
            codTema = 1;
        }else{
            contenido="<option value='2' selected>Tema</option>";
            $("#nombreTema").attr("disabled", "disabled" );
            codTema = 2;
        }
         
        $("#comentario").attr("required", "required" );
        document.getElementById("nombreTema").innerHTML = contenido;
        document.getElementById("idTemaEspecial").value = codTema;
        $('#comentario').attr('placeholder','Escriba un comentario. Máximo 40 carácteres');
        
       $("#nombreTema").removeAttr("required");      
}
    
    
}
    