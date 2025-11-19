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
<title>Consultas y Pedidos - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
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
    <h1>Consultas y pedidos - Jose Spelt</h1>
  </div>
  <nav>
    <a href="home.php">Inicio</a>
    <a href="contact.php">Consultas y pedidos</a>
    <a href="about.php">Acerca de mí</a>
    <a href="productos_crud.php">Gestión de productos</a>
    <a href="productos_consulta.php">Consulta de productos</a>
    <a href="<?php echo htmlspecialchars($blog_url); ?>" target="_blank">Blog</a>
    <a href="https://TU-PAGINA-WORDPRESS.wordpress.com" target="_blank">WordPress - Jose Spelt</a>
    <a href="logout.php">Salir</a>
  </nav>
</header>

<main class="container">
  <h2>¿Tenés dudas o querés pedir productos reciclados?</h2>
  <p>Completá el formulario y te responderemos a la brevedad.</p>

  <div class="cards">

    <!-- FORMULARIO -->
    <div class="card">
      <h3>Formulario de cotización</h3>
      <form id="contactForm">
        <label>Nombre completo</label>
        <input id="nombre" placeholder="Ej: Jose Spelt">

        <label>Email</label>
        <input id="email" placeholder="tuemail@dominio.com">

        <label>Tipo de consulta</label>
        <select id="tipo">
          <option value="Cotización de productos">Cotización de productos</option>
          <option value="Compra mayorista">Compra mayorista</option>
          <option value="Producto personalizado">Producto personalizado</option>
          <option value="Colaboración / convenio">Colaboración / convenio</option>
        </select>

        <label>Mensaje</label>
        <textarea id="mensaje" rows="4" placeholder="Escribí tu consulta..."></textarea>

        <button type="button" onclick="enviarConsulta()">Enviar solicitud</button>
        <p class="note" id="charCount">0 caracteres.</p>
      </form>
    </div>

    <!-- INFORMACIÓN -->
    <div class="card">
      <h3>Nuestra zona de trabajo</h3>

      <!-- MAPA GENERICO DE ASUNCION -->
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.444253845236!2d-57.634352785013735!3d-25.28664648385257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x945da92a2d1e3a67%3A0xf4444c530dab9097!2sAsunci%C3%B3n!5e0!3m2!1ses!2spy!4v1700000000000!5m2!1ses!2spy"
        width="100%" height="200" style="border:0; border-radius:12px; margin-top:10px;"
        allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>

      <p>📍 <strong>Asunción, Paraguay</strong><br>
        Transformamos residuos en productos útiles y sostenibles.</p>

      <p><strong>Horarios:</strong><br>
        Lunes a Viernes — 08:00 a 17:00</p>

      <p><strong>Procesamos:</strong> plástico, metal, madera y cartón.</p>
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


<script>
function enviarConsulta() {
  const nombre   = document.getElementById('nombre').value.trim();
  const email    = document.getElementById('email').value.trim();
  const tipo     = document.getElementById('tipo').value;
  const mensaje  = document.getElementById('mensaje').value.trim();

  if (!nombre || !email || !mensaje) {
    mostrarModal('⚠️ Por favor completá todos los campos antes de enviar.');
    return;
  }

  // Mensaje de éxito
  mostrarModal(`¡Gracias ${nombre}! Tu solicitud sobre "${tipo}" fue registrada (Simulación).`);

  // Limpiar los campos después de enviar
  document.getElementById('contactForm').reset();
  document.getElementById('charCount').textContent = "0 caracteres.";
}

function mostrarModal(texto) {
  document.getElementById('modalTexto').innerText = texto;
  document.getElementById('modalExito').style.display = 'flex';
}

function cerrarModal() {
  document.getElementById('modalExito').style.display = 'none';
}

</script>

<div id="modalExito" class="modal-exito">
  <div class="modal-content">
    <p id="modalTexto"></p>
    <button onclick="cerrarModal()">Cerrar</button>
  </div>
</div>

</body>
</html>
