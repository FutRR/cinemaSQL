<?php
ob_start();
?>

<?php $realisateur = $realisateurDetails->fetch(); ?>

<div class="details_wrapper">

    <div class="details_infos">
        <img class="details_img" src="upload/personne/<?= $realisateur["image"] ?>" alt="image realisateur">

        <div>
            <h3>
                <?= $realisateur["personne"] ?>
            </h3>
            <p>
                <?= $realisateur["dateNaissance"] ?>
            </p>
            <p>
                <?= $realisateur["sexe"] ?>
            </p>
        </div>
    </div>

    <div class="details_txt">
        <h4>Biographie :</h4>
        <p>
            <?= $realisateur["biographie"] ?>
        </p>
    </div>

    <div class="films_wrap">
        <h4>Filmographie :</h4>
        <div class="films">
            <?php foreach ($films->fetchAll() as $film) { ?>
                <a href="index.php?action=filmDetails&id=<?= $film["id_film"] ?>">
                    <div class="film">
                        <img src="upload/film/affiche/<?= $film['affiche'] ?>" alt="">
                        <p>
                            <?= $film["titre"] ?>
                        </p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>


</div>

<?php
$titre = $realisateur["personne"];
if ($realisateur["sexe"] === "M") {
    $titre_secondaire = "{$acteur["personne"]} | Réalisateur";
} elseif ($realisateur["sexe"] === "F") {
    $titre_secondaire = "{$acteur["personne"]} | Réalisatrice";
}
$content = ob_get_clean();
require "view/template.php";
?>