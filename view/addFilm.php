<?php
ob_start();
?>

<form action="index.php?action=addFilm" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Titre :
            <input type="text" name="titre">
        </label>
    </p>

    <p>
        <label>
            Année de sortie :
            <input type="number" min="1895" max="2050" step="none" name="sortieFr">
        </label>
    </p>

    <p>
        <label>
            Durée en minutes :
            <input type="number" max="500" name="duree">
        </label>
    </p>

    <p>
        <label>
            Note sur 10 :
            <input type="number" max="10" min="0" name="note">
        </label>
    </p>

    <p>
        <label>
            Synopsis :
            <textarea name="synopsis" rows="3"></textarea>
        </label>
    </p>

    <p>
        <label>
            Affiche :
            <input type="file" name="file">
        </label>
    </p>

    <p>
        <label>
            Réalisateur :
            <select name="id_realisateur">
                <?php foreach ($listRealisateurs->fetchAll() as $realisateur) { ?>
                    <option value="<?= $realisateur["id_realisateur"] ?>">
                        <?= $realisateur["personne"] ?>
                    </option>
                <?php } ?>
            </select>
        </label>
    </p>

    <p>
    <fieldset>
        <legend>Genres :</legend>
        <input type="checkbox" name="" id="">
    </fieldset>
    </p>

    <p>
        <input type="submit" name="submit" value="Ajouter le film">
    </p>


</form>

<?php
$titre = "Ajout d'un film";
$titre_secondaire = "Ajout d'un film";
$content = ob_get_clean();
require "view/template.php";
