<?php
ob_start();
?>
<div class="sliders">
    <div class="slider_wrapper">
        <h3 class="slider_title">À la une</h3>

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
        <h3 class="slider_title">Nos Classiques</h3>
        <!-- Slider main container -->
        <div class="swiper scene-swiper">

            <!-- Additional required wrapper -->
            <div class="swiper-wrapper scene-wrapper">
                <!-- Slides -->
                <div class="swiper-slide scene-slide">
                    <p>La Haine</p><img src="public/img/scenes/la-haine-2.jpg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Star Wars : Episode IV</p><img
                        src="public/img/scenes/fb_open-uri20150608-27674-hoqoq5-1496b98b.jpg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Kill Bill Vol.1</p><img src="public/img/scenes/kill-bill-vol-1_kd3dqe-1024x578.jpeg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Les Sept Samuraïs</p><img src="public/img/scenes/1l-3ac3821b547c.jpeg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Les Affranchis</p><img src="public/img/scenes/affranchis-scene.jpg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Full Metal Jacker</p><img src="public/img/scenes/scene-fmj.jpg" alt="">
                </div>
                <div class="swiper-slide scene-slide">
                    <p>Blade Runner 2049</p><img src="public/img/scenes/blade-runner-2049-joi.jpg" alt="">
                </div>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>


    <div class="slider_wrapper">
        <h3 class="slider_title">Acteurs du moment</h3>

        <!-- Slider main container -->
        <div class="swiper coverflow-swiper">

            <!-- Additional required wrapper -->
            <div class="swiper-wrapper coverflow-wrapper">

                <!-- Slides -->
                <?php foreach ($listCardActeur->fetchAll() as $cardActeur) { ?>
                    <div class="swiper-slide coverflow-slide">
                        <a href="index.php?action=acteurDetails&id=<?= $cardActeur["id_acteur"] ?>">
                            <img src="upload/personne/<?= $cardActeur["image"] ?>" alt="image Acteur">
                            <p>
                                <?= $cardActeur["personne"] ?>
                            </p>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>



    <?php
    $titre = "Accueil";
    $titre_secondaire = "Accueil";
    $content = ob_get_clean();
    require "view/template.php";
    ?>