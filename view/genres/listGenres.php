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

<a class="add_btn" href="index.php?action=addGenre">Ajouter</a>

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
