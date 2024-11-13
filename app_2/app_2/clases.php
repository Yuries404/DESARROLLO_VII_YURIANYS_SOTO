<?php

interface Prestable {
    public function obtenerDetallesPrestamo(): string;

}
abstract class RecursoBiblioteca implements Prestable {
    public $id;
    public $titulo;
    public $autor;
    public $anioPublicacion;
    public $estado;
    public $fechaAdquisicion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

 class libro extends RecursoBiblioteca {
    public $isbn;
    public function obtenerDetallesPrestamo(): string{
        return "ISBN".isbn;

    }
}

class revista  extends RecursoBiblioteca {
    public $numero_edicion;
}

class dvd extends RecursoBiblioteca {
    public $duracion;
}
// Implementar las clases Libro, Revista y DVD aquí

class GestorBiblioteca {
    private $recursos = [];

    public function cargarRecursos() {
        $json = file_get_contents('biblioteca.json');
        $data = json_decode($json, true);
        
        foreach ($data as $recursoData) {
            $recurso = new RecursoBiblioteca($recursoData);
            $this->recursos[] = $recurso;
        }
        
        return $this->recursos;
    }

    // Implementar los demás métodos aquí
}