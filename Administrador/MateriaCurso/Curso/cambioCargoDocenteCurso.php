<?php
include "../../../databaseConection.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_cargo = $_POST["cargosDisponibles"];
$id_curso = $_POST["curso_idCC"];
$id_prof = $_POST["impIDprofCC"];
$fechaHoy = date('Y-m-d');

//bajar el cargo actual
$consultaCargoActual = $con->query("SELECT cargoprofesor.id FROM curso, cargo, profesor, cargoprofesor WHERE profesor.id = '$id_prof' AND curso.id = '$id_curso' AND curso.id = cargoprofesor.curso_id AND profesor.id = cargoprofesor.profesor_id AND cargoprofesor.cargo_id = cargo.id AND cargoprofesor.fechaDesdeCargo <= '$fechaHoy' AND cargoprofesor.fechaHastaCargo IS NULL");
$cargoProfesor = $consultaCargoActual->fetch_assoc();
$id_cargoProfesor = $cargoProfesor["id"];

if(!($consultaCargoActual->num_rows) == 0){
    $cerrarCargoActual = $con->query("UPDATE `cargoprofesor` SET `fechaHastaCargo`='$fechaHoy' WHERE id = $id_cargoProfesor");
    
    if($cerrarCargoActual){
        //crear el cargo nuevo
        $crearCargoNuevo = $con->query("INSERT INTO `cargoprofesor`(`fechaDesdeCargo`, `cargo_id`, `curso_id`, `profesor_id`) VALUES ('$fechaHoy','$id_cargo','$id_curso','$id_prof')");
        
        if($crearCargoNuevo){//Si se insertó correctamente devuelve 1, sino devuelve 0. Para mostrar los mensajes correspondientes.
        
            $selectCargoNuevo = $con->query("SELECT cargoprofesor.id FROM `cargoprofesor` WHERE cargoprofesor.fechaDesdeCargo = '$fechaHoy' AND cargoprofesor.cargo_id = '$id_cargo' AND cargoprofesor.curso_id = '$id_curso' AND cargoprofesor.profesor_id = '$id_prof' AND cargoprofesor.fechaHastaCargo IS NULL")->fetch_assoc();

            $id_cargoNuevoProfesor = $selectCargoNuevo["id"];


            if($selectCargoNuevo != null){
                 //cerrar el estado cargo profesor anterior 
                $selectEstadoCargoProfesor = $con->query("SELECT cargoprofesorestado.id FROM `cargoprofesorestado` WHERE cargoprofesorestado.cargoProfesor_id = '$id_cargoProfesor' AND cargoprofesorestado.fechaDesdeCargoProfesorEstado <= '$fechaHoy' AND (cargoprofesorestado.fechaHastaCargoProfesorEstado > '$fechaHoy' OR cargoprofesorestado.fechaHastaCargoProfesorEstado IS NULL)");


                if(!($selectEstadoCargoProfesor->num_rows) == 0){
                    //actualizar los estados viejos
                    while($estadoCargoProfesor = $selectEstadoCargoProfesor->fetch_assoc()){

                        $id_estadoCargoProfesor = $estadoCargoProfesor["id"];
                        $cambiarEstados = $con->query("UPDATE `cargoprofesorestado` SET `cargoProfesor_id`= '$id_cargoNuevoProfesor' WHERE cargoprofesorestado.id= '$id_estadoCargoProfesor'");

                        echo "entra al while";
                        echo  "$id_estadoCargoProfesor";

                    }

                    header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=6");

                }else{
                    echo "error en asociar los estados viejos al cargo nuevo";
                    header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=7");
                }

            }else{
               echo "error en encontrar el cargo recien creado"; 
                header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=7");
            }
           
        }else{
            //header("location: /DayClass/&&resultado=0");
            echo "error en crear cargo actual";
            header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=7");
        }

        
    }else{
        //error
        echo "error en cerrar el cargo actual";
        header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=7");
    }
}else{
    //error 
    echo "error en encontrar el cargo actual";
    header("location: /DayClass/Administrador/MateriaCurso/Curso/ModifDocentesCurso.php?id=$id_curso&&resultado=7");
}













?>