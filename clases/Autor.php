<?php

class Autor {
    private $id;
    private $nombre;
    private $nacionalidad;
    private $biografia;

    public function __construct($id, $nombre, $nacionalidad, $biografia = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->biografia = $biografia;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getNacionalidad() { return $this->nacionalidad; }
    public function getBiografia() { return $this->biografia; }

    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'nacionalidad' => $this->nacionalidad,
            'biografia' => $this->biografia
        ];
    }
}