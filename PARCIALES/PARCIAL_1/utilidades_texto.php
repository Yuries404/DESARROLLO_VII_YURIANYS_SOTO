<?php

function contar_palabras($texto) {
    return str_word_count($texto);
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