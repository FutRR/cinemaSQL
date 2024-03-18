<?php
ob_start();

$genre = $prevGenreInfos->fetch();
?>

<form action="index.php?action=updateGenre&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Nom :
            <input type="text" name="nom" value="<?= $genre["nomGenre"] ?>">
        </label>
    </p>


    <p>
        <input type="submit" name="submit" value="Modifier le genre">
    </p>
</form>

<?php
$titre = "Modification d'un genre";
$titre_secondaire = "Modification d'un genre";
$content = ob_get_clean();
require "view/template.php";
?>