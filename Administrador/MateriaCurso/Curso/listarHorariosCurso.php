<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $currentDateTime = date('Y-m-d');

    $id_curso = $_POST("idCurso");
                                
    $consulta = $con->query("SELECT horariocurso.horaInicioCurso, horariocurso.horaFinCurso, cursodia.nombreDia FROM `curso`, horariocurso, cursodia WHERE curso.id = $id_curso AND curso.id = horariocurso.curso_id AND horariocurso.cursoDia_id = cursodia.id ORDER BY cursodia.ordenDia ASC");

    while ($horarioCurso = $consulta->fetch_assoc()) {
        $nombreDia = $horarioCurso["nombreDia"];                       
        $horaDesde = $horarioCurso["horaInicioCurso"];
        $horaHasta = $horarioCurso["horaFinCurso"];
    }
?>