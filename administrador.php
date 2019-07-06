<?php 
include 'inc/sesiones.php';
include 'inc/funciones.php';
include 'layout/header.php'; 
?>

<h2>Crear Administradores</h2>
<p>Todos los campos son obligatorios</p>

<div class="contenedor-empleados">
        <form class="formulario-empleados">
            <div class="campos">
                <div class="campo">
                    <label for="nombres-admin">Nombre(s):</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Nombre(s)"
                        id="nombres-admin"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-paterno-admin">Apellido Paterno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Paterno"
                        id="apellido-paterno-admin"
                    >
                </div>
                <div class="campo">
                    <label for="apellido-materno-admin">Apellido Materno:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Apellido Materno"
                        id="apellido-materno-admin"
                    >
                </div>
                <div class="campo">
                    <label for="usuario-admin">Usuario:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Usuario"
                        id="usuario-admin"
                    >
                </div>
                <div class="campo">
                    <label for="password-admin">Password:</label>
                    <input 
                        type="password"
                        class="input-campo"
                        placeholder="Password"
                        id="password-admin"
                    >
                </div>
                <div class="campo">
                    <label for="departamento-admin">Departamento:</label>
                    <input 
                        type="text"
                        class="input-campo"
                        placeholder="Departamento"
                        id="departamento-admin"
                    >
                </div>
            <div class="campo">
                    <input type="submit" class="btn-crear" id="crear-admin" value="Crear Administrador">
            </div>
            
        </form>
</div>



<div class="contenedor-empleados tabla-empleados">
    <table id="listado-administradores">
        <thead>
            <tr>
                <th>Nombre(s)</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Departamento</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php $administradores = obtenerAdministradores(); 
                if ($administradores->num_rows) { 

                    foreach($administradores as $administrador) { ?>

                     <tr>
                        <td><?php echo $administrador['nombres']; ?></td>
                        <td><?php echo $administrador['apellido_paterno']; ?></td>
                        <td><?php echo $administrador['usuario']; ?></td>
                        <td><?php echo $administrador['departamento']; ?></td>
                        <td>
                            <button data-id="<?php echo $administrador['id']; ?>" type="button" class="btn-borrar btn">
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