 <?php

include 'utilidades_texto.php';

$frases = [
    "HOLIIIS, holaa, parcial uno prueba uno a e I O uU",
    "Parcial uno de PHP, prueba dos",
    "parcial uno, tres de septiembre, prueba tres"
];

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Frase </th><th>Cantidad de Palabras</th><th>Cantidad de Vocales</th><th>Frase Invertiida</th></tr>";

foreach ($frases as $frase) {
    $cant_palabras = contar_palabras($frase);
    $cant_vocales = contar_vocales($frase);
    $frase_invertida = invertir_palabras($frase);

    echo "<tr>";
    echo "<td>{$frase}</td>";
    echo "<td>{$cant_palabras}</td>";
    echo "<td>{$cant_vocales}</td>";
    echo "<td>{$frase_invertida}</td>";
    echo "</tr>";
}

echo "</table>";
?>
