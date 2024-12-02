<?php
require_once 'Database.php';

if (isset($_GET['numero_inventario'])) {
    $numero_inventario = $_GET['numero_inventario'];

    try {
        // Conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Obtener los detalles del objeto
        $query = "SELECT * FROM catalogacion WHERE numero_inventario = ?";
        $stmt = $db->prepare($query);
        $stmt->bindValue(1, $numero_inventario, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "No se encontró el objeto.";
            exit;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "Número de inventario no especificado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Objeto</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    header {
      background-color: #004080;
      color: white;
      text-align: center;
      padding: 15px;
    }
    main {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .details-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .image-container {
      flex: 1 1 300px;
      text-align: center;
    }
    .image-container img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    .info-container {
      flex: 2 1 400px;
    }
    .info-container h2 {
      color: #333;
      margin-bottom: 15px;
    }
    .info-container p {
      margin: 5px 0;
      font-size: 16px;
      line-height: 1.5;
    }
    .info-container p strong {
      color: #555;
    }
    .actions {
      margin-top: 20px;
      text-align: center;
    }
    .actions .button {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    .actions .button:hover {
      background-color: #45a049;
    }
    .actions .button.back {
      background-color: #2196F3;
    }
    .actions .button.back:hover {
      background-color: #1E88E5;
    }
  </style>
</head>
<body>
  <header>
    <h1>Detalles del Objeto</h1>
  </header>
  <main>
    <div class="details-container">
      <div class="image-container">
        <?php if (!empty($row['fotografia'])): ?>
          <img src="<?php echo htmlspecialchars($row['fotografia']); ?>" alt="Fotografía del objeto">
        <?php else: ?>
          <p>No hay fotografía disponible.</p>
        <?php endif; ?>
      </div>
      <div class="info-container">
        <h2><?php echo htmlspecialchars($row['nombre_objeto']); ?></h2>
        <p><strong>Número de Inventario:</strong> <?php echo htmlspecialchars($row['numero_inventario']); ?></p>
        <p><strong>Institución:</strong> <?php echo htmlspecialchars($row['nombre_institucion']); ?></p>
        <p><strong>Colección/Tipología:</strong> <?php echo htmlspecialchars($row['coleccion_tipologia']); ?></p>
        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
        <p><strong>Autor/Fabricante/Cultura:</strong> <?php echo htmlspecialchars($row['autor_fabricante_cultura']); ?></p>
        <p><strong>Marco Histórico:</strong> <?php echo htmlspecialchars($row['marco_historico']); ?></p>
        <p><strong>Lugar de Ejecución:</strong> <?php echo htmlspecialchars($row['lugar_ejecucion']); ?></p>
        <p><strong>Fecha de Ejecución/Período:</strong> <?php echo !empty($row['fecha_ejecucion_periodo']) ? date('d-m-Y', strtotime($row['fecha_ejecucion_periodo'])) : 'N/A'; ?></p>
        <p><strong>Material:</strong> <?php echo htmlspecialchars($row['material']); ?></p>
        <p><strong>Técnica:</strong> <?php echo htmlspecialchars($row['tecnica']); ?></p>
        <p><strong>Dimensiones:</strong> <?php echo htmlspecialchars($row['dimensiones']); ?></p>
        <p><strong>Ubicación Actual:</strong> <?php echo htmlspecialchars($row['ubicacion_actual']); ?></p>
      </div>
    </div>
    <div class="actions">
      <a href="../inventario.php" class="button back">Volver al Inventario</a>
    </div>
  </main>
</body>
</html>
