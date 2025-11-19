<?php
require 'config.php';
require 'db_connect.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Debes completar usuario y contraseña.';
    } else {
        $sql = "SELECT id, username, password_hash, nombre_completo FROM usuarios WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user'] = $row['nombre_completo'];
                header('Location: home.php');
                exit;
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - <?php echo htmlspecialchars($project_title); ?> - Jose Spelt</title>
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
    <h1>Login - Jose Spelt</h1>

    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <label>Usuario</label>
      <input name="username" required placeholder="Ej: jspelt">

      <label>Contraseña</label>
      <input type="password" name="password" required placeholder="Ingresa tu contraseña">

      <button type="submit">Entrar</button>
    </form>

    <p class="note">
      Para la demo: usuario <strong>jspelt</strong>, contraseña <strong>123456</strong> (creado con <code>create_user.php</code>).
    </p>
  </div>
</main>
</body>
</html>
