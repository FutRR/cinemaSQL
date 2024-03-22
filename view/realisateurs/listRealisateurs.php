<?php
ob_start();

// Afficher un message de succès s'il est défini
if (isset ($_SESSION['addReal'])) {
    echo $_SESSION['addReal'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['addReal']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['addReal'])) {
    echo $_SESSION['addReal'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['addReal']);
}

?>

<a class="add_btn" href="index.php?action=addRealisateur">Ajouter</a>

<?php foreach ($listRealisateurs->fetchAll() as $realisateur) { ?>
    <a href="index.php?action=realisateurDetails&id=<?= $realisateur["id_realisateur"] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="upload/personne/<?= $realisateur["image"] ?>" alt="photo">
            <div class="list_infos">
                <h3>
                    <?= $realisateur["personne"] ?>
                </h3>
                <p>
                    <?php
                    $keys = explode('idEnd', $realisateur['idFilms']);
                    $vals = explode('titreEnd', $realisateur['titreFilms']);

                    $results = array_combine($keys, $vals);
                    foreach ($results as $id => $film) {
                        echo "<a class='list_links' href='index.php?action=filmDetails&id={$id}'> $film <br></a>";
                    } ?>
                </p>
            </div>
        </div>
    </a>
<?php }

$titre = "Liste des Realisateurs";
$titre_secondaire = "Liste des Realisateurs";
$content = ob_get_clean();
require "view/template.php";