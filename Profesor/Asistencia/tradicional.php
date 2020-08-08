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
    <i class="fa fa-user-circle-o fa-5x"></i>
    <br>
    
   
<?php
include "../../databaseConection.php";

//echo "SELECT apellidoAlum, nombreAlum FROM alumno, alumnocursoactual, curso WHERE alumno.id = alumno_id AND curso_id = curso.id AND curso.id = '$id_curso'";

$consulta1 = $con->query("SELECT alumno.id, apellidoAlum, nombreAlum FROM alumno, alumnocursoactual, curso WHERE alumno.id = alumno_id AND curso_id = curso.id AND curso.id = '$id_curso'");

$contador = 1;
while($resultado1 = $consulta1->fetch_assoc()){
    $nombreAlum = $resultado1["nombreAlum"];
    $apellidoAlum = $resultado1["apellidoAlum"];
    $idAlum = $resultado1["id"];
    
    $aux = $contador +1;
    
    echo "<div class=' mySlides fade'>
    <label id='labelNombre' style='font-size:xx-large;'>$apellidoAlum, $nombreAlum, $contador, $idAlum</label>
    

    <div>
        <button class='btn btn-lg btn-danger mx-4'><i class='fa fa-ban mx-1'></i>Ausente</button>
        <button class='btn btn-lg btn-success mx-4'><i class='fa fa-check mx-1' onclick='currentSlide($aux)'></i>Presente</button>
    </div>
    </div>";
    
   $contador ++; 
}
    
    
    
?>    
    
    
    
</div>

<?php
include "../../footer.html";
?>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

</script>


<div class="slideshow-container">
                      
    <div class="mySlides fade">
        <img src="405735.jpg" onclick="currentSlide(2)" oncontextmenu="return false" >
    </div>

    <div class="mySlides fade">
        <img src="fondo_Sylvia_Ritter.png"  onclick="currentSlide(3)" oncontextmenu="return false">
    </div>

    <div class="mySlides fade">
        <img src="descarga.jpg" onclick="currentSlide(1)" oncontextmenu="return false">
    </div>

</div>