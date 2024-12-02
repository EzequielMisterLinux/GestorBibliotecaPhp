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

<h1>Gestión de Libros</h1>

<h2>Agregar Nuevo Libro</h2>
<form action="../procesar.php" method="post">
    <input type="hidden" name="accion" value="agregar_libro">
    <div>
        <label>Título:</label>
        <input type="text" name="titulo" required>
    </div>
    <div>
        <label>Autor:</label>
        <select name="autor_id" required>
            <?php foreach ($autores as $autor): ?>
                <option value="<?php echo $autor->getId(); ?>">
                    <?php echo htmlspecialchars($autor->getNombre()); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Categoría:</label>
        <select name="categoria_id" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria->getId(); ?>">
                    <?php echo htmlspecialchars($categoria->getNombre()); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Fecha de Publicación:</label>
        <input type="date" name="fecha_publicacion" required>
    </div>
    <div>
        <label>ISBN:</label>
        <input type="text" name="isbn">
    </div>
    <div>
        <label>Resumen:</label>
        <textarea name="resumen"></textarea>
    </div>
    <button type="submit">Agregar Libro</button>
</form>

<h2>Libros Registrados</h2>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Categoría</th>
            <th>Fecha Publicación</th>
            <th>Disponibilidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro): 
            $autor = $biblioteca->obtenerAutorPorId($libro->getAutorId());
            $categoria = $biblioteca->obtenerCategoriaPorId($libro->getCategoriaId());
        ?>
        <tr>
            <td><?php echo htmlspecialchars($libro->getTitulo()); ?></td>
            <td><?php echo htmlspecialchars($autor->getNombre()); ?></td>
            <td><?php echo htmlspecialchars($categoria->getNombre()); ?></td>
            <td><?php echo $libro->getFechaPublicacion(); ?></td>
            <td><?php echo $libro->estaDisponible() ? 'Disponible' : 'Prestado'; ?></td>
            <td>
                <a href="../procesar.php?accion=editar_libro&id=<?php echo $libro->getId(); ?>">Editar</a>
                <a href="../procesar.php?accion=eliminar_libro&id=<?php echo $libro->getId(); ?>" onclick="return confirm('¿Está seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>