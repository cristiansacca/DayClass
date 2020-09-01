document.getElementById("materia").onchange = function(){
    var id_materia = document.getElementById("materia").value;
    var datos = {
        id_materia: id_materia
    }

    $.ajax({
        url:'listarCursos.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            contenido="<option value='' selected>Seleccione</option>";
            if(json.length != 0){
                contenido+="<option value='0'>Todos</option>";
                for (let index = 0; index < json.length; index++) {
                    contenido += "<option value='"+json[index].id+"'>"+json[index].nombreCurso+"</option>";
                    document.getElementById("curso").innerHTML = contenido;
                    $("#curso").removeAttr("disabled");                
                }
            } else {
                document.getElementById("curso").innerHTML = contenido;
                $("#curso").attr("disabled", "disabled" );
            }
            
        }
    })
}

function validarPeriodo (){
    var desde = document.getElementById("fechaDesde").value;
    var hasta = document.getElementById("fechaHasta").value;
    if(desde!=""&&hasta!=""){
        if(desde<hasta){
            document.getElementById("msgPeriodoDesde").innerHTML = "";
            document.getElementById("msgPeriodoHasta").innerHTML = "";
            $("#btnGenerar").removeAttr("disabled"); 
        } else {
            document.getElementById("msgPeriodoDesde").innerHTML = "Periodo inválido";
            document.getElementById("msgPeriodoHasta").innerHTML = "Periodo inválido";
            $("#btnGenerar").attr("disabled", "disabled" );
        }
    }
}

document.getElementById("btnGenerar").onclick = function () {
    var curso = document.getElementById('curso').value;
    var materia = document.getElementById('materia').value;
    var fechaDesde = document.getElementById('fechaDesde').value;
    var fechaHasta = document.getElementById('fechaHasta').value;

    if(curso != "" && materia != "" && fechaDesde != "" && fechaHasta != ""){
        var datos = {
            curso: curso,
            materia: materia,
            fechaDesde: fechaDesde,
            fechaHasta: fechaHasta
        };
        generarPieChart(datos);
        $("#faltanDatos").attr("hidden", "hidden" );
    } else {
        $("#faltanDatos").removeAttr("hidden");
    }
}

function generarPieChart(datosEntrada) {
    $.ajax({
        url:'generarEstadistica.php',
        type: 'POST',
        data: datosEntrada,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: document.getElementById("tipoGrafico").value,
                data: {
                    labels: ['Presentes', 'Ausentes'],
                    datasets: [{
                        label: 'Asistencias vs. Inasistencias',
                        data: [(json.asistencias), (json.inasistencias)],
                        backgroundColor: ['rgba(0, 147, 0, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                        borderColor: ['rgba(0, 147, 0, 1)','rgba(255, 99, 132, 1)'],
                        borderWidth: 1.5
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            document.getElementById("cantPresentes").innerHTML = json.asistencias;
            document.getElementById("cantAusentes").innerHTML = json.inasistencias;
            document.getElementById("periodo").innerHTML = json.periodo;
            document.getElementById("fechaHora").innerHTML = json.fechaHora;
            document.getElementById("txtCurso").innerHTML = json.nombreCurso;
            document.getElementById("txtMateria").innerHTML = json.nombreMateria+" "+json.nivelMateria;
        }
    })
}