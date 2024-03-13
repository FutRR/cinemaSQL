<?php
ob_start();

?>

<form action="index.php?action=addCasting&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">

    <p>
        <label>
            Role :
            <select name="id_role">
                <option value="">-- Role --</option>

                <?php foreach ($listRoles->fetchAll() as $role) { ?>
                    <option value="<?= $role["id_role"] ?>">
                        <?= $role["nomRole"] ?>
                    </option>
                <?php } ?>
            </select>
        </label>
    </p>

    <p>
        <label>
            <a class="add_btn" href="index.php?action=addRole">Créer un role</a>
        </label>
    </p>

    <p>
        <label>
            Acteur :
            <select name="id_acteur">
                <option value="">-- Acteur --</option>
                <?php foreach ($listActeurs->fetchAll() as $acteur) { ?>
                    <option value="<?= $acteur["id_acteur"] ?>">
                        <?= $acteur["personne"] ?>
                    </option>
                <?php } ?>
            </select>
        </label>
    </p>

    <p>
        <input type="submit" name="submit" value="Ajouter">
    </p>

</form>

<?php
$titre = "Ajout d'un casting";
$titre_secondaire = "Ajout d'un casting";
$content = ob_get_clean();
require "view/template.php";
?>