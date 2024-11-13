<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'clases.php';

$gestorTareas = new GestorTareas();
$gestorTareas->cargarTareas();

// Obtener la acción del query string, 'list' por defecto
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Variable para almacenar la tarea en edición
$tareaEnEdicion = null;

// Variables para ordenamiento y filtrado
$sortField = isset($_GET['field']) ? $_GET['field'] : 'id';
$sortDirection = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
$filterEstado = isset($_GET['filterEstado']) ? $_GET['filterEstado'] : '';

$tareas = null;

$estadosLegibles = [
    'pendiente' => 'Pendiente',
    'en_progreso' => 'En Progreso',
    'completada' => 'Completada'
];

$prioridadesLegibles = [
    1 => 'Alta',
    2 => 'Media alta',
    3 => 'Media',
    4 => 'Media baja',
    5 => 'Baja'
];

// Procesar la acción
switch ($action) {
    case 'add':
        // Obtener datos del formulario
        $titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
        $descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : '';
        $prioridad = isset($_GET['prioridad']) ? $_GET['prioridad'] : '';
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
        $estado = 'pendiente'; // Estado por defecto
        $fechaCreacion = date('Y-m-d');

        // Generar nuevo ID
        $nuevoId = $gestorTareas->getNuevoId();

        // Crear la tarea correspondiente
        switch ($tipo) {
            case 'desarrollo':
                $lenguajeProgramacion = isset($_GET['lenguajeProgramacion']) ? $_GET['lenguajeProgramacion'] : '';
                $datos = [
                    'id' => $nuevoId,
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'prioridad' => $prioridad,
                    'tipo' => $tipo,
                    'estado' => $estado,
                    'fechaCreacion' => $fechaCreacion,
                    'lenguajeProgramacion' => $lenguajeProgramacion
                ];
                $tarea = new TareaDesarrollo($datos);
                break;
            case 'diseno':
                $herramientaDiseno = isset($_GET['herramientaDiseno']) ? $_GET['herramientaDiseno'] : '';
                $datos = [
                    'id' => $nuevoId,
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'prioridad' => $prioridad,
                    'tipo' => $tipo,
                    'estado' => $estado,
                    'fechaCreacion' => $fechaCreacion,
                    'herramientaDiseno' => $herramientaDiseno
                ];
                $tarea = new TareaDiseno($datos);
                break;
            case 'testing':
                $tipoTest = isset($_GET['tipoTest']) ? $_GET['tipoTest'] : '';
                $datos = [
                    'id' => $nuevoId,
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'prioridad' => $prioridad,
                    'tipo' => $tipo,
                    'estado' => $estado,
                    'fechaCreacion' => $fechaCreacion,
                    'tipoTest' => $tipoTest
                ];
                $tarea = new TareaTesting($datos);
                break;
            default:
                $mensaje = "Tipo de tarea no válido.";
                break;
        }

        if (isset($tarea)) {
            $gestorTareas->agregarTarea($tarea);
            $mensaje = "Tarea agregada correctamente.";
        } else {
            if (!isset($mensaje)) {
                $mensaje = "Error al agregar la tarea.";
            }
        }

        $tareas = $gestorTareas->listarTareas();
        break;

    case 'edit':
        if (isset($_GET['id']) && !isset($_GET['titulo'])) {
            // Mostrar datos en el formulario para editar
            $id = $_GET['id'];
            foreach ($gestorTareas->tareas as $tarea) {
                if ($tarea->id == $id) {
                    $tareaEnEdicion = $tarea;
                    break;
                }
            }
            $tareas = $gestorTareas->listarTareas();
        } elseif (isset($_GET['id']) && isset($_GET['titulo'])) {
            // Actualizar la tarea
            $id = $_GET['id'];
            $titulo = $_GET['titulo'];
            $descripcion = $_GET['descripcion'];
            $prioridad = $_GET['prioridad'];
            $tipo = $_GET['tipo'];
            $estado = isset($_GET['estado']) ? $_GET['estado'] : 'pendiente';

            switch ($tipo) {
                case 'desarrollo':
                    $lenguajeProgramacion = isset($_GET['lenguajeProgramacion']) ? $_GET['lenguajeProgramacion'] : '';
                    $datos = [
                        'id' => $id,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'prioridad' => $prioridad,
                        'tipo' => $tipo,
                        'estado' => $estado,
                        'fechaCreacion' => date('Y-m-d'),
                        'lenguajeProgramacion' => $lenguajeProgramacion
                    ];
                    $tareaActualizada = new TareaDesarrollo($datos);
                    break;
                case 'diseno':
                    $herramientaDiseno = isset($_GET['herramientaDiseno']) ? $_GET['herramientaDiseno'] : '';
                    $datos = [
                        'id' => $id,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'prioridad' => $prioridad,
                        'tipo' => $tipo,
                        'estado' => $estado,
                        'fechaCreacion' => date('Y-m-d'),
                        'herramientaDiseno' => $herramientaDiseno
                    ];
                    $tareaActualizada = new TareaDiseno($datos);
                    break;
                case 'testing':
                    $tipoTest = isset($_GET['tipoTest']) ? $_GET['tipoTest'] : '';
                    $datos = [
                        'id' => $id,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'prioridad' => $prioridad,
                        'tipo' => $tipo,
                        'estado' => $estado,
                        'fechaCreacion' => date('Y-m-d'),
                        'tipoTest' => $tipoTest
                    ];
                    $tareaActualizada = new TareaTesting($datos);
                    break;
                default:
                    $mensaje = "Tipo de tarea no válido.";
                    break;
            }

            if (isset($tareaActualizada)) {
                $gestorTareas->actualizarTarea($tareaActualizada);
                $mensaje = "Tarea actualizada correctamente.";
            } else {
                if (!isset($mensaje)) {
                    $mensaje = "Error al actualizar la tarea.";
                }
            }

            $tareas = $gestorTareas->listarTareas();
        } else {
            $mensaje = "Datos incompletos para editar la tarea.";
            $tareas = $gestorTareas->listarTareas();
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $resultado = $gestorTareas->eliminarTarea($id);
            if ($resultado) {
                $mensaje = "Tarea eliminada correctamente.";
            } else {
                $mensaje = "No se pudo eliminar la tarea.";
            }
        } else {
            $mensaje = "ID de tarea no especificado.";
        }
        $tareas = $gestorTareas->listarTareas();
        break;

    case 'status':
        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $id = $_GET['id'];
            $nuevoEstado = $_GET['estado'];
            $resultado = $gestorTareas->actualizarEstadoTarea($id, $nuevoEstado);
            if ($resultado) {
                $mensaje = "Estado de la tarea actualizado correctamente.";
            } else {
                $mensaje = "No se pudo actualizar el estado de la tarea.";
            }
        } else {
            $mensaje = "Datos incompletos para actualizar el estado de la tarea.";
        }
        $tareas = $gestorTareas->listarTareas();
        break;

    case 'filter':
        $filterEstado = isset($_GET['filterEstado']) ? $_GET['filterEstado'] : '';
        $tareas = $gestorTareas->listarTareas($filterEstado);
        break;

    case 'sort':
        $sortField = isset($_GET['field']) ? $_GET['field'] : 'id';
        $sortDirection = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
        $tareas = $gestorTareas->listarTareas($filterEstado);
        usort($tareas, function($a, $b) use ($sortField, $sortDirection) {
            if ($sortDirection == 'ASC') {
                return strcmp($a->$sortField, $b->$sortField);
            } else {
                return strcmp($b->$sortField, $a->$sortField);
            }
        });
        break;

    case 'list':
    default:
        $tareas = $gestorTareas->listarTareas($filterEstado);
        break;
}

