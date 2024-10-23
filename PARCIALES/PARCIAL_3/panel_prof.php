<?php
session_start();

$datos_estudiantes = [
    ["nombre" => "Ana", "calificaciones" => [85, 92, 78, 96, 88],"docente" => "Ester"],
    ["nombre" => "Juan", "calificaciones" => [75, 84, 91, 79, 86],"docente" => "Ester"],
    ["nombre" => "Maria", "calificaciones" => [92, 95, 89, 97, 93], "docente" => "Ricardo"],
    ["nombre" => "Pedro", "calificaciones" => [70, 72, 78, 75, 77], "docente" => "Ricardo"]
];

if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Profesor</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <p>Esta es tu área personal.</p>
    <?php
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Nombre </th><th>Notas</th></tr>";
    if ($usuario= "Ester"){
        
    }
    else {

    }

    ?>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>