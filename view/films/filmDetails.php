<?php
ob_start();

$film = $filmDetails->fetch();
?>

<div class="details_wrapper">

    <div class="details_infos">
        <div class="img_wrapper">
            <img class="details_img" src="upload/film/affiche/<?= $film["affiche"] ?>" alt="affiche film">
        </div>

        <div>
            <h3>
                <?= $film["titre"] ?>
            </h3>

            <p>
                <?= $film["sortieFr"] ?> |
                <?= $film["dureeFormat"] ?>
            </p>

            <p class="note">
                <i class="fa-regular fa-star"></i>
                <span>
                    <?= $film["note"] ?>
                </span> / 10
            </p>
            <?php foreach ($genres->fetchAll() as $genre) { ?>
                <a href="index.php?action=genreDetails&id=<?= $genre['id_genre'] ?>">
                    <p>
                        <?= $genre['nomGenre'] ?>
                    </p>
                </a>
            <?php } ?>

            <a href="index.php?action=realisateurDetails&id=<?= $film["id_realisateur"] ?>">
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

        <a class="add_btn" href="index.php?action=addCasting&id=<?= $film["id_film"] ?>">Ajouter un casting</a>
        <div class="acteurs">
            <?php foreach ($acteurs->fetchAll() as $acteur) { ?>
                <div class="acteur">
                    <a href="index.php?action=acteurDetails&id=<?= $acteur["id_acteur"] ?>">

                        <img src="upload/personne/<?= $acteur['image'] ?>" alt="">
                        <p>
                            <?= $acteur["personne"] ?>
                        </p>
                        <p>
                            <?= $acteur["nomRole"] ?>
                        </p>
                    </a>
                    <a class="del_btn"
                        href="index.php?action=deleteCasting&acteurId=<?= $acteur["id_acteur"] ?>&filmId=<?= $film["id_film"] ?>">Supprimer
                    </a>

                </div>

            <?php } ?>
        </div>
    </div>

    <div class="btns">
        <a class="add_btn" href="index.php?action=updateFilm&id=<?= $film["id_film"] ?>">Modifier</a>
        <a class="del_btn" href="index.php?action=deleteFilm&id=<?= $film["id_film"] ?>">Supprimer</a>
    </div>


</div>



<?php
$titre = $film["titre"];
$titre_secondaire = $film["titre"];
$content = ob_get_clean();
require "view/template.php";
?>