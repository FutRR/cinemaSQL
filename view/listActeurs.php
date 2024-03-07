<?php
ob_start();
?>

<?php foreach ($query->fetchAll() as $acteur) { ?>
    <div class="list_wrapper">
        <img class="img_list" src="<?= $acteur["image"] ?>" alt="photo">
        <div class="list_infos">
            <h3>
                <?= $acteur["prenom"] ?>
                <?= $acteur["nom"] ?>
            </h3>
            <p>
            </p>
        </div>
    </div>
    <?php
}

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$content = ob_get_clean();
require "view/template.php";
