<?php

class Prestamo {
    private $id;
    private $libro_id;
    private $usuario;
    private $fechaPrestamo;
    private $fechaDevolucion;
    private $estado;

    public function __construct($id, $libro_id, $usuario, $fechaPrestamo, $fechaDevolucion) {
        $this->id = $id;
        $this->libro_id = $libro_id;
        $this->usuario = $usuario;
        $this->fechaPrestamo = $fechaPrestamo;
        $this->fechaDevolucion = $fechaDevolucion;
        $this->estado = 'Activo';
    }

    public function getId() { return $this->id; }
    public function getLibroId() { return $this->libro_id; }
    public function getUsuario() { return $this->usuario; }
    public function getFechaPrestamo() { return $this->fechaPrestamo; }
    public function getFechaDevolucion() { return $this->fechaDevolucion; }
    public function getEstado() { return $this->estado; }

    public function finalizarPrestamo() {
        $this->estado = 'Completado';
    }


    public function toArray() {
        return [
            'id' => $this->id,
            'libro_id' => $this->libro_id,
            'usuario' => $this->usuario,
            'fechaPrestamo' => $this->fechaPrestamo,
            'fechaDevolucion' => $this->fechaDevolucion,
            'estado' => $this->estado
        ];
    }
}