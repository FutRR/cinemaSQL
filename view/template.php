<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $titre ?>
    </title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

    <footer>
        <img class="waves bottom_waves" src="public/img/bottomWaves.svg" alt="">
    </footer>

    <script src="https://kit.fontawesome.com/19a031a4c5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./public/js/script.js"></script>

</body>

</html>