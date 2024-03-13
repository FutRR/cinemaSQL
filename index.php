<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    require str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : "";

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "mainPage":
            $ctrlCinema->mainPage();
            break;

        case "listFilms":
            $ctrlCinema->listFilms();
            break;

        case "listActeurs":
            $ctrlCinema->listActeurs();
            break;

        case "listRealisateurs":
            $ctrlCinema->listRealisateurs();
            break;

        case "listGenres":
            $ctrlCinema->listGenres();
            break;

        case "filmDetails":
            $ctrlCinema->filmDetails($id);
            break;

        case "acteurDetails":
            $ctrlCinema->acteurDetails($id);
            break;

        case "realisateurDetails":
            $ctrlCinema->realisateurDetails($id);
            break;

        case "genreDetails":
            $ctrlCinema->genreDetails($id);
            break;

        case "addGenre":
            $ctrlCinema->addGenre();
            break;

        case "addRealisateur":
            $ctrlCinema->addRealisateur();
            break;

        case "addActeur":
            $ctrlCinema->addActeur();
            break;

        case "addFilm":
            $ctrlCinema->addFilm();
            break;

        case "addRole":
            $ctrlCinema->addRole();
            break;

        case "addCasting":
            $ctrlCinema->addCasting($id);
            break;

        default:
            $ctrlCinema->mainPage();
    }
} else {
    $ctrlCinema->mainPage();
}