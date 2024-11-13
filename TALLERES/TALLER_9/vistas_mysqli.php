<?php
require_once "config_mysqli.php";

function mostrarResumenCategorias($conn) {
    $sql = "SELECT * FROM vista_resumen_categorias";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
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

    while ($row = mysqli_fetch_assoc($result)) {
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
    mysqli_free_result($result);
}

function mostrarProductosPopulares($conn) {
    $sql = "SELECT * FROM vista_productos_populares LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
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

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['producto'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['total_vendido'] ?? 0) . "</td>";
        echo "<td>$" . number_format($row['ingresos_totales'] ?? 0, 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['compradores_unicos'] ?? 0) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarProductosBajoStock ($conn) {
    $sql = "SELECT * FROM vista_productos_bajo_stock";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Productos bajos en Stock</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Venta Total</th>
              </tr>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['producto_nombre'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['stock'] ?? 0) . "</td>";
            echo "<td>$" . number_format($row['total_venta'] ?? 0, 2) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo " <br><br> <h3> No hay productos con bajo stock. </h3> <br><br>";
        mysqli_free_result($result);
    }
}

function mostrarHistorialClientes($conn) {
    $sql = "SELECT * FROM vista_historial_clientes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
        echo "<h3>Historial Clientes</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Venta Total</th>
              </tr>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['cliente_nombre'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['producto_nombre'] ?? 0) . "</td>";
            echo "<td>$" . number_format($row['total_venta'] ?? 0, 2) . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        
    } else {
        echo "No hay historial de clientes.";
        mysqli_free_result($result);
    }
}

function mostrarMetricasPorCategoria($conn) {
    $sql = "SELECT * FROM vista_metricas_categorias";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Metricas por Categoria</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Categoria</th>
                <th>Producto Más Vendido</th>
                <th>Venta Total</th>
              </tr>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['categoria_nombre'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['producto_mas_vendido'] ?? 0) . "</td>";
            echo "<td>$" . number_format($row['ventas_totales'] ?? 0, 2) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No hay métricas de categorías.";
    }
}

mostrarResumenCategorias($conn);
mostrarProductosPopulares($conn);
mostrarProductosBajoStock($conn);
mostrarHistorialClientes($conn);
mostrarMetricasPorCategoria($conn);

mysqli_close($conn);
?>
