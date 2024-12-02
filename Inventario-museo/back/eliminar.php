<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numero_inventario'])) {
    $numero_inventario = $_GET['numero_inventario'];

    try {
        // Conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Obtener la ruta de la fotografía asociada al registro
        $querySelect = "SELECT fotografia FROM catalogacion WHERE numero_inventario = ?";
        $stmtSelect = $db->prepare($querySelect);
        $stmtSelect->bindParam(1, $numero_inventario, PDO::PARAM_STR);
        $stmtSelect->execute();
        $fotografia = $stmtSelect->fetch(PDO::FETCH_ASSOC)['fotografia'];
        $stmtSelect->closeCursor();

        // Eliminar el registro de la base de datos
        $queryDelete = "DELETE FROM catalogacion WHERE numero_inventario = ?";
        $stmtDelete = $db->prepare($queryDelete);
        $stmtDelete->bindParam(1, $numero_inventario, PDO::PARAM_STR);

        if ($stmtDelete->execute()) {
            // Si el registro se eliminó, también eliminamos la fotografía del servidor
            if (!empty($fotografia) && file_exists($fotografia)) {
                unlink($fotografia); // Eliminar el archivo de fotografía
            }
            echo "Registro eliminado correctamente.";
            header('Location: ../inventario.php');
            exit;
        } else {
            echo "Error al eliminar el registro.";
        }

        $stmtDelete = null;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Número de inventario no especificado.";
}
