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
        $listActeurs = $pdo->query("SELECT image, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        $filmsParActeurs = $pdo->query("SELECT film.id_film, titre 
        FROM film
        INNER JOIN casting ON film.id_film = casting.id_film
        ");

        require "view/listActeurs.php";
    }
}