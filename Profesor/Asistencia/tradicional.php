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

<script>
var slideIndex = 1;
showSlides(slideIndex);
var rtdosFinales = [["Legajo","Apellido","Nombre","Estado"]];
    
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
        
    slides[slideIndex-1].style.display = "block";     
}
    
    
function generarTablaResumen(){
    var contenido = "";
    contenido += "<table id='tabladatos' class='table table-bordered'>";
    contenido += "<thead class='font-weight-bold'>";
    contenido += "<tr>";
    
    
        //Get the count of columns.
        var columnCount = rtdosFinales[0].length;
 
        //Add the header row.
        for (var i = 0; i < columnCount; i++) {
            contenido += "<th>";
            contenido += rtdosFinales[0][i];
            contenido += "</th>";
        }
    
    
    contenido += "<th>Acciones</th>";
    contenido += "</tr>";
    contenido += "</thead>";
    
    contenido += "<tbody>";
    
        //Add the data rows.
        for (var i = 1; i < rtdosFinales.length; i++) {
            contenido += "<tr>";
            for (var j = 0; j < columnCount; j++) {
                contenido += "<td>";
                contenido +=  rtdosFinales[i][j];;
                contenido += "</td>";
            }
            
        contenido += "<td>";
        contenido += "<button class='btn btn-success' id='"+rtdosFinales[i]+"' onclick='cambiar(this.id)'>";
        contenido += "<i class='fa fa-refresh'></i>";
        contenido += "</button> ";
        contenido += "</td>";
        //---------------------------------
        contenido += "</tr>";
        }
 
        
        contenido += "</tbody>";
        contenido += "</table>";
        document.getElementById("dvTable").innerHTML = contenido;
}

</script>


<?php
include "../../footer.html";
?>
