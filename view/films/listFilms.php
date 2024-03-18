<?php
ob_start();
?>

<a class="add_btn" href="index.php?action=addFilm">Ajouter</a>

<?php foreach ($listFilms->fetchAll() as $film) { ?>
    <a href="index.php?action=filmDetails&id=<?= $film['id_film'] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="upload/film/affiche/<?= $film["affiche"] ?>" alt="affiche">
            <div class="list_infos">
                <h3>
                    <?= $film["titre"] ?>
                </h3>
                <p>
                    <?= $film["sortieFr"] ?>
                </p>
                <p class="note">
                    <i class="fa-regular fa-star"></i>
                    <span>
                        <?= $film["note"] ?>
                    </span> / 10
                </p>
            </div>
        </div>
    </a>
<?php }

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$content = ob_get_clean();
require "view/template.php";
