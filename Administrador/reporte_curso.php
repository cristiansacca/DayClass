<?php
include "../header.html";
?>
<div class="container">

    <h1 class="display-4 my-2"> Reporte Curso </h1>  
   
    <form action="#">       
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-6 my-9">
                <br>
                <br>
                <br>
                <br>
                <select id="temas" class="custom-select ">
                    <option selected> Seleccione un curso </option>
                    <option value="1">Curso 1</option>
                    <option value="2">Curso 2</option>
                    <option value="3">Curso 3</option>
                </select>

            </div>
            <div class="col-lg-6 col-md-6 mb-6 my-2">
                <label>Seleccione el período al que corresponde el reporte del curso:</label>
                <div class="my-2">
                    <label for="fechaDesde"> <b> Desde:</b> </label>
                    <input type="date" id="fechaDesde" class="form-control" required>
                    <label for="fechaHasta"> <b>  Hasta: </b></label>
                    <input type="date" id="fechaHasta" class="form-control" required>
                </div>
            </div>
        </div>
    </form>
<div>
    <div class="card ">
        <div class="card-header">
            <b> Datos del Curso </b> 
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">                
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nombre curso:</td>
                            <td>CursoN</td>
                            <td>División:</td>
                            <td>DivisiónN</td>                            
                        </tr>
                        
                        <tr>
                            <td>Materia:</td>
                            <td>MateriN</td>
                          
                        </tr>
                    </tbody>
                </table>
            </blockquote>
        </div>
    </div>
</div>


<div class= "my-4">
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
        <h3 class=" text-center">GRAFICO DE REPORTE </h3>
        <p class="lead"></p>
    </div>
</div>

<?php
include "../footer.html";
?>