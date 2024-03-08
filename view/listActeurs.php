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
                <?php foreach ($filmsParActeurs->fetchAll() as $films) {
                    echo $films["titre"];
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
