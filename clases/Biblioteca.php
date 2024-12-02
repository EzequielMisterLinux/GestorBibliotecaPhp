<?php
class Biblioteca {
    private $autores;
    private $categorias;
    private $libros;
    private $prestamos;

    public function __construct(&$autores, &$categorias, &$libros, &$prestamos) {
        $this->autores = &$autores;
        $this->categorias = &$categorias;
        $this->libros = &$libros;
        $this->prestamos = &$prestamos;
    }


    public function buscarLibroPorTitulo($titulo) {
        return array_filter($this->libros, function($libro) use ($titulo) {
            return stripos($libro->getTitulo(), $titulo) !== false;
        });
    }

    public function buscarLibroPorAutor($autor_id) {
        return array_filter($this->libros, function($libro) use ($autor_id) {
            return $libro->getAutorId() === $autor_id;
        });
    }

    public function buscarLibroPorCategoria($categoria_id) {
        return array_filter($this->libros, function($libro) use ($categoria_id) {
            return $libro->getCategoriaId() === $categoria_id;
        });
    }

    public function obtenerLibroPorId($id) {
        foreach ($this->libros as $libro) {
            if ($libro->getId() === $id) {
                return $libro;
            }
        }
        return null;
    }

    public function obtenerAutorPorId($id) {
        foreach ($this->autores as $autor) {
            if ($autor->getId() === $id) {
                return $autor;
            }
        }
        return null;
    }

    public function obtenerCategoriaPorId($id) {
        foreach ($this->categorias as $categoria) {
            if ($categoria->getId() === $id) {
                return $categoria;
            }
        }
        return null;
    }


    public function prestarLibro($libro_id, $usuario) {
        $libro = $this->obtenerLibroPorId($libro_id);
        if ($libro && $libro->estaDisponible()) {
            $libro->prestar();
            $prestamo = new Prestamo(
                count($this->prestamos) + 1, 
                $libro_id, 
                $usuario, 
                date('Y-m-d'), 
                date('Y-m-d', strtotime('+15 days'))
            );
            $this->prestamos[] = $prestamo;
            return $prestamo;
        }
        return false;
    }
}