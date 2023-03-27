<?php
if (!function_exists('navlogic')) {
  function navlogic(string $link, string $titre): string
  {
    $classe = 'nav-link';
    if ($_SERVER['SCRIPT_NAME'] === $link) {
      $classe = $classe . ' active';
    }
    return <<<HTML
    <li class="nav-item">
            <a class="$classe" aria-current="page" href="$link">$titre</a>
          </li>
HTML;
  }
}

?>

<?= navlogic('/index.php', 'Acceuil'); ?>
<?= navlogic('/contact.php', 'Contact'); ?>
<?= navlogic('/jeu.php', 'Game'); ?>
<?= navlogic('/glace.php', 'Glace'); ?>
<?= navlogic('/profil.php', 'Profil'); ?>
<?= navlogic('/hot.php', 'Hot'); ?>
<?= navlogic('/goldbook.php', 'Livre d\'or'); ?>
<?= navlogic('/curl.php', 'Meteo'); ?>
<?= navlogic('/blog/index.php', 'Blog'); ?>