<?php
include "../header.html";
?>
<div class="container">

    <h1 class="display-4 my-2"> Estadística de asistencia por MATERIAS:</h1>  
   
    <form action="#">       
        <div class="row">
        <div>
        
        </div>
            <div class="col-lg-6 col-md-6 mb-6 my-9">
               
               
                <br>
        <div >
          <label for="materias">Seleccione las materias que desee:</label><br>
          <h9 id="msgMaterias"></h9>
          <div class="form-group" id="materias">
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 1</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 2</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 3</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 4</label>
            </div>
            <div>
              <input type="checkbox" onchange="validar_checkbox()" name="materia"><label class="m-2">Materia 5</label>
            </div>
          </div>
        </div>
      
            </div>
            <div class="col-lg-6 col-md-6 mb-6 my-2">
                <label>Seleccione el período al que corresponde la estadística de la/s materias:</label>
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
                        <td>Institución:</td>
                                <td>NombreI</td>
                                <td>Ciclo_Lectivo:</td>
                                <td>XXXX</td>
                                                      
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
                                <td>Generado por:</td>
                                <td>nombre_usuario</td>
                                <td>Date:</td>
                                <td>DD/MM/AAAA</td>
                            </tr>
                        
                        <tr>
                            <td>Período del Reporte:</td>
                           
                          
                        </tr>
                    </tbody>
                </table>
            </blockquote>
        </div>
    </div>
</div>
<div class="jumbotron my-4">
        <h3 class=" text-center">GRAFICO DE ASISTENCIA VS INASISTENCIA </h3>
        <p class="lead"></p>
    </div>
    <div class="jumbotron my-4">
        <h3 class=" text-center">GRAFICO DE ASISTENCIA VS INASISTENCIA POR MATERIA/S </h3>
        <p class="lead"></p>
    </div>
</div>


<script src="administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../footer.html";
?>