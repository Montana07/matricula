<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido: <?= $user['email']; ?>
      <br>
      <br> Has iniciado sesión correctamente
      <br>
      <form action="logout.php" method="POST">
      <input type="submit" value="Salir">
    </form>
        
    <?php else: ?>
      <a> Si ya tiene una cuenta, dale click en Login y si en caso no en Register </a>
      <br>
      <a href="login.php">Login</a> or
      <a href="signup.php">Registrar</a>
    <?php endif; ?>
  </body>
</html>
