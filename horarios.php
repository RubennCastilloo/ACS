<?php 
include 'inc/sesiones.php';
include 'inc/funciones.php';
include 'layout/header.php'; 
?>

<h2>Crear Horarios</h2>
<p>Todos los campos son obligatorios</p>
<div class="contenedor-empleados">
    <form>
        <div class="campos">
            <div class="campo">
                <label for="hora-entrada">Hora Entrada:</label>
                <input 
                    type="time"
                    class="input-campo"
                    placeholder="Hora Entrada"
                    id="hora-entrada"
                >
            </div>
            <div class="campo">
                <label for="hora-salida">Hora Salida:</label>
                <input 
                    type="time"
                    class="input-campo"
                    placeholder="Hora Salida"
                    id="hora-salida"
                >
            </div>
            
                
        </div>
        <div class="campo">
                        <input type="submit" class="btn-crear" id="crear-horario" value="Crear Horario">
                </div>
    </form>
</div>

<div class="horarios contenedor-empleados">
    <div class="lista-horarios">
    <table id="listado-horarios">
        <thead>
            <tr>
                <th>Entrada</th>
                <th>Salida</th>
                <th>ID</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php $horarios = obtenerHorarios(); 
                if ($horarios->num_rows) { 

                    foreach($horarios as $horario) { ?>
            
            <tr>
                <td><?php echo $horario['entrada']; ?></td>
                <td><?php echo $horario['salida']; ?></td>
                <td><?php echo $horario['id']; ?></td>
                <td>
                <button data-id="<?php echo $horario['id']; ?>" type="button" class="btn-borrar btn">
                    <i class="fas fa-trash"></i>
                </button>
                </td>
            </tr>
            <?php  
             }
        } ?>
            
        </tbody>
    </table>
    </div>
</div>



<?php include 'layout/footer.php'; ?>