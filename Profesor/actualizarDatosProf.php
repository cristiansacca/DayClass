<?php
include "../databaseConection.php";

$legajoTraido = $_POST["inputLegajo"];

$pasNueva = $_POST["inputPassNew"];
$email = $_POST["inputEmailNew"];

$consulta1 = $con->query("SELECT id FROM profesor WHERE legajoProf = '$legajoTraido'");
$resultado1 = $consulta1->fetch_assoc();
$id_usuario = $resultado1['id'];

if ($pasNueva == "") {
    $consultaProfesor = $con->query("SELECT legajoProf FROM profesor WHERE emailProf = '$email'");

    if (mysqli_num_rows($consultaProfesor) == 0) {

        $mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
        $mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");

        if (mysqli_num_rows($mailAlumno) == 0 && mysqli_num_rows($mailAdmin) == 0) {

            $actualizacion = $con->query("UPDATE profesor SET emailProf = '$email' WHERE id='$id_usuario'");

            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=1");
        } else {
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=2");
        }
    } else {
        $resultado2 = $consultaProfesor->fetch_assoc();
        $legajoConsulta = $resultado2['legajoProf'];
        if ($legajoTraido == $legajoConsulta) {

            header("Location:/DayClass/Profesor/editar_perfil.php");
        } else {
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=2");
        }
    }
} else {
    $newPass_cifrada = password_hash($pasNueva, PASSWORD_DEFAULT);
    $consultaAlumno = $con->query("SELECT legajoProf FROM profesor WHERE emailProf = '$email'");

    if (mysqli_num_rows($consultaAlumno) == 0) {
        $mailAlumno = $con->query("SELECT id FROM alumno WHERE emailAlum = '$email'");
        $mailAdmin = $con->query("SELECT id FROM administrativo WHERE emailAdm = '$email'");

        if (mysqli_num_rows($mailAlumno) == 0 && mysqli_num_rows($mailAdmin) == 0) {
            $actualizacion = $con->query("UPDATE profesor SET emailProf = '$email', contraseniaProf = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=1");
        } else {
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=2");
        }
    } else {
        $resultado2 = $consultaAlumno->fetch_assoc();
        $legajoConsulta = $resultado2['legajoProf'];
        if ($legajoTraido == $legajoConsulta) {
            $actualizacion = $con->query("UPDATE profesor SET contraseniaProf = '$newPass_cifrada' WHERE id='$id_usuario'");
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=1");
        } else {
            header("Location:/DayClass/Profesor/editar_perfil.php?resultado=2");
        }
    }
}
?>