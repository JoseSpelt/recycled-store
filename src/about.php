<?php
require 'config.php';
require 'db_connect.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$sql = "SELECT nombres, numero_cedula, correo_electronico FROM alumno_jspelt LIMIT 1";
$result = $conn->query($sql);
$alumno = $result->fetch_assoc();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Acerca de mí - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
<link rel="stylesheet" href="assets/css/styles.css">
<style>
:root{
  --primary: <?php echo $theme_colors['primary']; ?>;
  --accent:  <?php echo $theme_colors['accent']; ?>;
  --bg:      <?php echo $theme_colors['bg']; ?>;
  --text:    <?php echo $theme_colors['text']; ?>;
  --font:    <?php echo $font_family; ?>;
}
.about-layout{
  display:grid;
  grid-template-columns: 1fr 2fr;
  gap:20px;
  align-items:start;
}
.about-photo{
  max-width:100%;
  border-radius:12px;
}
</style>
</head>
<body>
<header class="topbar">
  <div class="brand">
    <img src="images/logo.jpg" alt="logo" class="logo-small">
    <h1>Acerca de mí - Jose Spelt</h1>
  </div>
  <nav>
    <a href="home.php">Inicio</a>
    <a href="contact.php">Contáctenos</a>
    <a href="about.php">Acerca de mí</a>
    <a href="productos_crud.php">Gestión de productos</a>
    <a href="productos_consulta.php">Consulta de productos</a>
    <a href="<?php echo htmlspecialchars($blog_url); ?>" target="_blank">Blog</a>
    <a href="https://TU-PAGINA-WORDPRESS.wordpress.com" target="_blank">WordPress - Jose Spelt</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<main class="container">
  <div class="about-layout card">
    <div>
      <!-- Usa una imagen distinta a la de tus compañeros -->
      <img src="images/contact.webp" alt="Foto de Jose Spelt" class="about-photo">
    </div>
    <div>
      <h2>Sobre el alumno</h2>
      <p><strong>Nombre completo:</strong> <?php echo htmlspecialchars($alumno['nombres']); ?></p>
      <p><strong>Cédula:</strong> <?php echo htmlspecialchars($alumno['numero_cedula']); ?></p>
      <p><strong>Correo:</strong> <?php echo htmlspecialchars($alumno['correo_electronico']); ?></p>

      <h3>Perfil</h3>
      <p>Soy estudiante de Ingeniería Informática y desarrollador junior, interesado en proyectos relacionados a la sostenibilidad y el reciclaje.</p>

      <h3>Rol en el proyecto</h3>
      <ul>
        <li>Diseño del login y navegación principal del sistema.</li>
        <li>Implementación del CRUD de productos reciclados.</li>
        <li>Integración con el blog externo y la página en WordPress.</li>
      </ul>
    </div>
  </div>
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
