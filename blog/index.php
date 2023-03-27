<?php
require '../header.php';
require '../key.php';

$pdo = new PDO('mysql:host=localhost;dbname=grafiphp', $username, $password);
$error = null;
$success = null;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO new_table (name, content, created_date) VALUES (:name, :content, :created_date )');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created_date' => date("Y-m-d")
        ]);
        header('Location: /blog/edit.php?id=' . $pdo->lastInsertId());
    }

    $query = $pdo->query('SELECT * FROM new_table');
    $posts = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}


?>


<?php if ($error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else : ?>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li><a href="/blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></li>
        <?php endforeach ?>
    </ul>

    <form action="" method="post">
        <div>
            <input type="text" class="form-control" name="name" value="">
        </div>
        <div>
            <textarea class="form-control" name="content"></textarea>
        </div>
        <button>Sauvegarder</button>
    </form>
<?php endif ?>