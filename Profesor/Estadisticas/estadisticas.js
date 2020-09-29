function validarPeriodo (){
    var desde = document.getElementById("fechaDesde").value;
    var hasta = document.getElementById("fechaHasta").value;
    if(desde!=""&&hasta!=""){
        if(desde<=hasta){
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
    var fechaDesde = document.getElementById('fechaDesde').value;
    var fechaHasta = document.getElementById('fechaHasta').value;

    if(curso != "" && fechaDesde != "" && fechaHasta != ""){
        var datos = {
            curso: curso,
            fechaDesde: fechaDesde,
            fechaHasta: fechaHasta
        };
        document.getElementById("btnLimpiar").click();
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
            var tipoGrafico = document.getElementById("tipoGrafico").value;
            var ctx = document.getElementById('myChart').getContext('2d');
            
            if(tipoGrafico == 'pie' || tipoGrafico == 'doughnut'){
                var myChart = new Chart(ctx, {
                    type: tipoGrafico,
                    data: {
                        labels: ['Presentes', 'Ausentes', 'Justificados'],
                        datasets: [{
                            data: [(json.asistencias), (json.inasistencias), (json.justificados)],
                            backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        plugins:{
                            labels: {
                            render: 'percentage',
                            fontColor: 'white',
                            fontSize: 14,
                            }
                        }
                    }
                });
            } else {
                var myChart = new Chart(ctx, {
                    type: tipoGrafico,
                    data: {
                        labels: ['Presentes', 'Justificados', 'Ausentes'],
                        datasets: [{
                            label: "Cantidad",
                            data: [(json.asistencias), (json.justificados), (json.inasistencias)],
                            backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(218, 165, 32, 1)', 'rgba(255, 99, 132, 1)'],
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
                        },
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Gráfico de asistencias'
                        },
                        plugins:{
                            labels: false,
                        },
                        animation: {
                            duration: 1,
                            onComplete: function () {
                                var chartInstance = this.chart,
                                ctx = chartInstance.ctx;
                
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';
                
                                this.data.datasets.forEach(function (dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function (bar, index) {
                                        var data = dataset.data[index];                            
                                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                    });
                                });
                            }
                        },
                    }
                });
            }

            function porcentajeAsistencia(valor){
                var totalAsistencias = json.asistencias+json.inasistencias+json.justificados;
                return Math.round((valor/totalAsistencias)*100)+"% ("+valor+")";
            }

            document.getElementById("cantPresentes").innerHTML = porcentajeAsistencia(json.asistencias);
            document.getElementById("cantAusentes").innerHTML = porcentajeAsistencia(json.inasistencias);
            document.getElementById("cantJustificados").innerHTML = porcentajeAsistencia(json.justificados);
            document.getElementById("periodo").innerHTML = json.periodo;
            document.getElementById("fechaHora").innerHTML = json.fechaHora;
            document.getElementById("txtCurso").innerHTML = json.nombreCurso;
            document.getElementById("btnLimpiar").onclick = function(){myChart.destroy();}

        }
    })
}