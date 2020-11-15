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
                }
            } else {
                document.getElementById("nombreTemaAgregar").innerHTML = contenido;
                $("#nombreTemaAgregar").attr("disabled", "disabled" );
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
         
        $("#comentarioAgregar").attr("required", "required" );
        document.getElementById("nombreTemaAgregar").innerHTML = contenido;
        document.getElementById("idTemaEspecial").value = codTema;
        
       $("#nombreTemaAgregar").removeAttr("required"); 
    }
}
