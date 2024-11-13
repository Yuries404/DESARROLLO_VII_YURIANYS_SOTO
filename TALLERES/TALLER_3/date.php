<?php
// Ejemplo de uso de date()
echo "<br><br>Fecha actual: " . date("Y-m-d") . "";
echo "<br><br>Hora actual: " . date("H:i:s") . "";
echo "<br><br>Fecha y hora actuales: " . date("Y-m-d H:i:s") . "";

// Ejercicio: Usa date() para mostrar la fecha actual en el formato "Día de la semana, día de mes de año"
// Por ejemplo: "Lunes, 15 de agosto de 2023"
$fechaFormateada = date("l, j \de F \de Y");
echo "<br><br>Fecha formateada: $fechaFormateada";

// Bonus: Crea una función que devuelva la diferencia en días entre dos fechas
function diasEntre($fecha1, $fecha2) {
    $timestamp1 = strtotime($fecha1);
    $timestamp2 = strtotime($fecha2);
    $diferencia = abs($timestamp2 - $timestamp1);
    return floor($diferencia / (60 * 60 * 24));
}

$fechaInicio = "2024-01-01";
$fechaFin = date("Y-m-d"); // Fecha actual
$diasTranscurridos = diasEntre($fechaInicio, $fechaFin);

echo "<br><br>Días transcurridos desde el $fechaInicio hasta hoy: $diasTranscurridos días";

// Extra: Mostrar zona horaria actual
echo "<br><br>Zona horaria actual: " . date_default_timezone_get() . "";

// Cambiar zona horaria y mostrar la hora
date_default_timezone_set("America/New_York");
echo "<br><br>Hora en New York: " . date("H:i:s") . "";
?>
      
