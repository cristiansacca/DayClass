document.getElementById("materia").onchange = function(){
    eval("debugger;");
    
    contenido="<option value='vacio' selected>Curso</option>";
    document.getElementById("curso").innerHTML = contenido;
    $("#curso").attr("disabled", "disabled" );
    
    contenido="<option value='vacio' selected>Alumno</option>";
    document.getElementById("alumno").innerHTML = contenido;
    $("#alumno").attr("disabled", "disabled" );
    
    var id_materia = document.getElementById("materia").value;
    var datos = {
        id_materia: id_materia
    }

    $.ajax({
        url:'listarCursos.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            contenido="<option value='vacio' selected>Todos</option>";
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



var cantAlumnos = 0;

document.getElementById("curso").onchange = function(){
    eval("debugger;");
    var id_curso = document.getElementById("curso").value;
    var datos = {
        id_curso: id_curso
    }

    $.ajax({
        url:'listarAlumnos.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            contenido="<option value='vacio' selected>Todos</option>";
            if(json.length != 0){
                cantAlumnos = json.length;
                for (let index = 0; index < json.length; index++) {
                    contenido += "<option value='"+json[index].id+"'>"+ json[index].apellidoUsuario + " " + json[index].nombreUsuario+ " " + json[index].legajoUsuario + "</option>";
                    document.getElementById("alumno").innerHTML = contenido;
                    $("#alumno").removeAttr("disabled");  
                }
            }else{
                contenido="<option value='vacio' selected>Alumno</option>";
                document.getElementById("alumno").innerHTML = contenido;
                $("#alumno").attr("disabled", "disabled" );
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


function resizeSelect(){
    if(cantAlumnos > 0){
        if(cantAlumnos < 10){
            document.getElementById("alumno").size = cantAlumnos +1;
        }else{
            document.getElementById("alumno").size = 10;
        }
    }
}


