<?php
require_once 'Database.php';

try {
    // Conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Construcción de la consulta SQL con filtro de búsqueda
    $searchQuery = "";
    if (!empty($search)) {
        $searchQuery = "WHERE numero_inventario LIKE :search 
                         OR nombre_objeto LIKE :search 
                         OR autor_fabricante_cultura LIKE :search 
                         OR titulo LIKE :search";
    }

    // Consulta para obtener el inventario
    $query = "SELECT 
                numero_inventario, 
                nombre_objeto, 
                descripcion, 
                autor_fabricante_cultura, 
                fecha_ejecucion_periodo, 
                ubicacion_actual, 
                fotografia 
              FROM catalogacion 
              $searchQuery";
    $stmt = $db->prepare($query);

    if (!empty($search)) {
        $searchParam = '%' . $search . '%';
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }

    $stmt->execute();

    // Generar la tabla HTML
    echo "<table border='1' cellspacing='0' cellpadding='5' class='tabla_inventario'>";
    echo "<tr>
            <th>Nº de Inventario</th>
            <th>Nombre del Objeto</th>
            <th>Descripción</th>
            <th>Autor/Fabricante/Cultura</th>
            <th>Fecha de Ejecución</th>
            <th>Ubicación Actual</th>
            <th>Fotografía</th>
            <th>Acciones</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Convertir fecha al formato DD-MM-YYYY
        $fechaEjecucion = !empty($row['fecha_ejecucion_periodo']) 
            ? date('d-m-Y', strtotime($row['fecha_ejecucion_periodo']))
            : 'N/A'; // Mostrar 'N/A' si no hay fecha
        
        $rutaFoto = !empty($row['fotografia']) ? $row['fotografia'] : 'no-image.png'; // Imagen por defecto si no hay foto

        echo "<tr>
                <td>{$row['numero_inventario']}</td>
                <td>{$row['nombre_objeto']}</td>
                <td>{$row['descripcion']}</td>
                <td>{$row['autor_fabricante_cultura']}</td>
                <td>{$fechaEjecucion}</td>
                <td>{$row['ubicacion_actual']}</td>
                <td><img src='back/{$rutaFoto}' alt='Fotografía' width='100'></td>
                <td>
                  <a href='back/ver.php?numero_inventario={$row['numero_inventario']}' class='button view'>Información</a>
                  <a href='back/editar.php?numero_inventario={$row['numero_inventario']}' class='button edit'>Editar</a> 
                  <a href='back/eliminar.php?numero_inventario={$row['numero_inventario']}' class='button delete' onclick='return confirm(\"¿Está seguro de eliminar este registro?\");'>Eliminar</a>
                </td>
              </tr>";
    }

    if ($stmt->rowCount() === 0) {
        echo "<tr><td colspan='8'>No se encontraron resultados para la búsqueda.</td></tr>";
    }

    echo "</table>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
