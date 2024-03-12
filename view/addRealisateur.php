<?php
ob_start();
?>

<form action="index.php?action=addRealisateur" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Nom :
            <input type="text" name="nom">
        </label>
    </p>

    <p>
        <label>
            Prenom :
            <input type="text" name="prenom">
        </label>
    </p>

    <p>
        <label>
            Date de naissance :
            <input type="date" name="dateNaissance">
        </label>
    </p>

    <p>
        <label>
            Sexe :
            <input type="text" name="sexe">
        </label>
    </p>

    <p>
        <label>
            Biographie :
            <textarea name="biographie" rows="3"></textarea>
        </label>
    </p>

    <p>
        <label>
            Image :
            <input type="file" name="file">
        </label>
    </p>

    <p>
        <input type="submit" name="submit" value="Ajouter le réalisateur">
    </p>
</form>

<?php
var_dump($_POST);

$titre = "Ajout d'un réalisateur";
$titre_secondaire = "Ajout d'un réalisateur";
$content = ob_get_clean();
require "view/template.php";
?>