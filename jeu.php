<?php 
$title = "YOYO Game";
$deviner = 151;
$erreur = null;
$succes = null;
$value = null;
require 'header.php';

if(isset($_GET["chiffre"])){
    if($_GET["chiffre"] > $deviner) {
        $erreur = "votre chiffre est trop grand";
    } elseif ($_GET["chiffre"] < $deviner){
        $erreur = "votre chiffre est trop petit";
    } else {
        $succes = "bravo vous avez deviner le nombre <strong>$deviner</strong>";
    }
    $value = (int)$_GET["chiffre"];
}
?>

<?php if($erreur): ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
    <?php elseif($succes): ?>
    <div class="alert alert-success">
        <?= $succes ?>
    </div>
    <?php endif ?>

<form action="/jeu.php" method="GET">
    <input type="text" name="chiffre" value=<?php if(isset ($_GET["chiffre"])) : echo htmlentities($_GET["chiffre"]);endif;?>>
    <button  type="submit">send</button>
</form>