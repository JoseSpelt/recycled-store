<?php
require 'config.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    // login: aceptar sólo si usuario == apellido del presentador (case-insensitive)
    if (strcasecmp($user, $presenter_lastname) === 0) {
        $_SESSION['user'] = $user;
        header('Location: home.php');
        exit;
    } else {
        $error = 'Credenciales incorrectas. Debes usar TU APELLIDO como usuario.';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars($project_title); ?> - Login</title>
<link rel="stylesheet" href="assets/css/styles.css">
<style>
:root{
  --primary: <?php echo $theme_colors['primary']; ?>;
  --accent:  <?php echo $theme_colors['accent']; ?>;
  --bg:      <?php echo $theme_colors['bg']; ?>;
  --text:    <?php echo $theme_colors['text']; ?>;
  --font:    <?php echo $font_family; ?>;
}
</style>
</head>
<body>
<main class="login-container">
  <div class="center-card login-card">
    <img src="images/logo.jpg" alt="Logo" class="logo">
    <h1>Ingreso al sistema</h1>
    
    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
      <label>Usuario (TU APELLIDO)</label>
      <input name="username" required placeholder="Ej: <?php echo htmlspecialchars($presenter_lastname); ?>">
      
      <label>Contraseña</label>
      <input type="password" name="password" required placeholder="Puedes usar cualquier contraseña">
      
      <button type="submit">Entrar</button>
    </form>
    
    <p class="note">Usuario de prueba: usa exactamente tu APELLIDO (el que pusiste en config.php).</p>
  </div>
</main>
</body>
</html>