// Cargar las tareas si aún no se han cargado
if ($tareas === null) {
    $tareas = $gestorTareas->listarTareas($filterEstado);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestor de Tareas</h1>
        
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para agregar/editar tarea -->
        <form action="index.php" method="GET" class="row g-3 mb-4 align-items-end">
            <input type="hidden" name="action" value="<?php echo $tareaEnEdicion ? 'edit' : 'add'; ?>">
            <?php if ($tareaEnEdicion): ?>
                <input type="hidden" name="id" value="<?php echo $tareaEnEdicion->id; ?>">
            <?php endif; ?>
            
            <div class="col">
                <input type="text" class="form-control" name="titulo" placeholder="Título" required
                       value="<?php echo $tareaEnEdicion ? $tareaEnEdicion->titulo : ''; ?>">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required
                       value="<?php echo $tareaEnEdicion ? $tareaEnEdicion->descripcion : ''; ?>">
            </div>
            <div class="col">
                <select class="form-select" name="prioridad" required>
                    <option value="">Prioridad</option>
                    <?php
                    foreach ($prioridadesLegibles as $valor => $texto) {
                        $selected = ($tareaEnEdicion && $tareaEnEdicion->prioridad == $valor) ? 'selected' : '';
                        echo "<option value=\"$valor\" $selected>$valor ($texto)</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-select" name="tipo" required id="tipoTarea">
                    <option value="">Tipo de Tarea</option>
                    <option value="desarrollo" <?php echo ($tareaEnEdicion && $tareaEnEdicion->tipo == 'desarrollo') ? 'selected' : ''; ?>>Desarrollo</option>
                    <option value="diseno" <?php echo ($tareaEnEdicion && $tareaEnEdicion->tipo == 'diseno') ? 'selected' : ''; ?>>Diseño</option>
                    <option value="testing" <?php echo ($tareaEnEdicion && $tareaEnEdicion->tipo == 'testing') ? 'selected' : ''; ?>>Testing</option>
                </select>
            </div>
            <div class="col" id="campoEspecifico" style="display:none;">
                <input type="text" class="form-control" id="campoDesarrollo" name="lenguajeProgramacion" placeholder="Lenguaje de Programación" style="display:none;"
                       value="<?php echo $tareaEnEdicion && isset($tareaEnEdicion->lenguajeProgramacion) ? $tareaEnEdicion->lenguajeProgramacion : ''; ?>">
                <input type="text" class="form-control" id="campoDiseno" name="herramientaDiseno" placeholder="Herramienta de Diseño" style="display:none;"
                       value="<?php echo $tareaEnEdicion && isset($tareaEnEdicion->herramientaDiseno) ? $tareaEnEdicion->herramientaDiseno : ''; ?>">
                <select class="form-select" id="campoTesting" name="tipoTest" style="display:none;">
                    <option value="">Tipo de Test</option>
                    <option value="unitario" <?php echo ($tareaEnEdicion && isset($tareaEnEdicion->tipoTest) && $tareaEnEdicion->tipoTest == 'unitario') ? 'selected' : ''; ?>>Unitario</option>
                    <option value="integracion" <?php echo ($tareaEnEdicion && isset($tareaEnEdicion->tipoTest) && $tareaEnEdicion->tipoTest == 'integracion') ? 'selected' : ''; ?>>Integración</option>
                    <option value="e2e" <?php echo ($tareaEnEdicion && isset($tareaEnEdicion->tipoTest) && $tareaEnEdicion->tipoTest == 'e2e') ? 'selected' : ''; ?>>E2E</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <?php echo $tareaEnEdicion ? 'Actualizar Tarea' : 'Agregar Tarea'; ?>
                </button>
            </div>
        </form>

        <!-- Filtro por estado -->
        <form action="index.php" method="GET" class="row g-3 mb-4 align-items-end">
            <input type="hidden" name="action" value="filter">
            <div class="col-auto">
                <select name="filterEstado" class="form-select">
                    <option value="">Todos los estados</option>
                    <?php
                    foreach ($estadosLegibles as $valor => $texto) {
                        $selected = $filterEstado == $valor ? 'selected' : '';
                        echo "<option value=\"$valor\" $selected>$texto</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <!-- Tabla de tareas -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><a href="index.php?action=sort&field=id&direction=<?php echo $sortField == 'id' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">ID <?php echo $sortField == 'id' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=titulo&direction=<?php echo $sortField == 'titulo' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Título <?php echo $sortField == 'titulo' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=descripcion&direction=<?php echo $sortField == 'descripcion' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Descripción <?php echo $sortField == 'descripcion' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=estado&direction=<?php echo $sortField == 'estado' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Estado <?php echo $sortField == 'estado' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=prioridad&direction=<?php echo $sortField == 'prioridad' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Prioridad <?php echo $sortField == 'prioridad' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=tipo&direction=<?php echo $sortField == 'tipo' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Tipo <?php echo $sortField == 'tipo' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th><a href="index.php?action=sort&field=fechaCreacion&direction=<?php echo $sortField == 'fechaCreacion' && $sortDirection == 'ASC' ? 'DESC' : 'ASC'; ?>">Fecha Creación <?php echo $sortField == 'fechaCreacion' ? ($sortDirection == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
                    <th>Detalles Específicos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr>
                        <td><?php echo $tarea->id; ?></td>
                        <td><?php echo $tarea->titulo; ?></td>
                        <td><?php echo $tarea->descripcion; ?></td>
                        <td><?php echo isset($estadosLegibles[$tarea->estado]) ? $estadosLegibles[$tarea->estado] : $tarea->estado; ?></td>
                        <td><?php echo isset($prioridadesLegibles[$tarea->prioridad]) ? $prioridadesLegibles[$tarea->prioridad] : $tarea->prioridad; ?></td>
                        <td><?php echo ucfirst($tarea->tipo); ?></td>
                        <td><?php echo $tarea->fechaCreacion; ?></td>
                        <td><?php echo method_exists($tarea, 'obtenerDetallesEspecificos') ? $tarea->obtenerDetallesEspecificos() : ''; ?></td>
                        <td>
                            <a href='index.php?action=edit&id=<?php echo $tarea->id; ?>' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a>
                            <a href='index.php?action=delete&id=<?php echo $tarea->id; ?>' class='btn btn-sm btn-danger' onclick="return confirm('¿Está seguro de que desea eliminar esta tarea?');"><i class='fas fa-trash'></i></a>
                            <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-secondary dropdown-toggle' data-bs-toggle='dropdown'>
                                    Estado
                                </button>
                                <ul class='dropdown-menu'>
                                    <?php
                                    foreach ($estadosLegibles as $valor => $texto) {
                                        echo "<li><a class='dropdown-item' href='index.php?action=status&id={$tarea->id}&estado={$valor}'>{$texto}</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function mostrarCamposEspecificos() {
        const tipoTarea = document.getElementById('tipoTarea').value;
        const campoEspecifico = document.getElementById('campoEspecifico');
        const campoDesarrollo = document.getElementById('campoDesarrollo');
        const campoDiseno = document.getElementById('campoDiseno');
        const campoTesting = document.getElementById('campoTesting');
        
        campoEspecifico.style.display = 'none';
        campoDesarrollo.style.display = 'none';
        campoDiseno.style.display = 'none';
        campoTesting.style.display = 'none';
        
        switch(tipoTarea) {
            case 'desarrollo':
                campoEspecifico.style.display = 'block';
                campoDesarrollo.style.display = 'block';
                break;
            case 'diseno':
                campoEspecifico.style.display = 'block';
                campoDiseno.style.display = 'block';
                break;
            case 'testing':
                campoEspecifico.style.display = 'block';
                campoTesting.style.display = 'block';
                break;
        }
    }

    document.getElementById('tipoTarea').addEventListener('change', mostrarCamposEspecificos);

    // Ejecutar al cargar la página
    window.onload = function() {
        mostrarCamposEspecificos();
    }
    </script>
</body>
</html>
