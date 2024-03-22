<?php
ob_start();

$genre = $genreDetails->fetch();

// Afficher un message de succès s'il est défini
if (isset ($_SESSION['updateGenre'])) {
    echo $_SESSION['updateGenre'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['updateGenre']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['updateGenre'])) {
    echo $_SESSION['updateGenre'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['updateGenre']);
}

?>

<div class="btns">
    <a class="add_btn" href="index.php?action=updateGenre&id=<?= $genre["id_genre"] ?>">Modifier</a>
    <a class="del_btn" href="index.php?action=deleteGenre&id=<?= $genre["id_genre"] ?>">Supprimer</a>
</div>

<?php foreach ($genreFilmsDetails->fetchAll() as $films) { ?>

    <a href="index.php?action=filmDetails&id=<?= $films['id_film'] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="upload/film/affiche/<?= $films["affiche"] ?>" alt="affiche">
            <div class="list_infos">
                <h3>
                    <?= $films["titre"] ?>
                </h3>
                <p>
                    <?= $films["sortieFr"] ?>
                </p>
                <p class="note">
                    <i class="fa-regular fa-star"></i>
                    <span>
                        <?= $films["note"] ?>
                    </span> / 10
                </p>
            </div>
        </div>
    </a>
<?php } ?>


<?php
$titre = $genre["nomGenre"];
$titre_secondaire = $genre["nomGenre"];
$content = ob_get_clean();
require "view/template.php";
