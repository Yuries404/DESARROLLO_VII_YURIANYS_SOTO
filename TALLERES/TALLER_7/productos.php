<?php
require 'config_sesion.php';

$productos = [
    ['id' => 1, 'nombre' => 'GORRA', 'precio' => 5.00],
    ['id' => 2, 'nombre' => 'ABRIGO', 'precio' => 25.00],
    ['id' => 3, 'nombre' => 'PANTALON', 'precio' => 15.00],
    ['id' => 4, 'nombre' => 'SUETER', 'precio' => 10.00],
    ['id' => 5, 'nombre' => 'ZAPATOS', 'precio' => 30.00],
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?> $</td>
            <td>
                <a href="agregar_al_carrito.php?id=<?php echo $producto['id']; ?>">Añadir al carrito</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="ver_carrito.php">Ver carrito</a>
</body>
</html>
