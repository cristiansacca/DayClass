<?php
include "../header.html";
?>
<div class="container">

    <h1 class="display-4 my-2"> Reporte Alumno </h1>

    <form action="#">

        <div class="row">
            <div>

                <table class="table">
                    <tbody>
                        <tr>
                           
                                <select id="temas" class="custom-select my-3 ">
                                    <option selected> Seleccione un curso </option>
                                    <option value="1">Curso 1</option>
                                    <option value="2">Curso 2</option>
                                    <option value="3">Curso 3</option>
                                </select>     
                           
                                                
                        </tr>
                        
                        <tr>
                            
                            <select id="temas" class="custom-select my-4">
                                <option selected> Seleccione el legajo del alumno </option>
                                <option value="1">Alumno 1</option>
                                <option value="2">Alumno 2</option>
                                <option value="3">Alumno 3</option>
                            </select>
                          
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="col-lg-6 col-md-6 mb-6 my-2">
                <label>Seleccione el período al que corresponde el reporte del alumno:</label>
                <div class="m-auto">
                    <label for="fechaDesde"> <b> Desde:</b> </label>
                    <input type="date" id="fechaDesde" class="form-control" required>
                    <label for="fechaHasta"> <b> Hasta: </b></label>
                    <input type="date" id="fechaHasta" class="form-control" required>
                </div>
            </div>
        </div>
    </form>
 <div>

        <div class="card ">
            <div class="card-header">
                <b> Datos del Alumno </b>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nombre Alumno:</td>
                                <td>NombreN</td>
                                <td>Legajo:</td>
                                <td>XXXX</td>
                                <td>Curso:</td>
                                <td>CursoN</td>
                            </tr>

                            <tr>
                                <td>DNI:</td>
                                <td>XXXX</td>
                                <td>Email:</td>
                                <td>XXXXX</td>
                            </tr>
                        </tbody>
                    </table>
                </blockquote>
            </div>
        </div>
    </div>


    <div class="my-4">
        <div class="card ">
            <div class="card-header">
                <b> Datos del Reporte </b>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID Reporte:</td>
                                <td>XXX</td>
                                <td>Date:</td>
                                <td>DD/MM/AAAA</td>
                            </tr>

                            <tr>
                                <td>Período dek Reporte:</td>
                                <td>MateriN</td>

                            </tr>
                        </tbody>
                    </table>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="jumbotron my-4">
        <h3 class=" text-center">PLANILLA DE ASISTENCIA DEL ALUMNO</h3>
        <p class="lead"></p>
    </div>
</div>

<script src="administrador.js"></script>

<?php
include "../footer.html";
?>