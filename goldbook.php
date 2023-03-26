<?php
require 'header.php';
require 'classes/Message.php';
require 'classes/Book.php';
$title = 'Livre d\'or';
$errors = null;
$success = false;
$book = new Book(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');

if (isset($_POST['name'], $_POST['message'])) {
    $message = new Message($_POST['name'], $_POST['message']);
    if ($message->isValid()) {

        $book->addMessage($message);
        $success = true;
        $_POST = [];
    } else {
        $errors = $message->getErrors();
    }
}

$messages = $book->getMessages();
?>

<h1>Livre d'Or</h1>

<?php if (!empty($errors)) : ?>
    Formulaire Invalide
<?php endif ?>

<?php if ($success) : ?>
    Formulaire Envoyer !
<?php endif ?>


<form action="" method="post">
    <input type="text" name="name" placeholder="Entrez votre nom" value="<?= $_POST['name'] ?? '' ?>">
    <?php if (isset($errors['name'])) : ?>
        <?= $errors['name'] ?>
    <?php endif ?>
    <textarea name="message" placeholder="Entrez votrre message"><?= $_POST['message'] ?? '' ?></textarea>
    <?php if (isset($errors['message'])) : ?>
        <?= $errors['message'] ?>
    <?php endif ?>
    <button type="submit">Envoyer votre message</button>

    <?php if (!empty($messages)) : ?>
        <h1>Vos Messages</h1>
        <?php foreach ($messages as $message) : ?>
            <?= $message->toHTML(); ?>
        <?php endforeach ?>
    <?php endif ?>
</form>