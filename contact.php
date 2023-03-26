<?php
require 'header.php';
require_once 'config.php';
require_once 'functionglace.php';
$title = "Contact le YOYO";
$email = null;
$error = null;
$succes = null;
if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
    file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
    $succes = "Email enregistrer";
  } else {
    $error = "email non valide";
  }
}
?>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>Horaires</h1>
    <ul>
      <?php foreach (JOUR as $k => $day) : ?>
        <li <?php if ($k + 1 === (int)date('N')) : ?> style="color:green" <?php endif; ?>>
          <?= $day ?> - <?= creneaux_html(CRENEAUX[$k]) ?>
        </li>
      <?php endforeach ?>
    </ul>
    <h4> Nous sommes le</h4>
    <?= date('l d F Y'); ?>
  </div>
  <div class="bg-light p-5 rounded">
    <?php if ($error) : ?>
      <div class="alert alert-danger">
        <?= $error ?>
      </div>
    <?php endif; ?>
    <?php if ($succes) : ?>
      <div class="alert alert-success">
        <?= $succes ?>
      </div>
    <?php endif; ?>
    <h1>Inscrivez - vous à la newsletter !</h1>
    <form action="/contact.php" method="post" class="form-inline">
      <input type="email" name="email" placeholder="rentrez votre email" required>
      <button type="submit">S'inscrire</button>
    </form>
  </div>
</main>