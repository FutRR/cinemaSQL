<?php
ob_start();

$prevFilm = $prevFilmInfo->fetch();
?>

<form action="index.php?action=updateFilm&id=<?= $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
    <p>
        <label>
            Titre :
            <input type="text" name="titre" value="<?= $prevFilm['titre'] ?>">
        </label>
    </p>

    <p>
        <label>
            Année de sortie :
            <input type="number" min="1895" max="2050" step="none" name="sortieFr" value="<?= $prevFilm['sortieFr'] ?>">
        </label>
    </p>

    <p>
        <label>
            Durée en minutes :
            <input type="number" max="500" name="duree" value="<?= $prevFilm['duree'] ?>">
        </label>
    </p>

    <p>
        <label>
            Note sur 10 :
            <input type="number" max="11" min="0" name="note" value="<?= $prevFilm['note'] ?>">
        </label>
    </p>

    <p>
        <label>
            Synopsis :
            <textarea name="synopsis" rows="3"><?= $prevFilm['synopsis'] ?></textarea>
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
            <select name="id_realisateur" value="<?= $prevReal["id_realisateur"] ?>">
                <?php if ($listRealisateurs) {
                    foreach ($listRealisateurs->fetchAll() as $realisateur) {
                        $selected = ($realisateur["id_realisateur"] == $prevFilm["id_realisateur"]) ? 'selected' : ''; ?>
                        <option value="<?= $realisateur["id_realisateur"] ?>" <?= $selected ?>>
                            <?= $realisateur["personne"] ?>
                        </option>
                    <?php }
                } ?>
            </select>
        </label>
    </p>

    <p>
    <fieldset>
        <legend>Genres :</legend>
        <?php
        foreach ($listGenres->fetchAll() as $genre) {
            $checked = (in_array($genre['id_genre'], $idGenre)) ? 'checked' : ''; ?>
            <input type="checkbox" value="<?= $genre['id_genre'] ?>" name="id_genre[]" id="<?= $genre['id_genre'] ?>"
                <?= $checked ?>>
            <label for="<?= $genre['id_genre'] ?>">
                <?= $genre['nomGenre'] ?>
            </label>
        <?php } ?>
    </fieldset>
    </p>

    <p>
        <input type="submit" name="submit" value="Modifier le film">
    </p>


</form>

<?php
var_dump($listGenres->fetchAll());
$titre = "Modification d'un film";
$titre_secondaire = "Modification d'un film";
$content = ob_get_clean();
require "view/template.php";
