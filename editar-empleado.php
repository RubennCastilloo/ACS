<?php 
include 'inc/sesiones.php';
include 'inc/funciones.php';
include 'layout/header.php'; 

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: empleados.php');
        
    }
    $respuesta = obtenerEmpleado($id);
    $empleado = $respuesta->fetch_assoc();

?>

<h2>Editar Empleado</h2>
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
                        value="<?php echo ($empleado['nombres']) ? $empleado['nombres'] : ''; ?>"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-paterno">Apellido Paterno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Paterno"
                        id="apellido-paterno"
                        value="<?php echo ($empleado['apellido_paterno']) ? $empleado['apellido_paterno'] : ''; ?>"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-materno">Apellido Materno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Materno"
                        id="apellido-materno"
                        value="<?php echo ($empleado['apellido_materno']) ? $empleado['apellido_materno'] : ''; ?>"
                    >
                </div>
                <div class="campo">
                    <label for="usuario">Usuario:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Nombre(s)"
                        id="usuario"
                        value="<?php echo ($empleado['usuario']) ? $empleado['usuario'] : ''; ?>"
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
                        value="<?php echo ($empleado['departamento']) ? $empleado['departamento'] : ''; ?>"
                    >
                </div>
                <div class="campo">
                    <label for="puesto">Puesto:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Puesto"
                        id="puesto"
                        value="<?php echo ($empleado['puesto']) ? $empleado['puesto'] : ''; ?>"
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
                    <input type="hidden" class="ditar-empleado" id="id" value="<?php echo $empleado['id']; ?>">
                    <input type="submit" class="btn-crear editar-empleado" id="" value="Editar Empleado">
            </div>
            
        </form>
</div>



<?php include 'layout/footer.php'; ?>