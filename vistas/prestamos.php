<?php

require_once '../clases/Autor.php';
require_once '../clases/Categoria.php';
require_once '../clases/Libro.php';
require_once '../clases/Prestamo.php';
require_once '../clases/Biblioteca.php';
require_once '../datos/datos_biblioteca.php';

$biblioteca = new Biblioteca($autores, $categorias, $libros, $prestamos);
include 'header.php';
?>

<h1>Gestión de Préstamos</h1>

<h2>Realizar Nuevo Préstamo</h2>
<form action="../procesar.php" method="post">
    <input type="hidden" name="accion" value="agregar_prestamo">
    <div>
        <label>Libro:</label>
        <select name="libro_id" required>
            <?php foreach ($libros as $libro): 
                if ($libro->estaDisponible()):
            ?>
                <option value="<?php echo $libro->getId(); ?>">
                    <?php echo htmlspecialchars($libro->getTitulo()); ?>
                </option>
            <?php 
                endif;
            endforeach; 
            ?>
        </select>
    </div>
    <div>
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
    </div>
    <div>
        <label>Fecha de Préstamo:</label>
        <input type="date" name="fecha_prestamo" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <div>
        <label>Fecha de Devolución:</label>
        <input type="date" name="fecha_devolucion" required>
    </div>
    <button type="submit">Registrar Préstamo</button>
</form>

<h2>Préstamos Registrados</h2>
<table>
    <thead>
        <tr>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prestamos as $prestamo): 
            $libro = $biblioteca->obtenerLibroPorId($prestamo->getLibroId());
        ?>
        <tr>
            <td><?php echo htmlspecialchars($libro->getTitulo()); ?></td>
            <td><?php echo htmlspecialchars($prestamo->getUsuario()); ?></td>
            <td><?php echo $prestamo->getFechaPrestamo(); ?></td>
            <td><?php echo $prestamo->getFechaDevolucion(); ?></td>
            <td><?php echo $prestamo->getEstado(); ?></td>
            <td>
                <?php if ($prestamo->getEstado() === 'Activo'): ?>
                <a href="../procesar.php?accion=devolver_libro&id=<?php echo $prestamo->getId(); ?>">Devolver</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>