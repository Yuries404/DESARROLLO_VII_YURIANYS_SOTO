<?php
$nombre = "Yuri";
$edad=25;
$ciudad = "Barcelona";
define("PROFESION", "Ingeniera");

$mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
$mensaje2 = "Vivo en $ciudad y soy " . PROFESION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $ciudad, PROFESION);

echo "<br>Información de debugging:<br>";
var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($ciudad);
echo "<br>";
var_dump(PROFESION);
echo "<br>";
?>