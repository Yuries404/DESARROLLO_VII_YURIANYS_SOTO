<?php
include 'funciones_tienda.php';

$precio_producto = [
    'camisa' => 50,
    'pantalon' => 70,
    'zapatos' => 80,
    'calcetines' => 10,
    'gorra' => 25
];

$carrito = [
    'camisa' => 2,
    'pantalon' => 1,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 0
];


$subtotal = 0;

foreach ($carrito as $producto  => $cantidad) {
    if ($cantidad > 0) {
        echo $cantidad;
        $subtotal += $precio_producto [$producto] * $cantidad;
    }
}

$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuesto($subtotal);
$total = calcular_total($subtotal, $descuento, $impuesto);

echo "<h2>Resumen de Compra</h2>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></tr>";

foreach ($carrito as $producto => $cantidad) {
    if ($cantidad > 0) {
        $precio_total = $precio_producto[$producto] * $cantidad;
        echo "<tr>";
        echo "<td>{$producto}</td>";
        echo "<td>{$cantidad}</td>";
        echo "<td>\${$precio_producto[$producto]}</td>";
        echo "<td>\${$precio_total}</td>";
        echo "</tr>";
    }
}

echo "</table>";
echo "<p><strong>Subtotal:</strong> \${$subtotal}</p>";
echo "<p><strong>Descuento:</strong> \${$descuento}</p>";
echo "<p><strong>Impuesto:</strong> \${$impuesto}</p>";
echo "<p><strong>Total a Pagar:</strong> \${$total}</p>";
?>
