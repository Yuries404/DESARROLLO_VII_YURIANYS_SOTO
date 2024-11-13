<?php
require_once "config_mysqli.php"; // Configuración de la conexión a MySQL
include 'leer_usuarios_mysqli.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM usuarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Registro eliminado correctamente.";
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="id">ID del Usuario a Eliminar:</label>
    <input type="text" name="id" required><br><br>
    <input type="submit" value="Eliminar Usuario">
</form>
