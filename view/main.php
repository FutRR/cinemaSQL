<?php
ob_start();
?>

<div class="slider_wrapper">
    <h3 class="box_title">À la une</h3>

    <!-- Slider main container -->
    <div class="swiper coverflow-swiper">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper coverflow-wrapper">

            <!-- Slides -->
            <?php foreach ($listCardFilm->fetchAll() as $cardFilm) { ?>
                <div class="swiper-slide coverflow-slide">
                    <a href="index.php?action=filmDetails&id=<?= $cardFilm["id_film"] ?>">
                        <img src="upload/film/affiche/<?= $cardFilm["affiche"] ?>" alt="affiche film">
                        <P>
                            <?= $cardFilm['titre'] ?>
                        </P>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="slider_wrapper">
    <h3>Nos Classiques</h3>
    <!-- Slider main container -->
    <div class="swiper scene-swiper">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper scene-wrapper">
            <!-- Slides -->
            <div class="swiper-slide scene-slide">
                <p>La Haine</p><img src="upload/film/scenes/scene-la-haine.jpg" alt="">
            </div>
            <div class="swiper-slide scene-slide">
                <p>Star Wars : Episode IV</p><img src="upload/film/scenes/scene-star-wars-4.jpg" alt="">
            </div>
            <div class="swiper-slide scene-slide">
                <p>Kill Bill Vol.1</p><img src="upload/film/scenes/scene-kill-bill-1.jpg" alt="">
            </div>
            <div class="swiper-slide scene-slide">
                <p>Les Affranchis</p><img src="upload/film/scenes/affranchis-scene.jpg" alt="">
            </div>
            <div class="swiper-slide scene-slide">
                <p>Full Metal Jacker</p><img src="upload/film/scenes/scene-fmj.jpg" alt="">
            </div>
            <div class="swiper-slide scene-slide">
                <p>Blade Runner 2049</p><img src="upload/film/scenes/blade-runner-2049-joi.jpg" alt="">
            </div>
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>


        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</div>


<div class="slider_wrapper">
    <h3 class="box_title">Acteurs du moment</h3>

    <!-- Slider main container -->
    <div class="swiper coverflow-swiper">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper coverflow-wrapper">

            <!-- Slides -->
            <?php foreach ($listCardActeur->fetchAll() as $cardActeur) { ?>
                <div class="swiper-slide coverflow-slide">
                    <a href="index.php?action=acteurDetails&id=<?= $cardActeur["id_acteur"] ?>">
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