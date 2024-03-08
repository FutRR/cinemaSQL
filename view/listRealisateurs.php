<?php
ob_start();
?>

<?php foreach ($listRealisateurs->fetchAll() as $realisateur) { ?>
    <div class="list_wrapper">
        <img class="list_img" src="<?= $realisateur["image"] ?>" alt="photo">
        <div class="list_infos">
            <h3>
                <?= $realisateur["personne"] ?>
            </h3>
        </div>
    </div>
    <?php
}

$titre = "Liste des Realisateurs";
$titre_secondaire = "Liste des Realisateurs";
$content = ob_get_clean();
require "view/template.php";
