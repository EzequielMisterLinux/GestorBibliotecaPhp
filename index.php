<?php
require_once 'clases/Autor.php';
require_once 'clases/Categoria.php';
require_once 'clases/Libro.php';
require_once 'clases/Prestamo.php';
require_once 'clases/Biblioteca.php';
require_once 'datos/datos_biblioteca.php';


$biblioteca = new Biblioteca($autores, $categorias, $libros, $prestamos);
include 'header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Biblioteca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .disponible { color: green; }
        .no-disponible { color: red; }
    </style>
</head>
<body>
    <h1>Sistema de Gestión de Biblioteca</h1>

    <h2>Libros Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoría</th>
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
                <td class="<?php echo $libro->estaDisponible() ? 'disponible' : 'no-disponible'; ?>">
                    <?php echo $libro->estaDisponible() ? 'Disponible' : 'Prestado'; ?>
                </td>
                <td>
                    <?php if ($libro->estaDisponible()): ?>
                    <form action="procesar.php" method="post">
                        <input type="hidden" name="accion" value="prestar">
                        <input type="hidden" name="libro_id" value="<?php echo $libro->getId(); ?>">
                        <input type="text" name="usuario" placeholder="Nombre del usuario" required>
                        <button type="submit">Prestar</button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Préstamos Activos</h2>
    <table>
        <thead>
            <tr>
            <th>Libro</th>
                <th>Usuario</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
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
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>