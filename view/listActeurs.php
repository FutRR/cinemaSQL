<?php
ob_start();
?>

<?php foreach ($listActeurs->fetchAll() as $acteur) { ?>
    <a href="index.php?action=acteurDetails&id=<?= $acteur["id_personne"] ?>">
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
                    foreach ($results as $id => $film) {
                        echo "<a class='list_links' href='index.php?action=filmDetails&id={$id}'> $film <br></a>";
                    } ?>
                </p>
            </div>
        </div>
    </a>
    <?php
}

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/template.php";
