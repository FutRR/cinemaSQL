<?php
ob_start();

$realisateur = $prevRealisateurInfos->fetch();
?>

<form action="index.php?action=updateRealisateur&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Nom :
            <input type="text" name="nom" value="<?= $realisateur["nom"] ?>">
        </label>
    </p>

    <p>
        <label>
            Prenom :
            <input type="text" name="prenom" value="<?= $realisateur["prenom"] ?>">
        </label>
    </p>

    <p>
        <label>
            Date de naissance :
            <input type="date" name="dateNaissance" value="<?= $realisateur["dateNaissance"] ?>">
        </label>
    </p>

    <p>
        <label>
            Sexe :
            <input type="text" name="sexe" value="<?= $realisateur["sexe"] ?>">
        </label>
    </p>

    <p>
        <label>
            Biographie :
            <textarea name="biographie" rows="3"><?= $realisateur["biographie"] ?>"</textarea>
        </label>
    </p>

    <p>
        <label>
            Image :
            <input type="file" name="file">
        </label>
    </p>

    <p>
        <input type="submit" name="submit" value="Modifier le realisateur">
    </p>
</form>

<?php
$titre = "Modification d'un realisateur";
$titre_secondaire = "Modification d'un realisateur";
$content = ob_get_clean();
require "view/template.php";
?>