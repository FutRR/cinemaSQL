<?php

namespace Controller;

use Model\Connect;

class CinemaController
{
    //Lister des films //
    public function listFilms()
    {
        $pdo = Connect::seConnecter();
        $listFilms = $pdo->query("SELECT * FROM film");
        require "view/listFilms.php";
    }

    //Lister des acteurs //
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $listActeurs = $pdo->query("SELECT image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
        INNER JOIN film ON casting.id_film = film.id_film
        GROUP BY acteur.id_acteur
        ");

        require "view/listActeurs.php";
    }

    //Lister des genres//
    public function listGenres()
    {
        $pdo = Connect::seConnecter();
        $listGenres = $pdo->query("SELECT * FROM genre");

        require "view/listGenres.php";
    }

    //Lister des Réalisateurs//
    public function listRealisateurs()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
        GROUP BY realisateur.id_realisateur
        ");

        require "view/listRealisateurs.php";
    }
}