<?php
session_start();
require_once 'back/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Consulta para verificar usuario
        $query = "SELECT * FROM usuarios WHERE username = :username LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && hash('sha256', $password) === $user['password']) {
            // Credenciales válidas
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirigir al administrador
            header("Location: index.php");
            exit;
        } else {
            // Credenciales inválidas
            echo "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
