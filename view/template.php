<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Mov/ies, le site référence qui vous donne les meilleures informations de vos films préférés !">
    <meta name="theme-color" content="#101C28" />
    <title>
        <?= $titre ?>
    </title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>

    <img class="waves top_waves" src="public/img/topWaves.svg" alt="background waves">

    <nav>
        <a href="index.php">
            <img class="logo" src="public/img/logo.png" alt="logo">
        </a>

        <ul>
            <li><a href="index.php" class="nav_links nav_link1">Accueil</a></li>
            <li><a href="index.php?action=listFilms" class="nav_links nav_link2">Films</a></li>
            <li><a href="index.php?action=listGenres" class="nav_links nav_link3">Genres</a></li>
            <li><a href="index.php?action=listActeurs" class="nav_links nav_link4">Acteurs</a></li>
            <li><a href="index.php?action=listRealisateurs" class="nav_links nav_link5">Réalisateurs</a></li>
        </ul>

        <div class="menuburger" onclick="menuChange(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>

    </nav>

    <main>
        <h2>
            <?= $titre_secondaire ?>
        </h2>
        <?= $content ?>
    </main>

    <img class="waves bottom_waves" src="public/img/bottomWaves.svg" alt="">

    <footer>
        <div class="follow">
            <h3>Suivez Nous</h3>
            <div class="icons">
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
        </div>

        <div class="bar"></div>

        <div class="newsletter">
            <h3>Rejoignez la newsletter</h3>
            <p>POUR RECEVOIR TOUTES LES DERNIERES INFOS SUR VOS FILMS PRÉFÉRÉS</p>
            <p class="fake_btn">Rejoindre</p>
        </div>

        <div class="bar"></div>

        <div class="contact">
            <h3>Contact</h3>
            <p>06 XX XX XX XX</p>
            <p>contact@movies.com</p>
        </div>

        <div class="bar"></div>

        <div class="legal">
            <p>Mentions Légales</p>
            <p>Politique de cookies</p>
            <p>Conditions générales d'utilisation</p>
            <p>Données Personnelles</p>
        </div>

        <div class="copyright">
            <p>Copyright © 2024 - Tous droits réservés</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/19a031a4c5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/19a031a4c5.js" crossorigin="anonymous"></script>
    <script src="./public/js/script.js"></script>

</body>

</html>