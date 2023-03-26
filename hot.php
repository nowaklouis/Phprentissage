<?php
require 'header.php';

$age = null;

if (!empty($_POST['birthday'])) {
    setcookie('birthday', $_POST['birthday']);
}

if (!empty($_COOKIE['birthday'])) {
    $birthday = (int)$_COOKIE['birthday'];
    $age = (int)date('Y') - $birthday;
}

?>

<?php if ($age && $age >= 18) : ?>
    <h1>ba dis donc?</h1>
<?php else : ?>
    <form action="" method="post">
        <label for="birthday">Section réservé, entrez votre date de naissance</label>
        <select name="birthday" class="form-control">
            <?php for ($i = 2010; $i > 1919; $i--) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">envoyer</button>
    </form>
<?php endif ?>