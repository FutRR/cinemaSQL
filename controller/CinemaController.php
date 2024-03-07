<?php

namespace Controller;

use Model\Connect;

class CinemaController
{
    //Lister des films //
    public function listFilms()
    {
        $pdo = Connect::seConnecter();
        $query = $pdo->query("SELECT * FROM film");
        require "view/listFilms.php";
    }

    //Lister des acteurs //
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $query = $pdo->query("
        SELECT nom, prenom, image, CONCAT(film.id_film, '=>', titre) AS filmList
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
        INNER JOIN film ON casting.id_film = film.id_film
        ");
        require "view/listActeurs.php";

    }
}