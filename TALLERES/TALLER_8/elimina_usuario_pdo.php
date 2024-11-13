<?php
require_once "config_pdo.php"; // Configuración de la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM usuarios WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()){
            echo "Registro eliminado correctamente.";
        } else{
            echo "ERROR: No se pudo ejecutar la consulta.";
        }
    }
}
include 'leer_usuarios_pdo.php';
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="id">ID del Usuario a Eliminar:</label>
    <input type="text" name="id" required><br><br>
    <input type="submit" value="Eliminar Usuario">
</form>
