function setCargosDisponibles(id){
    eval("debugger;");
    id_prof = id;
    document.getElementById('impIDprofCC').value = id_prof;
    id_curso = document.getElementById('cursoId1').value;
    var datos = {
        id_prof: id_prof, id_curso: id_curso
    }

    $.ajax({
        url:'buscarCargosDisponibles.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            //alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            contenido="<option value='' selected>Seleccione</option>";
            if(json.length != 0){
                for (let index = 0; index < json.length; index++) {
                    contenido += "<option value='"+json[index].id+"'>"+json[index].nombreCargo+"</option>";
                    document.getElementById("cargosDisponibles").innerHTML = contenido;        
                }
            } else {
                document.getElementById("cargosDisponibles").innerHTML = contenido;
            }
            
        }
    })
    
}