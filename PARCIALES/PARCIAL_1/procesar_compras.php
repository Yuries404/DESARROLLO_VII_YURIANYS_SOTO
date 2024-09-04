<?php
include 'funciones_tienda.php';

$precio_producto = [
    'camisa' => 20,
    'pantalon' => 50,
    'zapatos' => 75,
    'calcetines' => 5,
    'gorra' => 15
];

$carrito = [
    'camisa' => 2,
    'pantalon' => 2,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 2
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
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></tr>";

foreach ($carrito as $producto => $cantidad) {

        $precio_total = $precio_producto[$producto] * $cantidad;
        echo "<tr><tr>";
        echo "<td>{$producto}</td>";
        echo "<td>{$cantidad}</td>";
        echo "<td>\${$precio_producto[$producto]}</td>";
        echo "<td>\${$precio_total}</td>";
        echo "</tr>";
}

echo "</table>";
echo "<p><strong>Subtotal:</strong> \${$subtotal}</p>";
echo "<p><strong>Descuento:</strong> \${$descuento}</p>";
echo "<p><strong>Impuesto:</strong> \${$impuesto}</p>";
echo "<p><strong>Total a Pagar:</strong> \${$total}</p>";
?>
