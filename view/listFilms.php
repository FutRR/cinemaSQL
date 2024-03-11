<?php
ob_start();
?>

<?php foreach ($listFilms->fetchAll() as $film) { ?>
    <a href="index.php?action=filmDetails&id=<?= $film['id_film'] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="<?= $film["affiche"] ?>" alt="affiche">
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
    </a>
<?php }

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$content = ob_get_clean();
require "view/template.php";
