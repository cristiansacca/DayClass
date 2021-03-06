document.getElementById("unidadTemaAgregar").onchange = function(){
    eval("debugger;");
    var nro_unidad = document.getElementById("unidadTemaAgregar").value;
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
                    document.getElementById("nombreTemaAgregar").innerHTML = contenido;
                    $("#nombreTemaAgregar").removeAttr("disabled"); 
                    $("#nombreTemaAgregar").attr("required", "required" );
                    $("#comentarioAgregar").removeAttr("required");
                    $('#comentarioAgregar').attr('placeholder','Escriba un comentario. (Opcional) Máximo 40 carácteres');
                }
            } else {
                document.getElementById("nombreTemaAgregar").innerHTML = contenido;
                $("#nombreTemaAgregar").attr("disabled", "disabled" );
                $("#nombreTemaAgregar").attr("required", "required" );
                $("#comentarioAgregar").removeAttr("required");
                $('#comentarioAgregar').attr('placeholder','Escriba un comentario. (Opcional) Máximo 40 carácteres');
            }
            
        }
    })
        
    }else{
        var codTema = null;
        if(nro_unidad == "examen"){
            contenido="<option value='1' selected>Tema</option>";
            codTema = 1;
        }else{
            contenido="<option value='2' selected>Tema</option>";
            codTema = 2;
        }
        
        $("#nombreTemaAgregar").attr("disabled", "disabled" );
         
        $("#comentarioAgregar").attr("required", "required" );
        $('#comentarioAgregar').attr('placeholder','Escriba un comentario. Máximo 40 carácteres');
        document.getElementById("nombreTemaAgregar").innerHTML = contenido;
        document.getElementById("idTemaEspecialCrear").value = codTema;
       $("#nombreTemaAgregar").removeAttr("required"); 
    }
}
