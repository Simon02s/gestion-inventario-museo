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
  <title>Dashboard de Inventario</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="dashboard">
    <!-- Barra lateral -->
    <aside class="sidebar">
      
    <div class="logo">IMC</div>
      <nav>
        <a href="" class="active">Dashboard</a>
        <a href="inventario.php">Inventario</a>
        <a href="formulario.php">Añadir Objeto</a>
        <a href="#">Usuarios</a>
        <a href="logout.php">Cerrar sesion</a>
      </nav>
    </aside>

    <!-- Contenido principal -->
    <main>
      <!-- Encabezado -->
      <header class="header">
        <h1>Bienvenido, Admin</h1>
        
      </header>

      <!-- Contenido del dashboard -->
      <section class="content">
        <!-- Tarjetas informativas -->
        <div class="info-cards">
          <div class="card">
            <h3>Total de objetos</h3>
            <p>1,230</p>
          </div>
          <div class="card">
            <h3>En restauración</h3>
            <p>45</p>
          </div>
          <div class="card">
            <h3>Nuevas adquisiciones</h3>
            <p>12</p>
          </div>
          <div class="card">
            <h3>Elementos destacados</h3>
            <p>5</p>
          </div>
        </div>

        <!-- Gráfica y tabla -->
        <div class="dashboard-overview">
          <!-- Gráfica de ejemplo -->
          <div class="chart">
            <h3>Distribución por categorías</h3>
            <canvas id="categoryChart"></canvas>
          </div>

          <!-- Tabla reciente -->
          <div class="recent-table">
            <h3>Objetos recientes</h3>
            <table>
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Categoría</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Estatua de Apolo</td>
                  <td>Escultura</td>
                  <td>En exhibición</td>
                  <td><button>Editar</button><button>Eliminar</button></td>
                </tr>
                <tr>
                  <td>Cuadro de Van Gogh</td>
                  <td>Pintura</td>
                  <td>En restauración</td>
                  <td><button>Editar</button><button>Eliminar</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
<script src="script.js"></script>
</html>
