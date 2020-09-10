var slideIndex = 1;
showSlides(slideIndex);
var rtdosFinales = [];

function registrarAlumno(estadoNameSur, legajo) {
    eval("debugger;");
    var arregloDatos = estadoNameSur.split('-');
    var estado = arregloDatos[0];
    var nombreA = arregloDatos[1];
    var apellidoA = arregloDatos[2];

    var estadoAlum = [legajo, apellidoA, nombreA, estado];
    rtdosFinales.push(estadoAlum);
    return;
}

function currentSlide(n, btnNombre, legajoAlum) {
    //eval("debugger;");
    registrarAlumno(btnNombre, legajoAlum);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    //eval("debugger;");
    var i;
    var slides = document.getElementsByClassName("mySlides");

    if (n > slides.length) {
        generarTablaResumen();
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }


    if (n <= slides.length) {
        slides[slideIndex - 1].style.display = "block";
    }

}


function generarTablaResumen() {
    var cabecera = ["Legajo", "Apellido", "Nombre", "Estado"];

    var contenido = "";
    contenido += "<table id='tabladatos' class='table table-bordered table-info table-hover text-center'>";
    contenido += "<thead class='font-weight-bold'>";
    contenido += "<tr>";

    //Get the count of columns.
    var columnCount = rtdosFinales[0].length;

    //Add the header row.
    for (var i = 0; i < columnCount; i++) {
        contenido += "<th>";
        contenido += cabecera[i];
        contenido += "</th>";
    }


    contenido += "<th>Modificar</th>";
    contenido += "</tr>";
    contenido += "</thead>";

    contenido += "<tbody>";

    //Add the data rows.
    for (var i = 0; i < rtdosFinales.length; i++) {
        contenido += "<tr>";
        for (var j = 0; j < columnCount; j++) {
            contenido += "<td id='" + i + "-" + j + "'>";
            contenido += rtdosFinales[i][j];;
            contenido += "</td>";
        }

        contenido += "<td>";
        contenido += "<button type='button' class='btn btn-success' onclick='cambiar(" + i + ")'>";
        contenido += "<i class='fa fa-retweet'></i>";
        contenido += "</button> ";
        contenido += "</td>";
        contenido += "</tr>";
    }
    
    contenido += "</tbody>";
    contenido += "</table>";
    contenido += "<form action='darPresente.php' method='post' onsubmit='confirmar()'>";
    contenido += " <input type='text' hidden id='arregloDatos' name='arregloDatos'>";
    contenido += " <input type='text' hidden id='idCursoEnviar' name='idCursoEnviar'>";
    contenido += "<button type='submit' class='btn btn-primary ml-auto' id='btnConfirmar' >";
    contenido += "<i class='fa fa-check'></i> Confirmar";
    contenido += "</button> ";
    contenido += "</form>"
    document.getElementById("dvTable").innerHTML = contenido;
}

function cambiar(fila) {
    //eval("debugger;");
    var filaR = fila + 1;
    var tabla = document.getElementById('tabladatos');
    var valor = tabla.rows[filaR].cells[3].innerHTML;

    if (valor == "Presente") {
        tabla.rows[filaR].cells[3].innerHTML = "Ausente";
        rtdosFinales[fila][3] = "Ausente";
        //alert(rtdosFinales[fila][3]);
    } else {
        tabla.rows[filaR].cells[3].innerHTML = "Presente";
        rtdosFinales[fila][3] = "Presente";
        //alert(rtdosFinales[fila][3]);
    }
}

function confirmar() {
    document.getElementById('arregloDatos').value = JSON.stringify(rtdosFinales);
    var idCurso = document.getElementById('idCurso').value;
    document.getElementById('idCursoEnviar').value = idCurso;
    return true;
    
}