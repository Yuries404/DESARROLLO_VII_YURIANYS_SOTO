<?php
session_start();

$usuarios = [
    ["nombre" => "Ana","contrasena" => "itsasecret", "rol" => "1"],
    ["nombre" => "Juan","contrasena" => "itsasecret", "rol" => "1"],
    ["nombre" => "Maria", "contrasena" => "itsasecret", "rol" => "1"],
    ["nombre" => "Pedro","contrasena" => "itsasecret", "rol" => "1"],
    ["nombre" => "Ester", "contrasena" => "secret", "rol" => "2"],
    ["nombre" => "Ricardo", "contrasena" => "secret", "rol" => "2"]
];
$datos_estudiantes = [
    ["nombre" => "Ana", "calificaciones" => [85, 92, 78, 96, 88],"docente" => "Ester"],
    ["nombre" => "Juan", "calificaciones" => [75, 84, 91, 79, 86],"docente" => "Ester"],
    ["nombre" => "Maria", "calificaciones" => [92, 95, 89, 97, 93], "docente" => "Ricardo"],
    ["nombre" => "Pedro", "calificaciones" => [70, 72, 78, 75, 77], "docente" => "Ricardo"]
];

if(isset($_SESSION['usuario'])) {
    header("Location: panel.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
   
    foreach ($usuarios as $usuario) {
        if ($usuario == $usuarios["nombre"]){
           $user =$usuarios["nombre"];
           $contra = $usuarios["contrasena"];
           $rol= $usuario ["rol"];
        }
        
    }
    if($usuario === $usuario && $contrasena === $contra) {
       
       if ($rol==1){
        $_SESSION['usuario'] = $usuario;
        header("Location: panel_estu.php");
        exit();
       }
        else {
        $_SESSION['usuario'] = $usuario;
        header("Location: panel_prof.php");
        exit();
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>