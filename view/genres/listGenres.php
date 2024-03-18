<?php
ob_start();

if (isset ($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['success_message']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['error_message'])) {
    echo $_SESSION['error_message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['error_message']);
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
