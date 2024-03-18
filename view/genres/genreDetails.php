<?php
ob_start();
?>

<?php foreach ($genreDetails->fetchAll() as $genre) { ?>
    <a href="index.php?action=filmDetails&id=<?= $genre['id_film'] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="upload/film/affiche/<?= $genre["affiche"] ?>" alt="affiche">
            <div class="list_infos">
                <h3>
                    <?= $genre["titre"] ?>
                </h3>
                <p>
                    <?= $genre["sortieFr"] ?>
                </p>
                <p class="note">
                    <i class="fa-regular fa-star"></i>
                    <span>
                        <?= $genre["note"] ?>
                    </span> / 10
                </p>
            </div>
        </div>
    </a>
<?php } ?>

<a class="add_btn" href="index.php?action=updateGenre&id=<?= $genre["id_genre"] ?>">Modifier</a>

<?php
$titre = $genre["nomGenre"];
$titre_secondaire = $genre["nomGenre"];
$content = ob_get_clean();
require "view/template.php";
