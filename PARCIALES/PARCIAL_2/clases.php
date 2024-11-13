<?php
// Archivo: clases.php

interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}

class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }
}

class TareaDesarrollo extends Tarea implements Detalle {
    public $lenguajeProgramacion;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->lenguajeProgramacion = $datos['lenguajeProgramacion'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Lenguaje de Programación: " . $this->lenguajeProgramacion;
    }
}

class TareaDiseno extends Tarea implements Detalle {
    public $herramientaDiseno;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->herramientaDiseno = $datos['herramientaDiseno'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Herramienta de Diseño: " . $this->herramientaDiseno;
    }
}

class TareaTesting extends Tarea implements Detalle {
    public $tipoTest;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->tipoTest = $datos['tipoTest'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Tipo de Test: " . $this->tipoTest;
    }
}

class GestorTareas {
    public $tareas = [];

    public function cargarTareas() {
        if (file_exists('tareas.json')) {
            $json = file_get_contents('tareas.json');
            $data = json_decode($json, true);
            foreach ($data as $tareaData) {
                switch ($tareaData['tipo']) {
                    case 'desarrollo':
                        $tarea = new TareaDesarrollo($tareaData);
                        break;
                    case 'diseno':
                        $tarea = new TareaDiseno($tareaData);
                        break;
                    case 'testing':
                        $tarea = new TareaTesting($tareaData);
                        break;
                    default:
                        $tarea = new Tarea($tareaData);
                        break;
                }
                $this->tareas[] = $tarea;
            }
        }
        return $this->tareas;
    }

    public function guardarTareas() {
        $data = [];
        foreach ($this->tareas as $tarea) {
            $data[] = get_object_vars($tarea);
        }
        file_put_contents('tareas.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public function agregarTarea($tarea) {
        $this->tareas[] = $tarea;
        $this->guardarTareas();
    }

    public function eliminarTarea($id) {
        foreach ($this->tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                unset($this->tareas[$key]);
                $this->tareas = array_values($this->tareas); // Reindexar el arreglo
                $this->guardarTareas();
                return true;
            }
        }
        return false;
    }

    public function actualizarTarea($tareaActualizada) {
        foreach ($this->tareas as $key => $tarea) {
            if ($tarea->id == $tareaActualizada->id) {
                $this->tareas[$key] = $tareaActualizada;
                $this->guardarTareas();
                return true;
            }
        }
        return false;
    }

    public function actualizarEstadoTarea($id, $nuevoEstado) {
        foreach ($this->tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                $tarea->estado = $nuevoEstado;
                $this->tareas[$key] = $tarea;
                $this->guardarTareas();
                return true;
            }
        }
        return false;
    }

    public function buscarTareasPorEstado($estado) {
        $tareasFiltradas = [];
        foreach ($this->tareas as $tarea) {
            if ($tarea->estado == $estado) {
                $tareasFiltradas[] = $tarea;
            }
        }
        return $tareasFiltradas;
    }

    public function listarTareas($filtroEstado = '') {
        if ($filtroEstado == '') {
            return $this->tareas;
        } else {
            return $this->buscarTareasPorEstado($filtroEstado);
        }
    }

    public function getNuevoId() {
        $maxId = 0;
        foreach ($this->tareas as $tarea) {
            if ($tarea->id > $maxId) {
                $maxId = $tarea->id;
            }
        }
        return $maxId + 1;
    }
}
