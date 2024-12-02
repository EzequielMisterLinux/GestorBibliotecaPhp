<?php
require_once 'clases/Autor.php';
require_once 'clases/Categoria.php';
require_once 'clases/Libro.php';
require_once 'clases/Prestamo.php';
require_once 'clases/Biblioteca.php';
require_once 'datos/datos_biblioteca.php';

$biblioteca = new Biblioteca($autores, $categorias, $libros, $prestamos);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;

    switch ($accion) {
        case 'prestar':
            $libro_id = intval($_POST['libro_id']);
            $usuario = $_POST['usuario'] ?? '';

            $resultado = $biblioteca->prestarLibro($libro_id, $usuario);

            if ($resultado) {
                $_SESSION['mensaje'] = "Préstamo realizado con éxito";
            } else {
                $_SESSION['error'] = "No se pudo realizar el préstamo";
            }
            break;

    }


    header('Location: index.php');
    exit();
}