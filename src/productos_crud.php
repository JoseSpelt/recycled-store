<?php
require 'config.php';
require 'db_connect.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$mensaje = '';
$editando = false;
$producto_editar = [
    'id' => '',
    'nombre' => '',
    'descripcion' => '',
    'material' => '',
    'precio' => '',
    'stock' => '',
    'categoria_id' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $material = trim($_POST['material'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $categoria_id = intval($_POST['categoria_id'] ?? 0);

    if ($accion === 'crear') {
        $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, material, precio, stock, categoria_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdis", $nombre, $descripcion, $material, $precio, $stock, $categoria_id);
        if ($stmt->execute()) {
            $mensaje = "Producto creado correctamente.";
        } else {
            $mensaje = "Error al crear: " . $stmt->error;
        }
    } elseif ($accion === 'actualizar') {
        $id = intval($_POST['id'] ?? 0);
        $stmt = $conn->prepare("UPDATE productos SET nombre=?, descripcion=?, material=?, precio=?, stock=?, categoria_id=? WHERE id=?");
        $stmt->bind_param("sssdisi", $nombre, $descripcion, $material, $precio, $stock, $categoria_id, $id);
        if ($stmt->execute()) {
            $mensaje = "Producto actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar: " . $stmt->error;
        }
    }
}

if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM productos WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar: " . $stmt->error;
    }
}

if (isset($_GET['editar'])) {
    $editando = true;
    $id = intval($_GET['editar']);
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($fila = $res->fetch_assoc()) {
        $producto_editar = $fila;
    }
}

$productos = $conn->query("SELECT p.*, c.nombre AS categoria_nombre FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id");
$categorias = $conn->query("SELECT id, nombre FROM categorias");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestión de productos - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
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

/* ===== Estilos del Modal ===== */
.modal-bg{
  display:none;
  position:fixed;
  top:0; left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.6);
  justify-content:center;
  align-items:center;
  z-index:200;
}
.modal-content{
  background:white;
  padding:25px;
  border-radius:10px;
  width:350px;
  text-align:center;
  box-shadow:0 8px 20px rgba(0,0,0,0.2);
}
.modal-content h3{
  margin-bottom:10px;
}
.actions{
  display:flex;
  justify-content:space-between;
  margin-top:20px;
}
.actions button{
  padding:10px 20px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-weight:700;
  transition:0.3s;
}
.actions button:hover{
  transform:translateY(-2px);
}
.actions .danger{
  background:#b71c1c;
  color:white;
}
.actions button:first-child{
  background:#ccc;
}
</style>
</head>
<body>
<header class="topbar">
  <div class="brand">
    <img src="images/logo.jpg" alt="logo" class="logo-small">
    <h1>CRUD Productos reciclados - Jose Spelt</h1>
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

<main class="container">
  <div class="card">
    <h2><?php echo $editando ? 'Editar producto' : 'Crear nuevo producto'; ?></h2>
    <?php if ($mensaje): ?>
      <div class="note"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="hidden" name="accion" value="<?php echo $editando ? 'actualizar' : 'crear'; ?>">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto_editar['id']); ?>">
      <?php endif; ?>

      <label>Nombre</label>
      <input name="nombre" required value="<?php echo htmlspecialchars($producto_editar['nombre']); ?>">

      <label>Descripción</label>
      <textarea name="descripcion"><?php echo htmlspecialchars($producto_editar['descripcion']); ?></textarea>

      <label>Material</label>
      <input name="material" value="<?php echo htmlspecialchars($producto_editar['material']); ?>">

      <label>Precio (Gs)</label>
      <input type="number" step="0.01" name="precio" required value="<?php echo htmlspecialchars($producto_editar['precio']); ?>">

      <label>Stock</label>
      <input type="number" name="stock" required value="<?php echo htmlspecialchars($producto_editar['stock']); ?>">

      <label>Categoría</label>
      <select name="categoria_id">
        <?php while($cat = $categorias->fetch_assoc()): ?>
          <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id']==$producto_editar['categoria_id']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($cat['nombre']); ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit"><?php echo $editando ? 'Actualizar' : 'Crear'; ?></button>
    </form>
  </div>

  <div class="card">
    <h2>Listado de productos</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Material</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($p = $productos->fetch_assoc()): ?>
          <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['nombre']); ?></td>
            <td><?php echo htmlspecialchars($p['material']); ?></td>
            <td><?php echo htmlspecialchars($p['categoria_nombre']); ?></td>
            <td><?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
            <td><?php echo $p['stock']; ?></td>
            <td>
              <a href="productos_crud.php?editar=<?php echo $p['id']; ?>">Editar</a> |
              <a href="#" onclick="return confirmarEliminacion('productos_crud.php?eliminar=<?php echo $p['id']; ?>')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- ===== Modal de confirmación ===== -->
<div id="modalConfirm" class="modal-bg">
  <div class="modal-content">
    <h3>¿Estás seguro de eliminar este producto?</h3>
    <p>Esta acción no se puede deshacer.</p>
    <div class="actions">
      <button onclick="cerrarModal()">Cancelar</button>
      <button id="btnConfirmar" class="danger">Eliminar</button>
    </div>
  </div>
</div>

<script>
  let deleteUrl = '';

  function confirmarEliminacion(url) {
    deleteUrl = url;
    document.getElementById('modalConfirm').style.display = 'flex';
    return false;
  }

  function cerrarModal() {
    document.getElementById('modalConfirm').style.display = 'none';
  }

  document.getElementById('btnConfirmar').addEventListener('click', () => {
    window.location.href = deleteUrl;
  });
</script>

<footer class="footer">
  <div>
    <strong><?php echo htmlspecialchars($project_title); ?></strong> — <?php echo htmlspecialchars($year); ?> — <?php echo htmlspecialchars($career); ?>
    <br>Integrantes: <?php echo htmlspecialchars(implode(" · ", $group_members)); ?>
    <br>Autor (quien presenta): Jose Spelt — C.I.: <?php echo htmlspecialchars($presenter_cedula); ?>
  </div>
</footer>
</body>
</html>
