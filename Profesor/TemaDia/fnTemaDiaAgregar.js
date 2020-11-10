document.getElementById("unidadTemaAgregar").onchange = function(){
    var nro_unidad = document.getElementById("unidadTemaAgregar").value;
    var id_programa = document.getElementById("idPrograma").value;
    
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
}