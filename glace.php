<?php 
require 'header.php';
require 'functionglace.php';

$title = "YOYO Glace";
$parfums = [
    'Fraise' => 4,
    'Vanille' => 5,
    'Chocolat' => 6
];

$cornets = [
    'Pot' => 2,
    'Cornet' => 3
];

$supplements = [
    'Pepite' => 1,
    'Chantilly' => 0.5
];

$ingredients = [];
$total = 0;

if(isset($_POST['parfum'])) {
    foreach($_POST['parfum'] as $parfum) {
        if(isset($parfums[$parfum])) {
            $ingredients[] = $parfum;
            $total += $parfums[$parfum];
        }
    }
}

if(isset($_POST['supplement'])) {
    foreach($_POST['supplement'] as $supplement) {
        if(isset($supplements[$supplement])) {
            $ingredients[] = $supplement;
            $total += $supplements[$supplement];
        }
    }
}

if(isset($_POST['cornet'])) {
    $cornet = $_POST['cornet'];
        if(isset($cornets[$cornet])) {
            $ingredients[] = $cornet;
            $total += $cornets[$cornet];
        }
    }
?>

<h1>Composer votre glace</h1>

<form action="/glace.php" method="POST">
    <h2>Choix des parfums</h2>
    <?php foreach($parfums as $parfum => $prix):?>
        <div class="form-group">
            <?= checkbox('parfum', $parfum, $_POST)?>
            <?=$parfum?> - <?=$prix?> €<br>
        </div>
    <?php endforeach; ?>

    <h2>Choix du support</h2>
    <?php foreach($cornets as $cornet => $prix):?>
        <div class="form-group">
            <?= radio('cornet', $cornet, $_POST)?>
            <?=$cornet?> - <?=$prix?> €<br>
        </div>
    <?php endforeach; ?>

    <h2>Choix des supplements</h2>
    <?php foreach($supplements as $supplement => $prix):?>
        <div class="form-group">
            <?= checkbox('supplement', $supplement, $_POST)?>
            <?=$supplement?> - <?=$prix?> €<br>
        </div>
    <?php endforeach; ?>

    <button  type="submit">send</button>

    <div class="card">
        <h2>Votre glace</h2>
        <ul>
            <?php foreach($ingredients as $ingredient) :?>
                <li><?= $ingredient ?></li>
            <?php endforeach?>
        </ul>
        <h2>Au prix de <?= $total ?></h2>
    </div>
</form>