<?php
include "../header.html";
?>
<div class="container">

    <h1 class="display-4 my-3"> Validar Justificativos </h1>

    <div>
        <h4>Justificativos pendientes de evaluación</h4>
        <div id="pendientes" class= "my-3">
            <table class="table table-bordered text-center  my-2" style="background-color: rgb(248, 186, 186);">
                <thead>
                    <th>Id Justificativo</th>
                    <th>Nombre Alumno</th>
                    <th>Materia</th>
                    <th>Período a justificar</th>
                    <th>Estado</th>
                    <th>Validación</th>
                </thead>
                <tbody>
                    <tr>
                        <td><a  href="/DayClass/images/justificativos.png">Justificativo 1 </td>
                        <td>Ruiz Graciela</td>
                        <td>Materia N </td>
                        <td>DD/MM/AAAA                                   
                            DD/MM/AAAA</td>                        
                        <td><button class="btn btn-success">Validar</button>
                            <button class="btn btn-danger">Denegar</button></td>
                        <td>Estado</td>
                    </tr>
                    <tr>
                        <td><a  href="/DayClass/images/justificativos.png">Justificativo 2 </td>
                            <td>Perez Clara</td>
                            <td>Materia N </td>
                            <td>DD/MM/AAAA - DD/MM/AAAA</td>
                            <td><button class="btn btn-success">Validar</button>
                                <button class="btn btn-danger">Denegar</button></td>
                            <td>Estado</td>
                    </tr>
                    <tr>
                        <td><a  href="/DayClass/images/justificativos.png">Justificativo 3 </td>
                            <td>Ramos Ramon</td>
                            <td>Materia N </td>
                            <td>DD/MM/AAAA - DD/MM/AAAA</td>
                            <td><button class="btn btn-success">Validar</button>
                                <button class="btn btn-danger">Denegar</button></td>
                            <td>Estado</td>
                    </tr>
                   
                </tbody>
            </table>
        </div>

    </div>







</div>

<?php
include "../footer.html";
?>