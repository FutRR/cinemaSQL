<?php
ob_start();

// Afficher un message de succès s'il est défini
if (isset ($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['message']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['message']);
}

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
                <p>
                    <?= $film["dureeFormat"] ?>
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
