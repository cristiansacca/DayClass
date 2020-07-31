<?php
include "../header.html";
?>
<?php
include "../databaseConection.php";

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$legajo = $_POST["legajo"];
$email = $_POST["email"];
$password = $_POST["password"];
$fechaNac = $_POST["fechaNac"];
$rol = $_POST["rol"];

$mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
$mailDocente = $con->query("SELECT id FROM profesor WHERE emailProf = '$email'");
$mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");

echo "<div class='container'><br>";

if (($mailAlumno->num_rows) == 0 && ($mailDocente->num_rows) == 0 && ($mailAdmin->num_rows) == 0) {
  if ($rol == "alumno") {
    $consulta1 = $con->query("SELECT * FROM alumno WHERE dniAlum = '$dni' AND legajoAlumno = '$legajo'");
  }
  if ($rol == "docente") {
    $consulta1 = $con->query("SELECT * FROM profesor WHERE dniProf = '$dni' AND legajoProf = '$legajo'");
  }

  $resultado1 = $consulta1->fetch_assoc();

  if (($consulta1->num_rows) > 0) {
    $id_usuario = $resultado1['id'];
    $consulta2 = $con->query("SELECT * FROM permiso WHERE nombrePermiso = UPPER('$rol')");
    $resultado2 = $consulta2->fetch_assoc();
    $id_permiso = $resultado2['id'];
    $fechaActual = date("Y-m-d");

    //password_has(pass, PASSWORD_DEFAULT) se usa para cifrar la contraseña y password_verify(pass, pass_cifrada) -> true o false para descifrarla.
    $password_cifrada = password_hash($password, PASSWORD_DEFAULT);

    if ($rol == "alumno") {
      $actualizacion = $con->query("UPDATE alumno SET emailAlum = '$email', contraseniaAlum = '$password_cifrada', fechaNacAlumno = '$fechaNac', 
      fechaAltaAlumno = '$fechaActual' ,permiso_id = '$id_permiso' WHERE id='$id_usuario'");
    }
    if ($rol == "docente") {
      $actualizacion = $con->query("UPDATE profesor SET emailProf = '$email', contraseniaProf = '$password_cifrada', fechaNacProf = '$fechaNac', 
      fechaAltaProf = '$fechaActual' ,permiso_id = '$id_permiso' WHERE id='$id_usuario'");
    }

    if ($actualizacion) {
      echo "<div class='alert alert-success' role='alert'>
          <h3>Se registró correctamente</h3>
        </div>";
      echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>
          <h3>Ocurrió un error durante el registro</h3>
        </div>";
      echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a>";
    }
  } else {
    echo "<div class='alert alert-danger' role='alert'>
          <h3>Ocurrió un error durante el registro</h3>
        </div>";
    echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a>";
  }
} else {
  echo "<div class='alert alert-danger' role='alert'>
        <h3>La dirección de correo ingresada ya se encuentra registrada en el sistema</h3>
      </div>";
  echo "<a class='btn btn-primary my-2' href='/DayClass/Index.php'>Volver al inicio</a>";
}

echo "</div>";
echo "<script>document.getElementById('contenidoNavbar').innerHTML = '';</script>";
?>

<?php
include "../footer.html";
?>
