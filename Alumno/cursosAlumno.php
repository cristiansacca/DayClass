<?php
include "../header.html";
?>
<script src="administrador.js"></script>
<style>
    .color0{
        background-color: LightSteelBlue;
    }

.color1{
        background-color: LightBlue;
    }
    
.color2{
        background-color: Thistle;
    }
    
.color3{
        background-color: lightskyblue;
    }


</style>


<div class="container ">
    <div class="my-5">
        <h3 class="">Materias en las que esta inscipto</h3>
        <p class="lead"></p>
    </div>
    <!-- Page Features -->
    <div class="row text-center my-5">

       <?php
        $contador = 0;
        for ($i = 0; $i < 7; $i++) {
            if($contador == 4){
                $contador = 0;
            }
            
            $nombre_div = "3k9";
            $aux = $i+1;
            
            
            echo "<div class='col-lg-6 col-md-12 mb-4' >
            <div class='card h-100 color$contador' id='tajeta$i'>
                <div class='card-body text-left'>
                    <h3 class='card-title'>Materia $aux</h3>
                    <h5 class='card-title'>Division $nombre_div</h5>
                    <h6  class='mx-5'>Profesores</h6>
                    <ul class='mx-5' style='list-style: none;'>
                       <li> Teoria: </li>
                       <li> Practica:</li>
                    </ul>
                </div>

                <div class='card-footer'>
                <a href='#' class='btn btn-dark m-2'>Ver Curso</a>
                    <a href='#' class='btn btn-dark m-2'>Novedades</a>
                </div>
            </div>
        </div>" ;
            
            $contador ++;
       
        }
        
    ?> 
        
        
     
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Auto-asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" text-center my-3 mx-4 form-row">
          <div class="form-group col-12 ">
            <h3>Ingrese el código dado por el profesor</h3><br>
            <h6 class="text-muted">Sin guiones ni espacios</h6>
            <input type="text"  class="form-control m-auto text-center" style="width: 230px; font-size: large; border-width: 4px;" id = "inputCodigoIngresado" onkeyup="this.value = this.value.toUpperCase();" maxlength="11">
            <h9 id = "msgValidacionCodigo" ></h9> <br>
            <input type="button" class="btn btn-lg btn-secondary my-3" value="Dar Presente" style=" background-color: mediumpurple; border-color: mediumpurple" id ="btnVerificarCodIngresado" onclick = "validarLongCodIngresado()">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="alumno.js"></script>
<?php
include "../footer.html";
?>