<?php
ob_start();
?>

<?php $acteur = $acteurDetails->fetch(); ?>

<div class="details_wrapper">

    <div class="details_infos">
        <img class="details_img" src="<?= $acteur["image"] ?>" alt="image acteur">

        <div>
            <h3>
                <?= $acteur["personne"] ?>
            </h3>
            <p>
                <?= $acteur["dateNaissance"] ?>
            </p>
            <p>
                <?= $acteur["sexe"] ?>
            </p>
        </div>
    </div>

    <div class="details_txt">
        <h4>Biographie :</h4>
        <p>
            <?= $acteur["biographie"] ?>
        </p>
    </div>

    <div class="films_wrap">
        <h4>Casting :</h4>
        <div class="films">
            <?php foreach ($films->fetchAll() as $film) { ?>
                <a href="index.php?action=filmDetails&id=<?= $film["id_film"] ?>">
                    <div class="film">
                        <img src="<?= $film['affiche'] ?>" alt="">
                        <p>
                            <?= $film["titre"] ?>
                        </p>
                        <p>
                            <?= $film["nomRole"] ?>
                        </p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>



</div>

<?php
$titre = $acteur["personne"];
$titre_secondaire = $acteur["personne"];
$content = ob_get_clean();
require "view/template.php";
?>