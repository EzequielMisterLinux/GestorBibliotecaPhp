<?php

$autores = [
    new Autor(1, 'Gabriel García Márquez', 'Colombiano', 'Reconocido novelista y Premio Nobel de Literatura'),
    new Autor(2, 'Jorge Luis Borges', 'Argentino', 'Escritor, poeta y ensayista'),
    new Autor(3, 'Isabel Allende', 'Chilena', 'Novelista y escritora feminista')
];


$categorias = [
    new Categoria(1, 'Novela', 'Obras narrativas extensas'),
    new Categoria(2, 'Poesía', 'Obras poéticas'),
    new Categoria(3, 'Ensayo', 'Obras de reflexión y análisis')
];

$libros = [
    new Libro(1, 'Cien Años de Soledad', 1, 1, '1967-05-30', '9780060883287', 'Obra maestra del realismo mágico'),
    new Libro(2, 'Ficciones', 2, 3, '1944-01-01', '9788432248061', 'Colección de cuentos metafísicos'),
    new Libro(3, 'La Casa de los Espíritus', 3, 1, '1982-01-01', '9780553273717', 'Saga familiar con elementos mágicos')
];

$prestamos = [];