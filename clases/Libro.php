<?php
class Libro {
    private $id;
    private $titulo;
    private $autor_id;
    private $categoria_id;
    private $disponible;
    private $fechaPublicacion;
    private $isbn;
    private $resumen;

    public function __construct($id, $titulo, $autor_id, $categoria_id, $fechaPublicacion, $isbn = '', $resumen = '') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor_id = $autor_id;
        $this->categoria_id = $categoria_id;
        $this->disponible = true;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->isbn = $isbn;
        $this->resumen = $resumen;
    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutorId() { return $this->autor_id; }
    public function getCategoriaId() { return $this->categoria_id; }
    public function getFechaPublicacion() { return $this->fechaPublicacion; }
    public function getIsbn() { return $this->isbn; }
    public function getResumen() { return $this->resumen; }

    public function estaDisponible() { return $this->disponible; }

    public function prestar() {
        if ($this->disponible) {
            $this->disponible = false;
            return true;
        }
        return false;
    }

    public function devolver() {
        $this->disponible = true;
    }


    public function toArray() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'autor_id' => $this->autor_id,
            'categoria_id' => $this->categoria_id,
            'disponible' => $this->disponible,
            'fechaPublicacion' => $this->fechaPublicacion,
            'isbn' => $this->isbn,
            'resumen' => $this->resumen
        ];
    }
}