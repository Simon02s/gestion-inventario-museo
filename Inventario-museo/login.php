<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Museos y Patrimonio</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #4CAF50, #2a93d5);
    }

    .login-container {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 400px;
      text-align: center;
    }

    .login-container img {
      max-width: 120px;
      margin-bottom: 20px;
      animation: float 3s ease-in-out infinite;
    }

    .login-container h1 {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 20px;
    }

    .login-container input {
      width: calc(100% - 20px);
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    .login-container input:focus {
      border-color: #4CAF50;
      outline: none;
    }

    .login-container button {
      background: linear-gradient(135deg, #4CAF50, #2a93d5);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-container button:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .login-container .back-link {
      display: block;
      margin-top: 15px;
      font-size: 14px;
      text-decoration: none;
      color: #2a93d5;
      transition: color 0.3s ease;
    }

    .login-container .back-link:hover {
      color: #4CAF50;
      text-decoration: underline;
    }

    /* Animación flotante para el logo */
    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <!-- Logo -->
    <img src="login.jpg.jpeg" alt="Museos y Patrimonio">
    <!-- Título -->
    <h1>Iniciar Sesión</h1>
    <!-- Formulario -->
    <form action="validate.php" method="POST">
      <input type="text" name="username" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Ingresar</button>
    </form>
    <!-- Enlace para volver -->
    
  </div>
</body>
</html>
