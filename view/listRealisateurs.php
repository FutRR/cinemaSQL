<?php
ob_start();
?>

<?php foreach ($listRealisateurs->fetchAll() as $realisateur) { ?>
    <a href="index.php?action=realisateurDetails&id=<?= $realisateur["id_personne"] ?>">
        <div class="list_wrapper">
            <img class="list_img" src="<?= $realisateur["image"] ?>" alt="photo">
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
    <?php
}

$titre = "Liste des Realisateurs";
$titre_secondaire = "Liste des Realisateurs";
$content = ob_get_clean();
require "view/template.php";
