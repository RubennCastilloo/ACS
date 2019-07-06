<?php 
include 'inc/sesiones.php';
include 'inc/funciones.php';
include 'layout/header.php';


?>



<h2>Registro de Asistencias</h2>

<div class="contenedor-empleados">
    <form class="filtrar-empleados">   
        <div class="campo-buscador">
            <div class="buscar" style="flex-grow: 10">
                <input type="text" class="buscador sombra" placeholder="Buscar Registros" id="buscar" onkeyup="buscarContenido()" onkeydown="borrarInput(event);">
            </div>
    </form>
</div>


<div class="asistencias contenedor-empleados">
    <div class="lista-asistencias">
    <table id="datos">
        <thead>
            <tr>
                <th>Nombre(s)</th>
                <th>Apellido</th>
                <th>Horario</th>
                <th>Hora</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
        <?php $horarios = obtenerRegistros(); 
                if ($horarios->num_rows) {    
                    foreach($horarios as $horario) { ?>
            <tr>
                <td><?php echo $horario['nombres']; ?></td>
                <td><?php echo $horario['apellido']; ?></td>
                <td><?php echo $horario['horario']; ?></td>
                <td><?php echo $horario['hora']; ?></td>
                <td><?php echo $horario['fecha']; ?></td>
            </tr>
            <?php 
            
             }
        } ?>
        </tbody>
    </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>