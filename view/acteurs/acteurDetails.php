<?php
ob_start();

// Afficher un message de succès s'il est défini
if (isset ($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['message']);
}

// Afficher un message d'erreur s'il est défini
if (isset ($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Supprimer le message de la session une fois affiché
    unset($_SESSION['message']);
}

$acteur = $acteurDetails->fetch();
?>

<div class="details_wrapper">

    <div class="details_infos">
        <img class="details_img" src="upload/personne/<?= $acteur["image"] ?>" alt="image acteur">

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
        <h4>Filmographie :</h4>
        <div class="films">
            <?php foreach ($films->fetchAll() as $film) { ?>
                <a href="index.php?action=filmDetails&id=<?= $film["id_film"] ?>">
                    <div class="film">
                        <img src="upload/film/affiche/<?= $film['affiche'] ?>" alt="">
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

    <a class="add_btn" href="index.php?action=updateActeur&id=<?= $acteur["id_personne"] ?>">Modifier</a>
    <a class="del_btn"
        href="index.php?action=deleteActeur&acteurId=<?= $acteur["id_acteur"] ?>&personneId=<?= $acteur['id_personne'] ?>">Supprimer
    </a>


</div>

<?php
$titre = $acteur["personne"];
if ($acteur["sexe"] === "M") {
    $titre_secondaire = "{$acteur["personne"]} | Acteur";
} elseif ($acteur["sexe"] === "F") {
    $titre_secondaire = "{$acteur["personne"]} | Actrice";
}
$content = ob_get_clean();
require "view/template.php";
?>