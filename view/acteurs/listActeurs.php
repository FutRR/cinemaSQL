<?php
ob_start();

// Afficher un message de succès s'il est défini
if (isset ($_SESSION['addActeur'])) {
    echo $_SESSION['addActeur'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['addActeur']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['addActeur'])) {
    echo $_SESSION['addActeur'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['addActeur']);
}

?>

<a class="add_btn" href="index.php?action=addActeur">Ajouter</a>

<?php foreach ($listActeurs->fetchAll() as $acteur) { ?>
    <a href="index.php?action=acteurDetails&id=<?= $acteur["id_acteur"] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="upload/personne/<?= $acteur["image"] ?>" alt="photo">
            <div class="list_infos">
                <h3>
                    <?= $acteur["personne"] ?>
                </h3>
                <p>
                    <?php
                    $keys = explode('idEnd', $acteur['idFilms']);
                    $vals = explode('titreEnd', $acteur['titreFilms']);

                    $results = array_combine($keys, $vals);
                    $i = 1;
                    foreach ($results as $id => $film) {
                        echo "<a class='list_links' href='index.php?action=filmDetails&id={$id}'> $film <br></a>";
                        if (++$id < 2)
                            break;
                    } ?>
                </p>
            </div>
        </div>
    </a>
<?php }

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/template.php";
