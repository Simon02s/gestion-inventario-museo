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
  <title>Lista de Inventario</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Estilo adicional para la barra de búsqueda */
    .search-notifications form {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .search-notifications input[type="text"] {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }
    .search-notifications .button.search {
      padding: 10px 20px;
      background-color: #0056b3;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
    }
    .search-notifications .button.search:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<div class="dashboard">

  <aside class="sidebar">
    <div class="logo">IMC</div>
    <nav>
      <a href="index.php" class="active">Dashboard</a>
      <a href="inventario.php">Inventario</a>
      <a href="formulario.php">Añadir Objeto</a>
      <a href="#">Usuarios</a>
      <a href="login.php">Cerrar sesion</a>
    </nav>
  </aside>

  <div id="inventory-list" class="tabla_inventario">
    <div class="search-notifications">
      <!-- Formulario de búsqueda -->
      <form method="get" action="inventario.php">
        <input 
          size="70"
          type="text" 
          name="search" 
          placeholder="Buscar por Número de inventario, nombre de objeto, autor o título"
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit" class="button search">Buscar</button>
      </form>
    </div>

    <!-- Incluir listar.php -->
    <?php 
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      include 'back/listar.php'; 
    ?>
  </div>
</div>

</body>
</html>
