<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Completo de Inventario</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Formulario Completo de Inventario</h1>
    <p>Complete todos los campos requeridos para registrar un nuevo objeto.</p>
  </header>

  <main>
    <div class="tab-container">
      <!-- Pestañas -->
      <div class="tabs">
        <button class="tab-link active" data-tab="general">Información General</button>
        <button class="tab-link" data-tab="clasificacion">Clasificación</button>
        <button class="tab-link" data-tab="historico">Detalles Históricos</button>
        <button class="tab-link" data-tab="fisico">Características Físicas</button>
        <button class="tab-link" data-tab="ubicacion">Ubicación y Documentación</button>
      </div>

      <!-- Formulario -->
      <form id="inventory-form" action="back/guardar.php" method="post" enctype="multipart/form-data">
        <!-- Información General -->
        <div id="general" class="tab-content active">
          <fieldset>
            <legend>Información General</legend>
            <div class="form-group">
              <label for="nombre_institucion">Nombre de la Institución</label>
              <input type="text" id="nombre_institucion" name="nombre_institucion" value="Museo Pringles" required>
            </div>
            <div class="form-group">
              <label for="numero_inventario">Nº de Inventario (Ej.: MP-12345)</label>
              <input type="text" id="numero_inventario" name="numero_inventario" placeholder="MP-XXXX" required>
            </div>
            <div class="form-group">
              <label for="numero_inventario_anterior">Nº de Inv. Anterior/es</label>
              <input type="text" id="numero_inventario_anterior" name="numero_inventario_anterior">
            </div>
            <div class="form-group">
              <label for="registro_provisorio">Registro Provisorio (Ej.: BDP-RGP-1)</label>
              <input type="text" id="registro_provisorio" name="registro_provisorio">
            </div>
          </fieldset>
        </div>

        <!-- Clasificación -->
        <div id="clasificacion" class="tab-content">
          <fieldset>
            <legend>Clasificación</legend>
            <div class="form-group">
              <label for="catalogacion_clasificacion">Catalogación/Clasificación</label>
              <select id="catalogacion_clasificacion" name="catalogacion_clasificacion" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="administracion-publica">Administración Pública</option>
                <option value="armas">Armas</option>
                <option value="carteleria">Cartelería</option>
                <option value="diarios-revistas">Diarios y Revistas</option>
                <option value="documentacion-personal">Documentación Personal</option>
                <option value="documento">Documento</option>
                <option value="edificios-partes">Edificios y Partes</option>
                <option value="elementos-escolares">Elementos Escolares</option>
                <option value="estructuras">Estructuras</option>
                <option value="fotografia-documental">Fotografía Género Documental</option>
                <option value="fotografia-paisaje">Fotografía Género Paisaje</option>
                <option value="fotografia-retrato">Fotografía Género Retrato</option>
                <option value="herramientas">Herramientas y Equipos</option>
                <option value="juegos-juguetes">Juegos y Juguetes</option>
                <option value="libros">Libros</option>
                <option value="mapa-plano-croquis">Mapa, Plano y Croquis</option>
                <option value="mobiliario">Mobiliario</option>
                <option value="utensilios">Utensilios</option>
                <option value="vestimenta">Vestimenta</option>
              </select>
            </div>
            <div class="form-group">
              <label for="coleccion_tipologia">Colección/Tipología</label>
              <input type="text" id="coleccion_tipologia" name="coleccion_tipologia" required>
            </div>
            <div class="form-group">
              <label for="nombre_objeto">Nombre del Objeto</label>
              <input type="text" id="nombre_objeto" name="nombre_objeto" required>
            </div>
            <div class="form-group">
              <label for="titulo">Título</label>
              <input type="text" id="titulo" name="titulo">
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>
          </fieldset>
        </div>

        <!-- Detalles Históricos -->
        <div id="historico" class="tab-content">
          <fieldset>
            <legend>Detalles Históricos</legend>
            <div class="form-group">
              <label for="autor_fabricante_cultura">Autor/Fabricante/Cultura</label>
              <input type="text" id="autor_fabricante_cultura" name="autor_fabricante_cultura" required>
            </div>
            <div class="form-group">
              <label for="marco_historico">Marco Histórico</label>
              <textarea id="marco_historico" name="marco_historico" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="lugar_ejecucion">Lugar de Ejecución</label>
              <input type="text" id="lugar_ejecucion" name="lugar_ejecucion">
            </div>
            <div class="form-group">
              <label for="fecha_ejecucion_periodo">Fecha de Ejecución/Período</label>
              <input type="date" id="fecha_ejecucion_periodo" name="fecha_ejecucion_periodo">
            </div>
          </fieldset>
        </div>

        <!-- Características Físicas -->
        <div id="fisico" class="tab-content">
          <fieldset>
            <legend>Características Físicas</legend>
            <div class="form-group">
              <label for="material">Material</label>
              <input type="text" id="material" name="material">
            </div>
            <div class="form-group">
              <label for="tecnica">Técnica</label>
              <input type="text" id="tecnica" name="tecnica">
            </div>
            <div class="form-group">
              <label for="inscripciones_marcas">Inscripciones y Marcas</label>
              <textarea id="inscripciones_marcas" name="inscripciones_marcas" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="dimensiones">Dimensiones</label>
              <input type="text" id="dimensiones" name="dimensiones">
            </div>
            <div class="form-group">
              <label for="dimensiones_complementarias">Dimensiones Complementarias</label>
              <input type="text" id="dimensiones_complementarias" name="dimensiones_complementarias">
            </div>
            <div class="form-group">
              <label for="peso">Peso</label>
              <input type="text" id="peso" name="peso">
            </div>
            <div class="form-group">
              <label for="duracion">Duración</label>
              <input type="text" id="duracion" name="duracion">
            </div>
            <div class="form-group">
              <label for="talla">Talla</label>
              <input type="text" id="talla" name="talla">
            </div>
            <div class="form-group">
              <label for="fotografia">Fotografía</label>
              <input type="file" id="fotografia" name="fotografia" accept="Image/*">
            </div>
          </fieldset>
        </div>

        <!-- Ubicación y Documentación -->
        <div id="ubicacion" class="tab-content">
          <fieldset>
            <legend>Ubicación y Documentación</legend>
            <div class="form-group">
              <label for="bibliografia_referencia">Bibliografía de Referencia</label>
              <textarea id="bibliografia_referencia" name="bibliografia_referencia" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="estado_conservacion_objeto">Estado de Conservación del Objeto</label>
              <textarea id="estado_conservacion_objeto" name="estado_conservacion_objeto" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="estado_conservacion_complementarios">Estado de Conservación de Objetos Complementarios</label>
              <textarea id="estado_conservacion_complementarios" name="estado_conservacion_complementarios" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación</label>
              <input type="text" id="ubicacion" name="ubicacion">
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación Actual</label>
              <input type="text" id="ubicacion_actual" name="ubicacion_actual">
            </div>
            <div class="form-group">
              <label for="procedencia">Procedencia</label>
              <input type="text" id="procedencia" name="procedencia">
            </div>
            
            <div class="form-group">
              <label for="restriccion_imagen">Restricción de la Imagen</label>
              <input type="text" id="restriccion_imagen" name="restriccion_imagen">
            </div>
            <div class="form-group">
              <label for="responsable_ingreso">Responsable del Ingreso</label>
              <input type="text" id="responsable_ingreso" name="responsable_ingreso">
            </div>
            <div class="form-group">
              <label for="restriccion_uso">Restricción de Uso</label>
              <input type="text" id="restriccion_uso" name="restriccion_uso">
            </div>
          </fieldset>
        </div>

        <!-- Botones -->
        <div class="form-actions">
          
          <button type="submit">Guardar</button>
          <button type="reset">Cancelar</button>
        </div>
      </form>
      <div class="back-to-home">
        <a href="index.php"><button class="volver">Volver</button></a>
      </div>
    </div>
  </main>
  <script src="script.js"></script>
</body>
</html>
