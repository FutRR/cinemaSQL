<?php
ob_start();
?>

<div class="box_wrapper">
    <h3 class="box_title">À la une</h3>
    <div class="card_wrapper">
        <?php foreach ($listCard->fetchAll() as $card) { ?>
            <div class="card">
                <img src="upload/film/<?= $card["affiche"] ?>" alt="affiche film">
                <p>
                    <?= $card["titre"] ?>
                </p>
                <p>
                    <?= $card["sortieFr"] ?>
                </p>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Accueil";
$titre_secondaire = "Accueil";
$content = ob_get_clean();
require "view/template.php";
?>