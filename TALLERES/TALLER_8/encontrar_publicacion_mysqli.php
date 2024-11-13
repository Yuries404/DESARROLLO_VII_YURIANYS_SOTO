<?php
require_once "config_mysqli.php";

$sql = "SELECT usuarios.nombre, publicaciones.titulo, publicaciones.fecha_publicacion 
        FROM publicaciones 
        JOIN usuarios ON publicaciones.usuario_id = usuarios.id 
        WHERE publicaciones.fecha_publicacion = (
            SELECT MAX(p.fecha_publicacion)
            FROM publicaciones p
            WHERE p.usuario_id = publicaciones.usuario_id
        )";


if($result = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_assoc($result)){
        echo "Usuario: " . $row['nombre'] . " - Última publicación: " . $row['titulo'] . " - Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
} else{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
