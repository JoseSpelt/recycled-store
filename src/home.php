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
<title>Inicio - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
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
    <h1>Tienda EcoRecicla - Jose Spelt</h1>
  </div>
  <nav>
    <a href="home.php">Inicio</a>
    <a href="contact.php">Contáctenos</a>
    <a href="about.php">Acerca de mí</a>
    <a href="productos_crud.php">Gestión de productos</a>
    <a href="productos_consulta.php">Consulta de productos</a>
    <a href="<?php echo htmlspecialchars($blog_url); ?>" target="_blank">Blog</a>
    <a href="http://localhost:8000/" target="_blank">WordPress - Jose Spelt</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<!-- 🟢 BANNER PRINCIPAL -->
<section class="hero">
  <div class="hero-content">
    <h2>¡Bienvenidos a EcoRecicla!</h2>
    <p>Convertimos residuos en productos útiles y sostenibles.  
    El planeta necesita cambios... ¡y podemos empezar desde casa! 🌱</p>
    <a href="productos_consulta.php" class="btn">Ver productos</a>
  </div>
</section>

<!-- 🔥 BENEFICIOS -->
<section class="benefits container">
  <div class="card">
    <h3>♻ Materiales reciclados</h3>
    <p>Todos los productos están hechos con plástico, madera o metal recuperado.</p>
  </div>
  <div class="card">
    <h3>🌍 Cuidamos el planeta</h3>
    <p>Reducimos la contaminación mediante el reúso de materiales.</p>
  </div>
  <div class="card">
    <h3>🛍 Compra consciente</h3>
    <p>Precios accesibles y apoyo al reciclaje local.</p>
  </div>
</section>

<!-- SIMULACIÓN DE PRODUCTOS DESTACADOS -->
<section class="container destacados">
  <h2>Productos destacados</h2>
  <div class="cards">
    <div class="card">
      <img src="https://img.freepik.com/foto-gratis/bolsa-ecologica_23-2148576640.jpg?semt=ais_incoming&w=740&q=80" class="feature-img" alt="">
      <h3>Bolsa reutilizable</h3>
      <p>Ideal para compras sin plástico.</p>
      <a href="productos_consulta.php" class="btn small">Ver más</a>
    </div>
    <div class="card">
      <img src="https://www.disposable-tableware.com/uploads/39195/news/20240830134503d9d5b.jpg?size=x0" class="feature-img" alt="">
      <h3>Maceta ecológica</h3>
      <p>Hecha con plástico reciclado.</p>
      <a href="productos_consulta.php" class="btn small">Ver más</a>
    </div>
  </div>
</section>

<footer class="footer">
  <div>
    <strong><?php echo htmlspecialchars($project_title); ?></strong>
    — <?php echo htmlspecialchars($year); ?> — <?php echo htmlspecialchars($career); ?><br>
    Integrantes: <?php echo htmlspecialchars(implode(" · ", $group_members)); ?><br>
    Autor (quien presenta): Jose Spelt — C.I.: <?php echo htmlspecialchars($presenter_cedula); ?>
  </div>
</footer>
</body>
</html>
