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
            <div class="campo">
                <label for="dias">Días:</label>
                <select name="dias" id="dias">
                    <option value="">Seleccionar</option>
                    <option value="Lunes a Domingo">Lunes a Domingo</option>
                    <option value="Lunes a Sabado">Lunes a Sabado</option>
                    <option value="Lunes a Viernes">Lunes a Viernes</option>
                    <option value="Lunes a Jueves">Lunes a Jueves</option>
                    <option value="Lunes a Miercoles">Lunes a Miercoles</option>
                    <option value="Lunes y Martes">Lunes y Martes</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
                <div class="campo">
                        <input type="submit" class="btn-crear" id="crear-horario" value="Crear Horario">
                </div>
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
                <th>Días</th>
                <th>No. Horario</th>
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
                <td><?php echo $horario['dias']; ?></td>
                <td><?php echo $horario['id']; ?></td>
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