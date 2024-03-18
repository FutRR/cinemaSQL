<?php
ob_start();
?>

<div class="box_wrapper">
    <h3 class="box_title">À la une</h3>
    <div class="card_wrapper">
        <?php foreach ($listCardFilm->fetchAll() as $cardFilm) { ?>
            <a href="index.php?action=filmDetails&id=<?= $cardFilm["id_film"] ?>">

                <div class="card">
                    <img src="upload/film/affiche/<?= $cardFilm["affiche"] ?>" alt="affiche film">
                    <p><strong>
                            <?= $cardFilm["titre"] ?>
                        </strong></p>
                    <p><strong>
                            <?= $cardFilm["sortieFr"] ?>
                        </strong></p>
                </div>
            </a>
        <?php } ?>
    </div>
</div>


<div class="slider_wrapper">

    <h3>Nos Classiques</h3>
    <!-- Slider main container -->
    <div class="swiper">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide"><img src="upload/film/scenes/scene-la-haine.jpg" alt=""></div>
            <div class="swiper-slide"><img src="upload/film/scenes/scene-star-wars-4.jpg" alt=""></div>
            <div class="swiper-slide"><img src="upload/film/scenes/scene-kill-bill-1.jpg" alt=""></div>
            <div class="swiper-slide"><img src="upload/film/scenes/affranchis-scene.jpg" alt=""></div>
            <div class="swiper-slide"><img src="upload/film/scenes/scene-fmj.jpg" alt=""></div>
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>


        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</div>


<div class="box_wrapper">
    <h3 class="box_title">Acteurs du moment</h3>
    <div class="card_wrapper">
        <?php foreach ($listCardActeur->fetchAll() as $cardActeur) { ?>
            <a href="index.php?action=acteurDetails&id=<?= $cardActeur["id_acteur"] ?>">
                <div class="card">
                    <img src="upload/personne/<?= $cardActeur["image"] ?>" alt="image Acteur">
                    <p><strong>
                            <?= $cardActeur["personne"] ?>
                        </strong></p>
                </div>
            </a>
        <?php } ?>
    </div>
</div>



<?php
$titre = "Accueil";
$titre_secondaire = "Accueil";
$content = ob_get_clean();
require "view/template.php";
?>