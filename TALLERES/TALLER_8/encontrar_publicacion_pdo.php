<?php
require_once "config_pdo.php";

$sql = "SELECT usuarios.nombre, publicaciones.titulo, publicaciones.fecha_publicacion 
        FROM publicaciones 
        JOIN usuarios ON publicaciones.usuario_id = usuarios.id 
        WHERE publicaciones.fecha_publicacion = (
            SELECT MAX(p.fecha_publicacion)
            FROM publicaciones p
            WHERE p.usuario_id = publicaciones.usuario_id
        )";


$stmt = $pdo->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
    echo "Usuario: " . $row['nombre'] . " - Última publicación: " . $row['titulo'] . " - Fecha: " . $row['fecha_publicacion'] . "<br>";
}
?>
