mostrarAsistencias();

document.getElementById("materias").onchange = function() {
    document.getElementById("btnLimpiar").click();
    mostrarAsistencias();
}

function mostrarAsistencias() {
    var id_curso = document.getElementById("materias").value;
    var id_alumno = document.getElementById("id_alumno").value;
    var datos = {
        id_curso: id_curso,
        id_alumno: id_alumno
    }
    $.ajax({
        url: 'listarAsistencias.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            var contenido = "";
            for (let i = 0; i < json.length; i++) {
                var tipo;
                switch ((json[i].tipoAsistencia).toUpperCase()) {
                    case "PRESENTE":
                        tipo = "success";
                        break;
                    case "AUSENTE":
                        tipo = "danger";
                        break;
                    case "JUSTIFICADO":
                        tipo = "warning";
                        break;
                
                    default:
                        tipo = "dark";
                        break;
                }
                
                contenido += "<tr>"+
                    "<td>"+json[i].fecha+"</td>"+
                    "<td class='text-"+tipo+"'><strong>"+json[i].tipoAsistencia+"</strong></td>"+
                "</tr>";
            }
            document.getElementById("tablaAsistencias").innerHTML = contenido;
        }
    })
    $.ajax({
        url: 'obtenerAsistencias.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            json = JSON.parse(datosRecibidos);
            var ctx = document.getElementById('pieChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Presentes', 'Ausentes', 'Justificados'],
                    datasets: [{
                        label: '',
                        data: [(json.asistencias), (json.inasistencias), (json.justificados)],
                        backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
                        borderWidth: 2
                    }]
                }/*,
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: ['white', 'green', 'red'],
                        precision: 2
                    }
                }*/
            });

            var ctx2 = document.getElementById('barChart').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'horizontalBar',
                data: {
                    labels: ['Presentes', 'Ausentes', 'Justificados'],
                    datasets: [{
                        label: "Cantidad",
                        data: [(json.asistencias), (json.inasistencias), (json.justificados)],
                        backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
                        borderWidth: 1.5
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Asistencias'
                    }
                },
            });
            document.getElementById("btnLimpiar").onclick = function(){
                myChart.destroy();
                myChart2.destroy();
            }
        }
    })
}