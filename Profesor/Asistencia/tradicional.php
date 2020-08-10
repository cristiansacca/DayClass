<?php
include "../../header.html";
include "../../databaseConection.php";

session_start();

//Si la variable sesión está vacía es porque no se ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    //Nos envía a la página de inicio
    header("location:/DayClass/index.php");
}

if(isset($_GET["id_curso"])){
    $id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();
    
} else {
    header("location:/DayClass/Profesor/index.php");
}

$id_curso = $_GET["id_curso"];

    $consulta1 = $con->query("SELECT * FROM curso WHERE id = '$id_curso'");
    $curso = $consulta1->fetch_assoc();

?>


<script src="../profesor.js"></script>

<h2 class="text-center my-4"><?php echo $curso["nombreCurso"] ?></h2>
<div class="text-center my-5">
    
    
   
<?php
include "../../databaseConection.php";

date_default_timezone_set('America/Argentina/Mendoza');
$currentDateTime = date('Y-m-d H:i:s');
//echo "SELECT apellidoAlum, nombreAlum FROM alumno, alumnocursoactual, curso WHERE alumno.id = alumno_id AND curso_id = curso.id AND curso.id = '$id_curso'";

$consulta1 = $con->query("SELECT alumno.id, apellidoAlum, nombreAlum, legajoAlumno FROM alumno, alumnocursoactual, curso WHERE alumno.id = alumno_id AND curso_id = curso.id AND curso.id = '$id_curso' AND `fechaHastaAlumCurAc` IS NULL OR `fechaHastaAlumCurAc` < '$currentDateTime'");

$contador = 1;    
while($resultado1 = $consulta1->fetch_assoc()){
    $nombreAlum = $resultado1["nombreAlum"];
    $apellidoAlum = $resultado1["apellidoAlum"];
    $idAlum = $resultado1["id"];
    $legajoAlum = $resultado1["legajoAlumno"];
    
    $aux = $contador +1;
    $ausente = "Ausente";
    $presente = "Presente";
    
    echo "<div class='mySlides'>
    <i class='fa fa-user-circle-o fa-5x'></i>
    <br>
    <label id='labelLegajo' style='font-size:xx-large;'>$legajoAlum</label>
    <br>
    <label id='labelNombreApellido' style='font-size:xx-large;'>$apellidoAlum, $nombreAlum</label>
    
    <div>
        <button class='btn btn-lg btn-danger mx-4' id='$ausente-$nombreAlum-$apellidoAlum' onclick='currentSlide($aux,this.id,$legajoAlum)'><i class='fa fa-ban mx-1'></i>Ausente</button>
        <button class='btn btn-lg btn-success mx-4' id='$presente-$nombreAlum-$apellidoAlum' onclick='currentSlide($aux,this.id,$legajoAlum)'><i class='fa fa-check mx-1'></i>Presente</button>
    </div>
    </div>";
    
   $contador ++; 
}

?>   

        
</div>

<div id="dvTable" class="d-flex justify-content-center" style="with:50%">
    

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


<script>
var slideIndex = 1;
showSlides(slideIndex);
var rtdosFinales = [];
    
function registrarAlumno(estadoNameSur, legajo){
    var arregloDatos = estadoNameSur.split('-');
    var estado = arregloDatos[0];
    var nombreA = arregloDatos[1];
    var apellidoA = arregloDatos[2];
    
    var estadoAlum = [legajo,apellidoA, nombreA,estado];
    rtdosFinales.push(estadoAlum);
    return;
}

function currentSlide(n,btnNombre, legajoAlum) {
    eval("debugger;");
    registrarAlumno(btnNombre,legajoAlum);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    eval("debugger;");
  var i;
  var slides = document.getElementsByClassName("mySlides");
    
    if (n > slides.length) {
        generarTablaResumen();
    }
    
    for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
    }
        
    
    if(n <= slides.length){
        slides[slideIndex-1].style.display = "block";     
    }
    
}
    
    
function generarTablaResumen(){
    var cabecera = ["Legajo","Apellido","Nombre","Estado"];
    
    var contenido = "";
    contenido += "<table id='tabladatos' class='table table-bordered'>";
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
    
    
    contenido += "<th>Acciones</th>";
    contenido += "</tr>";
    contenido += "</thead>";
    
    contenido += "<tbody>";
    
        //Add the data rows.
        for (var i = 0; i < rtdosFinales.length; i++) {
            contenido += "<tr>";
            for (var j = 0; j < columnCount; j++) {
                contenido += "<td id='"+i+"-"+j+"'>";
                contenido +=  rtdosFinales[i][j];;
                contenido += "</td>";
            }
            
        contenido += "<td>";
        contenido += "<button type='button' class='btn btn-success' onclick='cambiar("+i+")'>";
        contenido += "<i class='fa fa-refresh'></i>";
        contenido += "</button> ";
        contenido += "</td>";
        //---------------------------------
        contenido += "</tr>";
        }
 
        
        contenido += "</tbody>";
        contenido += "</table>";
        contenido += "<button type='submit' class='btn btn-primary' id='btnConfirmar' style='float: right' onclick='confirmar()'>";
        contenido += "<i class='fa fa-check'></i> Confirmar";
        contenido += "</button> ";
        document.getElementById("dvTable").innerHTML = contenido;
}
    
function cambiar(fila){
    eval("debugger;");
    var filaR = fila +1;
    var tabla = document.getElementById('tabladatos');
    var valor = tabla.rows[filaR].cells[3].innerHTML;
    
    if(valor == "Presente"){
        tabla.rows[filaR].cells[3].innerHTML ="Ausente";
        rtdosFinales[fila][3] ="Ausente";
        //alert(rtdosFinales[fila][3]);
    }else{
        tabla.rows[filaR].cells[3].innerHTML ="Presente";
        rtdosFinales[fila][3] ="Presente";
        //alert(rtdosFinales[fila][3]);
    }
}

function confirmar(){
eval("debugger;"); 
$.ajax({
    type: "POST",
    url: "darPresente.php",
    data: {'array': JSON.stringify(rtdosFinales)},//capturo array     
    success: function(data){}
});
}
</script>


<?php
include "../../footer.html";
?>
