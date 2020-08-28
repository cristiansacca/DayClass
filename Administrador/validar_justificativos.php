<?php
include "../header.html";
?>

<div class="container">

    <h1 class="display-4 my-3"> Validar Justificativos </h1>

    <div>
        <h4>Justificativos pendientes de evaluación</h4>
        <div id="pendientes" class="my-3">
            <table class="table table-bordered text-center  my-2" style="background-color: rgb(243, 212, 212);">
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
                        <td> <a href="/DayClass/images/justificativos.png">Justificativo 1 </td>
                        <td>Ruiz Graciela</td>
                        <td>Materia N </td>
                        <td>DD/MM/AAAA - DD/MM/AAAA</td>
                        <td><button id="btnvalidar" class="btn btn-success" onclick="setEstado('Validado')"> Validar
                            </button>
                            <button id="btndenegar" class="btn btn-danger " onclick="setEstado('Denegado')">
                                Denegar</button></td>
                        <td>
                            <h9 id="estadoBtn"></h9>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="administrador.js"></script>
<script>
    <?php echo "document.getElementById('nombreUsuarioNav').innerHTML = '".$_SESSION['administrador']['nombreAdm']." ".$_SESSION['administrador']['apellidoAdm']."'" ?>
</script>
<?php
include "../footer.html";
?>