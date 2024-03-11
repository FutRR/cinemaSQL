<?php
ob_start();
?>

<?php foreach ($listActeurs->fetchAll() as $acteur) { ?>
    <div class="list_wrapper">
        <img class="list_img" src="<?= $acteur["image"] ?>" alt="photo">
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
                    echo "<a class='list_links' href='index.php?action=infosFilm&id={$id}'> $film <br></a>";
                } ?>
            </p>
        </div>
    </div>
    <?php
}

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/template.php";
