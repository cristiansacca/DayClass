document.getElementById("materia").onchange = function(){
    eval("debugger;");
    
    contenido="<option selected>Curso</option>";
    document.getElementById("curso").innerHTML = contenido;
    $("#curso").attr("disabled", "disabled" );
    
    var id_materia = document.getElementById("materia").value;
    var datos = {
        id_materia: id_materia
    }

    $.ajax({
        url:'listarCursos.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            //alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
           contenido="<option value='' selected>Curso</option>";
            if(json.length != 0){
                
                for (let index = 0; index < json.length; index++) {
                    contenido += "<option value='"+json[index].id+"'>"+json[index].nombreCurso+"</option>";
                    document.getElementById("curso").innerHTML = contenido;
                    $("#curso").removeAttr("disabled"); 
                }
            }else {
                contenido="<option value='vacio' selected>Curso</option>";
                document.getElementById("curso").innerHTML = contenido;
                $("#curso").attr("disabled", "disabled" );
            }
            
        }
    })
}

function habilitarFechaHasta(){

   var fchDesde = document.getElementById('inputFechaDesdeReporte').value;
   
    document.getElementById('inputFechaHastaReporte').value = fchDesde;
    document.getElementById('inputFechaHastaReporte').min = fchDesde;
    document.getElementById('inputFechaHastaReporte').disabled = false;
}
