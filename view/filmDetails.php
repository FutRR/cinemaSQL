<?php
ob_start();
?>

<?php $film = $filmDetails->fetch(); ?>
<div class="details_wrapper">


    <div class="film_infos">
        <img class="film_img" src="<?= $film["affiche"] ?>" alt="affiche film">

        <div class="film_txt">
            <h3>
                <?= $film["titre"] ?>
            </h3>
            <p>
                <?= $film["sortieFr"] ?> |
                <?= $film["duree"] ?> minutes
            </p>
            <p class="note">
                <i class="fa-regular fa-star"></i>
                <span>
                    <?= $film["note"] ?>
                </span> / 10
            </p>
            <p>
                <?= $film["personne"] ?>
            </p>
        </div>
    </div>

    <div class="synopsis">
        <h4>Synopsis :</h4>
        <p>
            <?= $film["synopsis"] ?>
        </p>
    </div>

    <div class="acteurs_wrap">
        <h4>Casting :</h4>
        <div class="acteurs">
            <?php foreach ($acteurs->fetchAll() as $acteur) { ?>
                <div class="acteur">
                    <img src="<?= $acteur['image'] ?>" alt="">
                    <p>
                        <?= $acteur["personne"] ?>
                    </p>
                    <p>
                        <?= $acteur["nomRole"] ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>


</div>

<?php
$titre = $film["titre"];
$titre_secondaire = $film["titre"];
$content = ob_get_clean();
require "view/template.php";
?>