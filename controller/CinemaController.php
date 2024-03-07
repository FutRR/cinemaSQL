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
        SELECT * 
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
        ");
        require "view/listActeurs.php";

    }
}