<?php
ob_start();
?>

<?php foreach ($query->fetchAll() as $film) { ?>
    <div class="film_wrapper">
        <img class="img_list" src="<?= $film["affiche"] ?>" alt="affiche">
        <div class="list_infos">
            <h3>
                <?= $film["titre"] ?>
            </h3>
            <p>
                <?= $film["sortieFr"] ?>
            </p>
            <p>
                <?= $film["note"] ?> / 10
            </p>
        </div>
    </div>
<?php }

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$content = ob_get_clean();
require "view/template.php";