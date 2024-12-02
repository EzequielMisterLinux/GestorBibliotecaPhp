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

<h1>Gestión de Autores</h1>

<h2>Agregar Nuevo Autor</h2>
<form action="../procesar.php" method="post">
    <input type="hidden" name="accion" value="agregar_autor">
    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label>Nacionalidad:</label>
        <input type="text" name="nacionalidad" required>
    </div>
    <div>
        <label>Biografía:</label>
        <textarea name="biografia"></textarea>
    </div>
    <button type="submit">Agregar Autor</button>
</form>

<h2>Autores Registrados</h2>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Biografía</th>
            <th>Libros</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($autores as $autor): 
            $libros_autor = $biblioteca->buscarLibroPorAutor($autor->getId());
        ?>
        <tr>
            <td><?php echo htmlspecialchars($autor->getNombre()); ?></td>
            <td><?php echo htmlspecialchars($autor->getNacionalidad()); ?></td>
            <td><?php echo htmlspecialchars($autor->getBiografia()); ?></td>
            <td>
                <?php 
                foreach ($libros_autor as $libro) {
                    echo htmlspecialchars($libro->getTitulo()) . "<br>";
                }
                ?>
            </td>
            <td>
                <a href="../procesar.php?accion=editar_autor&id=<?php echo $autor->getId(); ?>">Editar</a>
                <a href="../procesar.php?accion=eliminar_autor&id=<?php echo $autor->getId(); ?>" onclick="return confirm('¿Está seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>