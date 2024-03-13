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
        $listActeurs = $pdo->query("SELECT personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
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
        $listRealisateurs = $pdo->query("SELECT personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
        GROUP BY realisateur.id_realisateur
        ");

        require "view/listRealisateurs.php";
    }

    //Détails d'un film//
    public function filmDetails()
    {
        $pdo = Connect::seConnecter();
        if (isset($_GET["id"])) {
            $index = $_GET["id"];
            $filmDetails = $pdo->prepare("SELECT *, CONCAT(prenom, ' ', nom) AS personne 
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_film = :id_film");
            $filmDetails->execute(["id_film" => $index]);

            $acteurs = $pdo->prepare("SELECT personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, role.id_role, nomRole
            FROM casting
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN film ON casting.id_film = film.id_film
            INNER JOIN role ON casting.id_role = role.id_role
            WHERE casting.id_film = :id_film");
            $acteurs->execute(["id_film" => $index]);

            require "view/filmDetails.php";
        }
    }

    //Détails d'un acteur//
    public function acteurDetails()
    {
        $pdo = Connect::seConnecter();
        if (isset($_GET["id"])) {
            $index = $_GET["id"];
            $acteurDetails = $pdo->prepare("SELECT *, CONCAT(prenom, ' ', nom) AS personne 
            FROM personne
            WHERE id_personne = :id_personne");
            $acteurDetails->execute(["id_personne" => $index]);

            $films = $pdo->prepare("SELECT film.id_film, film.titre, film.affiche, role.id_role, role.nomRole
            FROM film
            INNER JOIN casting ON film.id_film = casting.id_film
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN role ON casting.id_role = role.id_role
            WHERE personne.id_personne = :id_personne");
            $films->execute(["id_personne" => $index]);


            require "view/acteurDetails.php";
        }
    }

    //Détails d'un réalisateur//
    public function realisateurDetails()
    {
        $pdo = Connect::seConnecter();
        if (isset($_GET["id"])) {
            $index = $_GET["id"];
            $realisateurDetails = $pdo->prepare("SELECT *, CONCAT(prenom, ' ', nom) AS personne 
            FROM personne
            WHERE id_personne = :id_personne");
            $realisateurDetails->execute(["id_personne" => $index]);

            $films = $pdo->prepare("SELECT film.id_film, film.titre, film.affiche
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE personne.id_personne = :id_personne");
            $films->execute(["id_personne" => $index]);


            require "view/realisateurDetails.php";
        }
    }

    //Détails d'un genre//
    public function genreDetails()
    {
        $pdo = Connect::seConnecter();
        if (isset($_GET["id"])) {
            $index = $_GET["id"];
            $genreDetails = $pdo->prepare("SELECT film.id_film, film.titre, film.sortieFr, film.note, film.affiche, classer.id_genre, genre.nomGenre
            FROM film
            INNER JOIN classer ON film.id_film = classer.id_film
            INNER JOIN genre ON classer.id_genre = genre.id_genre
            WHERE genre.id_genre = :id_genre");
            $genreDetails->execute(["id_genre" => $index]);

            require "view/genreDetails.php";
        }
    }

    //Ajout d'un film//
    public function addGenre()
    {
        $pdo = Connect::seConnecter();
        if (isset($_POST["submit"])) {
            $nomGenre = filter_var($_POST["nomGenre"], FILTER_SANITIZE_SPECIAL_CHARS);

            $addGenre = $pdo->prepare("INSERT INTO genre (nomGenre)
            VALUES (:nomGenre)");

            $addGenre->bindValue(":nomGenre", $nomGenre);
            $addGenre->execute();
        }
        require "view/addGenre.php";
    }

    //Ajout d'un Réalisateur//
    public function addRealisateur()
    {
        $pdo = Connect::seConnecter();
        if (isset($_POST["submit"])) {

            $nom = filter_var($_POST["nom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($_POST["prenom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateNaissance = filter_var($_POST["dateNaissance"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_var($_POST["sexe"], FILTER_SANITIZE_SPECIAL_CHARS);
            $biographie = filter_var($_POST["biographie"], FILTER_SANITIZE_SPECIAL_CHARS);
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 400000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = $uniqueName . "." . $extension;
                //$file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($tmpName, 'upload/personne/' . $file);

                $addPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, dateNaissance, sexe, biographie, image) 
                VALUES (:nom, :prenom, :dateNaissance, :sexe, :biographie, :image)");

                $addPersonne->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "dateNaissance" => $dateNaissance,
                    "sexe" => $sexe,
                    "biographie" => $biographie,
                    "image" => $file,
                ]);

                $lastInsertedId = $pdo->lastInsertId();

                $addRealisateur = $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
                $addRealisateur->execute(["id_personne" => $lastInsertedId]);

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }
        }
        require "view/addRealisateur.php";
    }

    //Ajout d'un Acteur//
    public function addActeur()
    {
        $pdo = Connect::seConnecter();
        if (isset($_POST["submit"])) {

            $nom = filter_var($_POST["nom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($_POST["prenom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateNaissance = filter_var($_POST["dateNaissance"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_var($_POST["sexe"], FILTER_SANITIZE_SPECIAL_CHARS);
            $biographie = filter_var($_POST["biographie"], FILTER_SANITIZE_SPECIAL_CHARS);
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 400000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = $uniqueName . "." . $extension;
                //$file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($tmpName, 'upload/personne/' . $file);

                $addPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, dateNaissance, sexe, biographie, image) 
                VALUES (:nom, :prenom, :dateNaissance, :sexe, :biographie, :image)");

                $addPersonne->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "dateNaissance" => $dateNaissance,
                    "sexe" => $sexe,
                    "biographie" => $biographie,
                    "image" => $file,
                ]);

                $lastInsertedId = $pdo->lastInsertId();

                $addActeur = $pdo->prepare("INSERT INTO acteur (id_personne) VALUES (:id_personne)");
                $addActeur->execute(["id_personne" => $lastInsertedId]);

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }
        }
        require "view/addActeur.php";
    }

    //AJout d'un film//
    public function addFilm()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT id_realisateur, image, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ");

        $listGenres = $pdo->query("SELECT * FROM genre");


        if (isset($_POST["submit"])) {
            $titre = filter_var($_POST["titre"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sortieFr = filter_var($_POST["sortieFr"], FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_var($_POST["duree"], FILTER_SANITIZE_NUMBER_INT);
            $note = filter_var($_POST["note"], FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_var($_POST["synopsis"], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_realisateur = filter_var($_POST["id_realisateur"], FILTER_SANITIZE_NUMBER_INT);
            $id_genre = filter_var($_POST["id_genre"], FILTER_SANITIZE_NUMBER_INT);

            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 400000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = $uniqueName . "." . $extension;
                //$file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($tmpName, 'upload/film/' . $file);


                $addFilm = $pdo->prepare("INSERT INTO film (titre, sortieFr, duree, note, synopsis, affiche, id_realisateur)
                VALUES (:titre, :sortieFr, :duree, :note, :synopsis, :affiche, :id_realisateur)");

                $addFilm->execute([
                    "titre" => $titre,
                    "sortieFr" => $sortieFr,
                    "duree" => $duree,
                    "note" => $note,
                    "synopsis" => $synopsis,
                    "affiche" => $file,
                    "id_realisateur" => $id_realisateur,
                ]);

                $lastInsertedId = $pdo->lastInsertId();

                foreach ($_POST["id_genre"] as $genre) {

                    $addGenre = $pdo->prepare("INSERT INTO classer (id_film, id_genre) 
                    VALUES (:id_film, :id_genre)");
                    $addGenre->execute([
                        "id_film" => $lastInsertedId,
                        "id_genre" => $genre,
                    ]);
                }

            }
        }
        require "view/addFilm.php";
    }


}