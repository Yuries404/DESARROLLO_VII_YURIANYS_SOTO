<?php

function contar_palabras($texto) {
    $palabras = explode(' ', $texto);
    return count($palabras);
}

function contar_vocales($texto) {
    preg_match_all('/[aeiouAEIOU]/i', $texto, $coincidencias);
    return count($coincidencias[0]);
}

function invertir_palabras($texto) {
    $palabras = explode(' ', $texto);
    $palabras = array_reverse($palabras);
    return implode(' ', $palabras);
}
?>