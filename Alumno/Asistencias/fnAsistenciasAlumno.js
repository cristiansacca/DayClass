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
        url: 'obtenerAsistencias.php',
        type: 'POST',
        data: datos,
        success: function(datosRecibidos) {
            alert(datosRecibidos);
            json = JSON.parse(datosRecibidos);
            var ctx = document.getElementById('pieChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Presentes', 'Ausentes', 'Justificados'],
                    datasets: [{
                        label: 'Asistencias vs. Inasistencias vs. Justificados',
                        data: [(json.asistencias), (json.inasistencias), (json.justificados)],
                        backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
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
                },
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: ['white', 'white', 'white'],
                        precision: 2
                    }
                },
            });

            var ctx2 = document.getElementById('barChart').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'horizontalBar',
                data: {
                    labels: ['Presentes', 'Ausentes', 'Justificados'],
                    datasets: [{
                        label: '',
                        barPercentage: 0.6,
                        data: [(json.asistencias), (json.inasistencias), (json.justificados)],
                        backgroundColor: ['rgba(0, 147, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(218, 165, 32, 1)'],
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
            document.getElementById("btnLimpiar").onclick = function(){
                myChart.destroy();
                myChart2.destroy();
            }
        }
    })

}