<?php
ob_start();
?>

<?php $film = $filmDetails->fetch(); ?>
<div class="details_wrapper">


    <div class="details_infos">
        <img class="details_img" src="<?= $film["affiche"] ?>" alt="affiche film">

        <div>
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
            <a href="index.php?action=realisateurDetails&id=<?= $film["id_personne"] ?>">
                <p>
                    <?= $film["personne"] ?>
                </p>
            </a>
        </div>
    </div>

    <div class="details_txt">
        <h4>Synopsis :</h4>
        <p>
            <?= $film["synopsis"] ?>
        </p>
    </div>

    <div class="acteurs_wrap">
        <h4>Casting :</h4>
        <div class="acteurs">
            <?php foreach ($acteurs->fetchAll() as $acteur) { ?>
                <a href="index.php?action=acteurDetails&id=<?= $acteur["id_personne"] ?>">
                    <div class="acteur">
                        <img src="<?= $acteur['image'] ?>" alt="">
                        <p>
                            <?= $acteur["personne"] ?>
                        </p>
                        <p>
                            <?= $acteur["nomRole"] ?>
                        </p>
                    </div>
                </a>
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