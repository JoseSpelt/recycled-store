<?php
require 'config.php';
require 'db_connect.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$res = $conn->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Consulta de productos - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
<link rel="stylesheet" href="assets/css/styles.css">
<style>
:root{
  --primary: <?php echo $theme_colors['primary']; ?>;
  --accent:  <?php echo $theme_colors['accent']; ?>;
  --bg:      <?php echo $theme_colors['bg']; ?>;
  --text:    <?php echo $theme_colors['text']; ?>;
  --font:    <?php echo $font_family; ?>;
}
table{
  width:100%;
  border-collapse:collapse;
  margin-top:20px;
}
th,td{
  border:1px solid #ccc;
  padding:8px;
  text-align:left;
}
th{
  background:#eee;
}
</style>
</head>
<body>
<header class="topbar">
  <div class="brand">
    <img src="images/logo.jpg" alt="logo" class="logo-small">
    <h1>Consulta de productos - Jose Spelt</h1>
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
  <div class="card">
    <h2>Listado de productos registrados</h2>
    <p>Consulta de datos de la tabla <strong>productos</strong> (función de reporte).</p>

    <label>Buscar por nombre o material (JS)</label>
    <input id="filtro" onkeyup="filtrarTabla()" placeholder="Ej: plástico, maceta, bolsa...">

    <table id="tablaProductos">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Material</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Stock</th>
        </tr>
      </thead>
      <tbody>
        <?php while($p = $res->fetch_assoc()): ?>
          <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['nombre']); ?></td>
            <td><?php echo htmlspecialchars($p['material']); ?></td>
            <td><?php echo htmlspecialchars($p['categoria_nombre']); ?></td>
            <td><?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
            <td><?php echo $p['stock']; ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
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
function filtrarTabla() {
  const filtro = document.getElementById('filtro').value.toLowerCase();
  const filas = document.querySelectorAll('#tablaProductos tbody tr');

  filas.forEach(fila => {
    const texto = fila.innerText.toLowerCase();
    if (texto.includes(filtro)) {
      fila.style.display = '';
    } else {
      fila.style.display = 'none';
    }
  });
}
</script>
</body>
</html>
