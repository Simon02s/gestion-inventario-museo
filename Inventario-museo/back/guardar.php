<?php

require_once 'Database.php';
require_once 'Catalogacion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Instancia de Catalogacion
    $catalogacion = new Catalogacion($db);

    // Asignar valores del formulario
    $catalogacion->nombre_institucion = $_POST['nombre_institucion'] ?? 'Museo Pringles';
    $catalogacion->numero_inventario = $_POST['numero_inventario'] ?? null;

    // Validar que el número de inventario esté definido
    if (empty($catalogacion->numero_inventario)) {
        echo "Error: El número de inventario es obligatorio.";
        exit;
    }

    $catalogacion->numero_inventario_anterior = $_POST['numero_inventario_anterior'];
    $catalogacion->registro_provisorio = $_POST['registro_provisorio'];
    $catalogacion->catalogacion_clasificacion = $_POST['catalogacion_clasificacion'];
    $catalogacion->coleccion_tipologia = $_POST['coleccion_tipologia'];
    $catalogacion->nombre_objeto = $_POST['nombre_objeto'];
    $catalogacion->titulo = $_POST['titulo'];
    $catalogacion->descripcion = $_POST['descripcion'];
    $catalogacion->autor_fabricante_cultura = $_POST['autor_fabricante_cultura'];
    $catalogacion->marco_historico = $_POST['marco_historico'];
    $catalogacion->lugar_ejecucion = $_POST['lugar_ejecucion'];
    $catalogacion->fecha_ejecucion_periodo = $_POST['fecha_ejecucion_periodo'];
    $catalogacion->material = $_POST['material'];
    $catalogacion->tecnica = $_POST['tecnica'];
    $catalogacion->inscripciones_marcas = $_POST['inscripciones_marcas'];
    $catalogacion->dimensiones = $_POST['dimensiones'];
    $catalogacion->dimensiones_complementarias = $_POST['dimensiones_complementarias'];
    $catalogacion->peso = $_POST['peso'];
    $catalogacion->duracion = $_POST['duracion'];
    $catalogacion->talla = $_POST['talla'];
    $catalogacion->bibliografia_referencia = $_POST['bibliografia_referencia'];
    $catalogacion->estado_conservacion_objeto = $_POST['estado_conservacion_objeto'];
    $catalogacion->estado_conservacion_complementarios = $_POST['estado_conservacion_complementarios'];
    $catalogacion->reparaciones_intervenciones = $_POST['reparaciones_intervenciones'] ?? null;
    $catalogacion->forma_ingreso = $_POST['forma_ingreso'] ?? null;
    $catalogacion->norma_legal_ingreso = $_POST['norma_legal_ingreso'] ?? null;
    $catalogacion->norma_legal_baja = $_POST['norma_legal_baja'] ?? null;
    $catalogacion->motivo_baja = $_POST['motivo_baja'] ?? null;
    $catalogacion->fecha_baja = $_POST['fecha_baja'] ?? null;
    $catalogacion->procedencia = $_POST['procedencia'];
    $catalogacion->numero_legal_ingreso = $_POST['numero_legal_ingreso'] ?? null;
    $catalogacion->responsable_ingreso = $_POST['responsable_ingreso'] ?? null;
    $catalogacion->restriccion_uso = $_POST['restriccion_uso'];
    $catalogacion->marcaje = $_POST['marcaje'] ?? null;
    $catalogacion->ubicacion = $_POST['ubicacion'];
    $catalogacion->ubicacion_actual = $_POST['ubicacion_actual'];
    $catalogacion->restriccion_imagen = $_POST['restriccion_imagen'];

    // Manejar la fotografía
    $directorioUploads = "uploads/";
    $rutaFotografia = null;

    if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
        // Crear el directorio si no existe
        if (!is_dir($directorioUploads)) {
            mkdir($directorioUploads, 0777, true);
        }

        // Obtener la extensión del archivo subido
        $extension = strtolower(pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION));
        $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extension, $formatosPermitidos)) {
            echo "Error: Formato de archivo no permitido.";
            exit;
        }

        // Nombre del archivo basado en el número de inventario
        $nombreArchivo = $catalogacion->numero_inventario . "." . $extension;
        $rutaCompleta = $directorioUploads . $nombreArchivo;

        // Mover el archivo subido al directorio de destino
        if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaCompleta)) {
            $rutaFotografia = $rutaCompleta; // Ruta para guardar en la base de datos
        } else {
            echo "Error al mover la fotografía.";
            exit;
        }
    }

    // Asignar la ruta de la fotografía al objeto Catalogacion
    $catalogacion->fotografia = $rutaFotografia;

    // Guardar en la base de datos
    if ($catalogacion->guardar()) {
        echo "Registro guardado correctamente.";
        header('Location: ../inventario.php');
    } else {
        echo "Error al guardar el registro.";
    }
}
