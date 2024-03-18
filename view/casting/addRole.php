<?php
ob_start();
?>

<form action="index.php?action=addRole" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Nom du role :
            <input type="text" name="nomRole">
        </label>
    </p>
    <p>
        <input type="submit" name="submit" value="Ajouter le role">
    </p>
</form>

<?php
$titre = "Ajout d'un role";
$titre_secondaire = "Ajout d'un role";
$content = ob_get_clean();
require "view/template.php";
?>