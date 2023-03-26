<?php
require 'header.php';

$nom = null;

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['utilisateur']);
    setcookie('utilisateur', '', time() - 10);
}

if (!empty($_COOKIE['utilisateur'])) {
    $nom = $_COOKIE['utilisateur'];
}

if (!empty($_POST['nom'])) {
    setcookie('utilisateur', $_POST['nom']);
    $nom = $_POST['nom'];
}

?>

<?php if ($nom) : ?>
    <h1>Hello <?= htmlentities($nom) ?></h1>
    <a href="profil.php?action=deconnecter">Se deconnecter</a>
<?php else : ?>
    <form action="" method="post">
        <input type="text" name="nom" placeholder="Entrez votre nom">
        <button type="submit">Connection</button>
    </form>
<?php endif; ?>