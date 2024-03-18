<?php
ob_start();

$acteur = $prevActeurInfos->fetch();
?>

<form action="index.php?action=updateActeur&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Nom :
            <input type="text" name="nom" value="<?= $acteur["nom"] ?>">
        </label>
    </p>

    <p>
        <label>
            Prenom :
            <input type="text" name="prenom" value="<?= $acteur["prenom"] ?>">
        </label>
    </p>

    <p>
        <label>
            Date de naissance :
            <input type="date" name="dateNaissance" value="<?= $acteur["dateNaissance"] ?>">
        </label>
    </p>

    <p>
        <label>
            Sexe :
            <input type="text" name="sexe" value="<?= $acteur["sexe"] ?>">
        </label>
    </p>

    <p>
        <label>
            Biographie :
            <textarea name="biographie" rows="3"><?= $acteur["biographie"] ?></textarea>
        </label>
    </p>

    <p>
        <label>
            Image :
            <input type="file" name="file">
        </label>
    </p>

    <p>
        <input type="submit" name="submit" value="Modifier l'acteur">
    </p>
</form>

<?php
$titre = "Modification d'un acteur";
$titre_secondaire = "Modification d'un acteur";
$content = ob_get_clean();
require "view/template.php";
?>