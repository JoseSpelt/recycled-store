<?php
require 'config.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($project_title); ?> - Contáctenos</title>
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
<header class="topbar">
  <div class="brand">
    <img src="images/logo.jpg" alt="logo" class="logo-small">
    <h1><?php echo htmlspecialchars($project_title); ?></h1>
  </div>
  <nav>
    <a href="home.php">Inicio</a>
    <a href="contact.php">Contáctenos</a>
    <a href="<?php echo htmlspecialchars($blog_url); ?>" target="_blank">Blog</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<main class="container">
  <h2>Contáctenos</h2>

  <img src="images/contact1.webp" alt="Contacto" class="feature-img">

  <h3>Propuesta personal</h3>
  <p><?php echo nl2br(htmlspecialchars($presenter_rubric)); ?></p>

  <h4>Formulario</h4>
  <form>
    <label>Nombre</label>
    <input placeholder="Jose Spelt">
    
    <label>Email</label>
    <input placeholder="josespelt6@gmail.com">
    
    <label>Mensaje</label>
    <textarea placeholder="Escribe tu consulta..."></textarea>
    
    <button type="button">Enviar </button>
  </form>
</main>

<footer class="footer">
  <div>
    <strong><?php echo htmlspecialchars($project_title); ?></strong> — <?php echo htmlspecialchars($year); ?> — <?php echo htmlspecialchars($career); ?>
    <br>Integrantes: <?php echo htmlspecialchars(implode(" · ", $group_members)); ?>
    <br>Autor (quien presenta): Jose Spelt — C.I.: <?php echo htmlspecialchars($presenter_cedula); ?>
  </div>
</footer>
</body>
</html>
