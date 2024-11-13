<?php
require_once "config_pdo.php";
function mostrarResumenCategorias($pdo) {

    $sql = "SELECT * FROM vista_resumen_categorias";
    try {
        $stmt = $pdo->prepare($sql);
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }

    echo "<h3>Resumen por Categorías:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Stock Total</th>
            <th>Precio Promedio</th>
            <th>Precio Mínimo</th>
            <th>Precio Máximo</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['categoria'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['total_productos'] ?? 0) . "</td>";
        echo "<td>" . htmlspecialchars($row['total_stock'] ?? 0) . "</td>";
        echo "<td>$" . number_format($row['precio_promedio'] ?? 0, 2) . "</td>";
        echo "<td>$" . number_format($row['precio_minimo'] ?? 0, 2) . "</td>";
        echo "<td>$" . number_format($row['precio_maximo'] ?? 0, 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function mostrarProductosPopulares($pdo) {
    $sql = "SELECT * FROM vista_productos_populares LIMIT 5";

    try {
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }

    echo "<h3>Top 5 Productos Más Vendidos:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
            <th>Compradores Únicos</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['producto'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['total_vendido'] ?? 0) . "</td>";
        echo "<td>$" . number_format($row['ingresos_totales'] ?? 0, 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['compradores_unicos'] ?? 0) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function mostrarProductosBajoStock($pdo) {
    $sql = "SELECT * FROM vista_productos_bajo_stock";

    try {
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }

    echo "<h3>Productos bajos en Stock</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Stock</th>
            <th>Total Vendido</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['producto_id']}</td>";
        echo "<td>" . htmlspecialchars($row['producto_nombre']) . "</td>";
        echo "<td>{$row['stock']}</td>";
        echo "<td>{$row['total_venta']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function mostrarHistorialClientes($pdo) {
    $sql = "SELECT * FROM vista_historial_clientes";

    try {
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }
    echo "<h3>Historial Clientes</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Total</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cliente_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['producto_nombre']) . "</td>";
        echo "<td>$" . number_format($row['total_venta'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function mostrarMetricasPorCategoria($pdo) {
    $sql = "SELECT * FROM vista_metricas_categorias";

    try {
        $stmt = $pdo->query($sql);
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }
    echo "<h3>Metricas por Categoria</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Ventas Totales</th>
            <th>Producto Más Vendido</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['categoria_nombre']?? 'N/A') . "</td>";
        echo "<td>$" . number_format($row['ventas_totales'] ?? 0, 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['producto_mas_vendido']??'N/A') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Llamada a las funciones para mostrar los datos
try {
    mostrarResumenCategorias($pdo);
    mostrarProductosPopulares($pdo);
    mostrarProductosBajoStock($pdo);
    mostrarHistorialClientes($pdo);
    mostrarMetricasPorCategoria($pdo);
} catch (PDOException $e) {
    echo "Ha ocurrido un error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null; // PDO cierra la conexión automáticamente al finalizar el script
?>
