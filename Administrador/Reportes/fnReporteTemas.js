document.getElementById("materia").onchange = function(){
    eval("debugger;");
    
    contenido="<option selected>Curso</option>";
    document.getElementById("curso").innerHTML = contenido;
    $("#curso").attr("disabled", "disabled" );
    
    
    document.getElementById("resultadoMostrar").innerHTML = "";
    
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
                contenido="<option value='' selected>Curso</option>";
                document.getElementById("curso").innerHTML = contenido;
                $("#curso").attr("disabled", "disabled" );
                document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h5><i class='fa fa-exclamation-circle mr-2'></i>Esta materia no tiene cursos disponibles.</h5></div>";
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

function enviarReporte(){
    eval("debugger;");
    var materia = document.getElementById("materia").value;
    var curso = document.getElementById("curso").value;
    var fchDesde = document.getElementById('inputFechaDesdeReporte').value;
    var fchHasta = document.getElementById('inputFechaHastaReporte').value 
    
    if(materia != "" && curso != "" && fchDesde != "" && fchHasta != ""){
        return true;
    }else{
        return false;
    }
    
    
}

function validarReporte(){
    var materia = document.getElementById("materia").value;
    var curso = document.getElementById("curso").value;
    var fchDesde = document.getElementById('inputFechaDesdeReporte').value;
    var fchHasta = document.getElementById('inputFechaHastaReporte').value;
    
     var datos = {
        fchDesde: fchDesde,
        fchHasta: fchHasta,
        materia: materia,
        curso: curso,
    }

    $.ajax({
        url:'validarReporteTemas.php',
        type: 'POST',
        async: false,
        data: datos,
        success: function(datosRecibidos) {
            //alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            
            if(json){
                //alert("hay datos");
                rtdo =  true;
            }else{
                document.getElementById("resultadoMostrar").innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert' ><h5><i class='fa fa-exclamation-circle mr-2'></i>No se encuentran temas registrados, en el periodo seleccionado, para generar el reporte solicitado.</h5></div>";
                rtdo = false;
            }
            
        }
    })
    
 return rtdo;   
    
}

