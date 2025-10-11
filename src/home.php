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
<title><?php echo htmlspecialchars($project_title); ?> - Inicio</title>
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
    <a href="<?php echo htmlspecialchars($blog_url); ?>" target="_blank">Blog / Novedades</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<main class="container">
  <section class="cards">
    <div class="card">
      <h2>Descripción</h2>
      <p><?php echo nl2br(htmlspecialchars($project_description)); ?></p>
    </div>

    <div class="card">
      <h2>Integrantes del grupo</h2>
      <ul>
        <?php foreach ($group_members as $m) { echo "<li>" . htmlspecialchars($m) . "</li>"; } ?>
      </ul>
    </div>

    <div class="card">
      <h2>Diseño (colores, tipografía, logos)</h2>
      <p>Colores principales: <strong><?php echo $theme_colors['primary']; ?></strong> (primary), <strong><?php echo $theme_colors['accent']; ?></strong> (accent).</p>
      <p>Tipografía: <?php echo htmlspecialchars($font_family); ?></p>
      <p>Logo: mostrado arriba.</p>
    </div>

    <div class="card">
      <h2>Funcionalidades propuestas</h2>
      <ol>
        <?php foreach ($functionalities as $f) { echo "<li>" . htmlspecialchars($f) . "</li>"; } ?>
      </ol>
    </div>
  </section>
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
