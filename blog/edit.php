<?php
require '../header.php';
require '../key.php';

$pdo = new PDO('mysql:host=localhost;dbname=grafiphp', $username, $password);
$error = null;
$success = null;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('UPDATE new_table SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'données mise à jour';
    }
    $query = $pdo->prepare('SELECT * FROM new_table WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $post = $query->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}


?>

<div class="container">
    <?php if ($success) : ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif ?>
    <?php if ($error) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else : ?>
        <form action="" method="post">
            <div>
                <input type="text" class="form-control" name="name" value="<?= $post->name ?>">
            </div>
            <div>
                <textarea class="form-control" name="content"><?= $post->content ?></textarea>
            </div>
            <button>Sauvegarder</button>
        </form>

    <?php endif ?>
    <a href="/blog/index.php">Retour a la liste</a>
</div>