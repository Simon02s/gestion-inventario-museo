<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numero_inventario'])) {
    $numero_inventario = $_GET['numero_inventario'];

    try {
        // Conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Obtener los datos del registro a editar
        $query = "SELECT * FROM catalogacion WHERE numero_inventario = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$numero_inventario]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $row = $result;
        } else {
            echo "No se encontró el registro.";
            exit;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar la actualización
    try {
        $database = new Database();
        $db = $database->getConnection();

        // Obtener datos enviados por el formulario
        $numero_inventario = $_POST['numero_inventario'];
        $nombre_institucion = $_POST['nombre_institucion'];
        $numero_inventario_anterior = $_POST['numero_inventario_anterior'];
        $registro_provisorio = $_POST['registro_provisorio'];
        $catalogacion_clasificacion = $_POST['catalogacion_clasificacion'];
        $coleccion_tipologia = $_POST['coleccion_tipologia'];
        $nombre_objeto = $_POST['nombre_objeto'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $autor_fabricante_cultura = $_POST['autor_fabricante_cultura'];
        $marco_historico = $_POST['marco_historico'];
        $lugar_ejecucion = $_POST['lugar_ejecucion'];
        $fecha_ejecucion_periodo = $_POST['fecha_ejecucion_periodo'];
        $material = $_POST['material'];
        $tecnica = $_POST['tecnica'];
        $inscripciones_marcas = $_POST['inscripciones_marcas'];
        $dimensiones = $_POST['dimensiones'];
        $peso = $_POST['peso'];
        $ubicacion_actual = $_POST['ubicacion_actual'];

        // Manejo de la fotografía
        $directorioUploads = "uploads/";
        $nuevaFotografia = null;
        $rutaFotografia = $_POST['fotografia_actual']; // Ruta actual

        if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
            // Crear el directorio si no existe
            if (!is_dir($directorioUploads)) {
                mkdir($directorioUploads, 0777, true);
            }

            // Obtener la extensión del archivo subido
            $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);

            // Nombre del archivo basado en el número de inventario
            $nuevaFotografia = $directorioUploads . $numero_inventario . "." . $extension;

            // Mover el archivo subido al directorio de destino
            if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $nuevaFotografia)) {
                // Si ya existía una fotografía, eliminarla
                if (!empty($rutaFotografia) && file_exists($rutaFotografia)) {
                    unlink($rutaFotografia);
                }
                $rutaFotografia = $nuevaFotografia; // Actualizar ruta en la base de datos
            } else {
                echo "Error al cargar la nueva fotografía.";
                exit;
            }
        }

        // Consulta SQL para actualizar el registro
        $query = "UPDATE catalogacion SET 
                    nombre_institucion = ?, 
                    numero_inventario_anterior = ?, 
                    registro_provisorio = ?, 
                    catalogacion_clasificacion = ?, 
                    coleccion_tipologia = ?, 
                    nombre_objeto = ?, 
                    titulo = ?, 
                    descripcion = ?, 
                    autor_fabricante_cultura = ?, 
                    marco_historico = ?, 
                    lugar_ejecucion = ?, 
                    fecha_ejecucion_periodo = ?, 
                    material = ?, 
                    tecnica = ?, 
                    inscripciones_marcas = ?, 
                    dimensiones = ?, 
                    peso = ?, 
                    ubicacion_actual = ?, 
                    fotografia = ? 
                  WHERE numero_inventario = ?";

        $stmt = $db->prepare($query);
        $stmt->execute([
            $nombre_institucion,
            $numero_inventario_anterior,
            $registro_provisorio,
            $catalogacion_clasificacion,
            $coleccion_tipologia,
            $nombre_objeto,
            $titulo,
            $descripcion,
            $autor_fabricante_cultura,
            $marco_historico,
            $lugar_ejecucion,
            $fecha_ejecucion_periodo,
            $material,
            $tecnica,
            $inscripciones_marcas,
            $dimensiones,
            $peso,
            $ubicacion_actual,
            $rutaFotografia,
            $numero_inventario
        ]);
        header('Location: ../inventario.php');

        if ($stmt->rowCount() > 0) {
            exit;
        } else {
            echo "Error al actualizar el registro.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Solicitud no válida.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Objeto</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <header>
    <h1>Editar Objeto del Inventario</h1>
  </header>
  <main>
    <form action="editar.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="numero_inventario" value="<?php echo htmlspecialchars($row['numero_inventario']); ?>">

      <!-- Información General -->
      <fieldset>
        <legend>Información General</legend>
        <div class="form-group">
          <label for="nombre_institucion">Nombre de la Institución</label>
          <input type="text" id="nombre_institucion" name="nombre_institucion" value="<?php echo htmlspecialchars($row['nombre_institucion']); ?>" required>
        </div>
        <div class="form-group">
          <label for="numero_inventario_anterior">Nº de Inventario Anterior</label>
          <input type="text" id="numero_inventario_anterior" name="numero_inventario_anterior" value="<?php echo htmlspecialchars($row['numero_inventario_anterior']); ?>">
        </div>
        <div class="form-group">
          <label for="registro_provisorio">Registro Provisorio</label>
          <input type="text" id="registro_provisorio" name="registro_provisorio" value="<?php echo htmlspecialchars($row['registro_provisorio']); ?>">
        </div>
        <div class="form-group">
          <label for="catalogacion_clasificacion">Catalogación/Clasificación</label>
          <select id="catalogacion_clasificacion" name="catalogacion_clasificacion" required>
            <option value="" disabled>Seleccione una opción</option>
            <option value="administracion-publica" <?php echo $row['catalogacion_clasificacion'] == 'administracion-publica' ? 'selected' : ''; ?>>Administración Pública</option>
            <option value="armas" <?php echo $row['catalogacion_clasificacion'] == 'armas' ? 'selected' : ''; ?>>Armas</option>
            <option value="carteleria" <?php echo $row['catalogacion_clasificacion'] == 'carteleria' ? 'selected' : ''; ?>>Cartelería</option>
            <option value="fotografia-documental" <?php echo $row['catalogacion_clasificacion'] == 'fotografia-documental' ? 'selected' : ''; ?>>Fotografía Documental</option>
            <!-- Agrega las demás opciones aquí -->
          </select>
        </div>
        <div class="form-group">
          <label for="coleccion_tipologia">Colección/Tipología</label>
          <input type="text" id="coleccion_tipologia" name="coleccion_tipologia" value="<?php echo htmlspecialchars($row['coleccion_tipologia']); ?>" required>
        </div>
      </fieldset>

      <!-- Detalles Históricos -->
      <fieldset>
        <legend>Detalles Históricos</legend>
        <div class="form-group">
          <label for="nombre_objeto">Nombre del Objeto</label>
          <input type="text" id="nombre_objeto" name="nombre_objeto" value="<?php echo htmlspecialchars($row['nombre_objeto']); ?>" required>
        </div>
        <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" name="descripcion" rows="4"><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
          <label for="autor_fabricante_cultura">Autor/Fabricante/Cultura</label>
          <input type="text" id="autor_fabricante_cultura" name="autor_fabricante_cultura" value="<?php echo htmlspecialchars($row['autor_fabricante_cultura']); ?>" required>
        </div>
        <div class="form-group">
          <label for="marco_historico">Marco Histórico</label>
          <textarea id="marco_historico" name="marco_historico" rows="3"><?php echo htmlspecialchars($row['marco_historico']); ?></textarea>
        </div>
        <div class="form-group">
          <label for="lugar_ejecucion">Lugar de Ejecución</label>
          <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo htmlspecialchars($row['lugar_ejecucion']); ?>">
        </div>
        <div class="form-group">
          <label for="fecha_ejecucion_periodo">Fecha de Ejecución/Período</label>
          <input type="date" id="fecha_ejecucion_periodo" name="fecha_ejecucion_periodo" value="<?php echo htmlspecialchars($row['fecha_ejecucion_periodo']); ?>">
        </div>
      </fieldset>

      <!-- Características Físicas -->
      <fieldset>
        <legend>Características Físicas</legend>
        <div class="form-group">
          <label for="material">Material</label>
          <input type="text" id="material" name="material" value="<?php echo htmlspecialchars($row['material']); ?>">
        </div>
        <div class="form-group">
          <label for="tecnica">Técnica</label>
          <input type="text" id="tecnica" name="tecnica" value="<?php echo htmlspecialchars($row['tecnica']); ?>">
        </div>
        <div class="form-group">
          <label for="inscripciones_marcas">Inscripciones y Marcas</label>
          <textarea id="inscripciones_marcas" name="inscripciones_marcas" rows="3"><?php echo htmlspecialchars($row['inscripciones_marcas']); ?></textarea>
        </div>
        <div class="form-group">
          <label for="dimensiones">Dimensiones</label>
          <input type="text" id="dimensiones" name="dimensiones" value="<?php echo htmlspecialchars($row['dimensiones']); ?>">
        </div>
        <div class="form-group">
          <label for="peso">Peso</label>
          <input type="text" id="peso" name="peso" value="<?php echo htmlspecialchars($row['peso']); ?>">
        </div>
      </fieldset>

      <!-- Ubicación y Fotografía -->
      <fieldset>
        <div class="form-group">
            <label for="ubicacion_actual">Ubicación Actual</label>
            <input type="text" id="ubicacion_actual" name="ubicacion_actual" value="<?php echo htmlspecialchars($row['ubicacion_actual']); ?>">
        </div>
  <legend>Fotografía</legend>
  <div class="form-group">
    <label for="fotografia">Cargar Nueva Fotografía</label>
    <input type="file" id="fotografia" name="fotografia">
    <!-- Campo oculto para enviar la ruta actual de la fotografía -->
    <input type="hidden" name="fotografia_actual" value="<?php echo isset($row['fotografia']) ? htmlspecialchars($row['fotografia']) : ''; ?>">
    <?php if (!empty($row['fotografia'])): ?>
      <p>Fotografía actual: <a href="<?php echo htmlspecialchars($row['fotografia']); ?>" target="_blank">Ver</a></p>
    <?php endif; ?>
  </div>
</fieldset>

      <!-- Botones de acción -->
      <div class="form-actions">
        <button type="submit">Guardar Cambios</button>
        <a href="../inventario.php" class="button"><button>Cancelar</button></a>
      </div>
    </form>
  </main>
  
</body>
</html>
