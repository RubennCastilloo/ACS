<?php 
include 'inc/sesiones.php';
include 'inc/funciones.php';
include 'layout/header.php'; 
?>

<h2>Crear Empleado</h2>
<p>Todos los campos son obligatorios</p>

<div class="contenedor-empleados">
        <form class="formulario-empleados">
            <div class="campos">
                <div class="campo">
                    <label for="nombres">Nombre(s):</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Nombre(s)"
                        id="nombres"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-paterno">Apellido Paterno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Paterno"
                        id="apellido-paterno"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-materno">Apellido Materno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Materno"
                        id="apellido-materno"
                    >
                </div>
                <div class="campo">
                    <label for="usuario">Usuario:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Nombre(s)"
                        id="usuario"
                    >
                </div>
                <div class="campo">
                    <label for="password">Password:</label>
                    <input 
                        type="password"
                        class="input-campo"
                        placeholder="Password"
                        id="password"
                    >
                </div>
                <div class="campo">
                    <label for="departamento">Departamento:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Departamento"
                        id="departamento"
                    >
                </div>
                <div class="campo">
                    <label for="puesto">Puesto:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Puesto"
                        id="puesto"
                    >
                </div>
                <div class="campo">
                
                    <label for="horario">Horario:</label>
                    
                    <select name="horario" id="horario">
                    
                        <option name="horario">Seleccionar</option>
                        <?php $horarios = obtenerHorarios(); 
                        if ($horarios->num_rows) { 

                            foreach($horarios as $horario) { 
                                ?>
                        <option value="<?php echo $horario['dias']; ?> : <?php echo $horario['entrada']; ?> - <?php echo $horario['salida']; ?>"><?php echo $horario['dias']; ?> : <?php echo $horario['entrada']; ?> - <?php echo $horario['salida']; ?></option>
                                <?php  
                            }
                        } ?>
                    </select>
                    
                </div>
                <div class="campo">
                    <label for="activo">Activo:</label>
                    <input 
                        type="checkbox"
                        name="activo"
                        id="activo"
                    >
                </div>
                
            </div>
            <div class="campo">
                    <input type="submit" class="btn-crear" id="crear-empleado" value="Crear Empleado">
            </div>
            
        </form>
</div>

<div class="contenedor-empleados tabla-empleados">
    <table id="listado-empleados">
        <thead>
            <tr>
                <th>Nombre(s)</th>
                <th>Apellido Paterno</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $empleados = obtenerEmpleados(); 
                if ($empleados->num_rows) { 

                    foreach($empleados as $empleado) { ?>

                     <tr>
                        <td><?php echo $empleado['nombres']; ?></td>
                        <td><?php echo $empleado['apellido_paterno']; ?></td>
                        <td><?php echo $empleado['usuario']; ?></td>
                        <td><?php echo $empleado['estado']; ?></td>
                        <td><?php echo $empleado['horario']; ?></td>
                        <td>
                            <a href="editar-empleado.php?id=<?php echo $empleado['id']; ?>" class="btn-editar btn">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button data-id="<?php echo $empleado['id']; ?>" type="button" class="btn-borrar btn">
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



<?php include 'layout/footer.php'; ?>