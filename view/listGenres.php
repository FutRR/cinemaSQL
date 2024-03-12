<?php
ob_start();
?>

<?php foreach ($listGenres->fetchAll() as $genre) { ?>
    <a href="index.php?action=genreDetails&id=<?= $genre["id_genre"] ?>">
        <div class="list_genre_wrapper">
            <div class="list_genre_infos">
                <h3>
                    <?= $genre["nomGenre"] ?>
                </h3>
            </div>
        </div>
    </a>
<?php }

$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$content = ob_get_clean();
require "view/template.php";
