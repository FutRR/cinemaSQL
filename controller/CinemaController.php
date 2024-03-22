<?php

namespace Controller;

use Model\Connect;


session_start();

class CinemaController
{

    public function mainPage()
    {
        $pdo = Connect::seConnecter();
        $listCardFilm = $pdo->query("SELECT * 
        FROM film 
        ORDER BY sortieFr 
        DESC LIMIT 3");

        $listCardActeur = $pdo->query("SELECT acteur.id_acteur, personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne 
        FROM acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
        INNER JOIN film ON casting.id_film = film.id_film
        ORDER BY sortieFr DESC
        LIMIT 3");

        require "view/main.php";
    }
    //Lister des films //
    public function listFilms()
    {
        $pdo = Connect::seConnecter();
        $listFilms = $pdo->query("SELECT *, REPLACE(SUBSTRING(SEC_TO_TIME(duree*60), 2, 4), ':', 'h') AS dureeFormat FROM film ORDER BY sortieFr");
        require "view/films/listFilms.php";
    }

    //Lister des acteurs //
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $listActeurs = $pdo->query("SELECT acteur.id_acteur, personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
        FROM acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
        INNER JOIN film ON casting.id_film = film.id_film
        GROUP BY acteur.id_acteur
        ORDER BY nom
        ");

        require "view/acteurs/listActeurs.php";
    }

    //Lister des genres//
    public function listGenres()
    {
        $pdo = Connect::seConnecter();
        $listGenres = $pdo->query("SELECT * FROM genre");

        require "view/genres/listGenres.php";
    }

    //Lister des Réalisateurs//
    public function listRealisateurs()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT realisateur.id_realisateur, personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, GROUP_CONCAT(CONCAT(film.id_film) SEPARATOR 'idEnd') AS idFilms, GROUP_CONCAT(CONCAT(film.titre) SEPARATOR 'titreEnd') AS titreFilms
        FROM realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
        GROUP BY realisateur.id_realisateur
        ORDER BY nom

        ");

        require "view/realisateurs/listRealisateurs.php";
    }

    //Détails d'un film//
    public function filmDetails($id)
    {
        $pdo = Connect::seConnecter();

        if (!$this->filmId($id)) {
            require "view/nullId.php";
        }

        $filmDetails = $pdo->prepare("SELECT *, REPLACE(SUBSTRING(SEC_TO_TIME(duree*60), 2, 4), ':', 'h') AS dureeFormat, CONCAT(prenom, ' ', nom) AS personne 
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_film = :id_film");
        $filmDetails->execute(["id_film" => $id]);

        $acteurs = $pdo->prepare("SELECT personne.id_personne, image, CONCAT(prenom, ' ', nom) AS personne, role.id_role, nomRole, acteur.id_acteur
            FROM casting
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN film ON casting.id_film = film.id_film
            INNER JOIN role ON casting.id_role = role.id_role
            WHERE casting.id_film = :id_film");
        $acteurs->execute(["id_film" => $id]);

        $genres = $pdo->prepare("SELECT genre.id_genre, nomGenre 
            FROM genre
            INNER JOIN classer ON genre.id_genre = classer.id_genre
            WHERE classer.id_film = :id_film");
        $genres->execute(["id_film" => $id]);

        require "view/films/filmDetails.php";
    }

    //Détails d'un acteur//
    public function acteurDetails($id)
    {
        $pdo = Connect::seConnecter();

        if (!$this->acteurId($id)) {
            require "view/nullId.php";
        }

        $acteurDetails = $pdo->prepare("SELECT *, personne.id_personne, CONCAT(personne.prenom, ' ', personne.nom) AS personne, REPLACE(sexe, 'M', 'Homme'), REPLACE(sexe, 'F', 'Femme')
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE id_acteur = :id_acteur");
        $acteurDetails->execute(["id_acteur" => $id]);

        $films = $pdo->prepare("SELECT film.id_film, film.titre, film.affiche, role.id_role, role.nomRole
            FROM film
            INNER JOIN casting ON film.id_film = casting.id_film
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN role ON casting.id_role = role.id_role
            WHERE acteur.id_acteur = :id_acteur");
        $films->execute(["id_acteur" => $id]);


        require "view/acteurs/acteurDetails.php";
    }

    //Détails d'un réalisateur//
    public function realisateurDetails($id)
    {
        $pdo = Connect::seConnecter();

        if (!$this->realisateurId($id)) {
            require "view/nullId.php";
        }

        $realisateurDetails = $pdo->prepare("SELECT *, realisateur.id_realisateur, CONCAT(prenom, ' ', nom) AS personne, REPLACE(sexe, 'M', 'Homme'), REPLACE(sexe, 'F', 'Femme')
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_realisateur = :id_realisateur");
        $realisateurDetails->execute(["id_realisateur" => $id]);

        $films = $pdo->prepare("SELECT film.id_film, film.titre, film.affiche
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            WHERE realisateur.id_realisateur = :id_realisateur");
        $films->execute(["id_realisateur" => $id]);


        require "view/realisateurs/realisateurDetails.php";
    }

    //Détails d'un genre//
    public function genreDetails($id)
    {
        $pdo = Connect::seConnecter();

        if (!$this->genreId($id)) {
            require "view/nullId.php";
        }

        $genreDetails = $pdo->prepare("SELECT * FROM genre WHERE id_genre = :id_genre");
        $genreDetails->execute(["id_genre" => $id]);

        $genreFilmsDetails = $pdo->prepare("SELECT film.id_film, film.titre, film.sortieFr, film.note, film.affiche
            FROM film
            INNER JOIN classer ON film.id_film = classer.id_film
            INNER JOIN genre ON classer.id_genre = genre.id_genre
            WHERE genre.id_genre = :id_genre");
        $genreFilmsDetails->execute(["id_genre" => $id]);

        require "view/genres/genreDetails.php";
    }

    //Ajout d'un film//
    public function addGenre()
    {
        $pdo = Connect::seConnecter();
        if (isset ($_POST["submit"])) {
            $nomGenre = filter_var($_POST["nomGenre"], FILTER_SANITIZE_SPECIAL_CHARS);

            $addGenre = $pdo->prepare("INSERT INTO genre (nomGenre)
            VALUES (:nomGenre)");

            $addGenre->bindValue(":nomGenre", $nomGenre);
            $addGenre->execute();
            header("Location:index.php?action=listGenres");

            $_SESSION['message'] = "<p class='success_msg'>Genre ajouté</p>";
        } else {
            $_SESSION['message'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/genres/addGenre.php";
    }

    //Ajout d'un Réalisateur//
    public function addRealisateur()
    {
        $pdo = Connect::seConnecter();
        if (isset ($_POST["submit"])) {

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
            header("Location:index.php?action=listRealisateurs");

            $_SESSION['addReal'] = "<p class='success_msg'>Realisateur ajouté</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['addReal'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/realisateurs/addRealisateur.php";
    }

    //Ajout d'un Acteur//
    public function addActeur()
    {
        $pdo = Connect::seConnecter();
        if (isset ($_POST["submit"])) {

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
            header("Location:index.php?action=listActeurs");
            $_SESSION['addActeur'] = "<p class='success_msg'>Acteur ajouté</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['addActeur'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/acteurs/addActeur.php";
    }

    //Ajout d'un film//
    public function addFilm()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT id_realisateur, image, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ");

        $listGenres = $pdo->query("SELECT * FROM genre");


        if (isset ($_POST["submit"])) {
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
            $maxSize = 700000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = $uniqueName . "." . $extension;
                //$file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($tmpName, 'upload/film/affiche/' . $file);


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

                foreach ($id_genre as $genre) {

                    $addGenre = $pdo->prepare("INSERT INTO classer (id_film, id_genre) 
                    VALUES (:id_film, :id_genre)");
                    $addGenre->execute([
                        "id_film" => $lastInsertedId,
                        "id_genre" => $genre,
                    ]);
                }

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }
            header("Location:index.php?action=listFilms");
            $_SESSION['addFilm'] = "<p class='success_msg'>Film ajouté</p>";
        } else {
            $_SESSION['addFilm'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/films/addFilm.php";
    }

    //Ajout d'un role//
    public function addRole()
    {
        $pdo = Connect::seConnecter();
        if (isset ($_POST["submit"])) {
            $nomRole = filter_var($_POST["nomRole"], FILTER_SANITIZE_SPECIAL_CHARS);

            $addRole = $pdo->prepare("INSERT INTO role (nomRole) VALUES (:nomRole)");
            $addRole->execute(["nomRole" => $nomRole]);
            $_SESSION['message'] = "<p class='success_msg'>Role ajouté</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['message'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/casting/addRole.php";
    }

    //Ajout d'un casting//
    public function addCasting($id)
    {
        $pdo = Connect::seConnecter();
        $listActeurs = $pdo->query("SELECT id_acteur, personne.id_personne, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne");

        $listRoles = $pdo->query("SELECT id_role, nomRole FROM role");

        if (isset ($_POST["submit"])) {
            $id_role = filter_var($_POST["id_role"], FILTER_SANITIZE_NUMBER_INT);
            $id_acteur = filter_var($_POST["id_acteur"], FILTER_SANITIZE_NUMBER_INT);

            if ($id_role && $id_acteur) {
                $addCasting = $pdo->prepare("INSERT INTO casting (id_film, id_acteur, id_role)
                VALUES (:id_film, :id_acteur, :id_role)");
                $addCasting->execute([
                    "id_film" => $id,
                    "id_acteur" => $id_acteur,
                    "id_role" => $id_role,
                ]);
            }
            header("Location:index.php?action=filmDetails&id={$id}");
            $_SESSION['addCasting'] = "<p class='success_msg'>Casting ajouté</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['addCasting'] = "<p class='error_msg'>Erreur</p>";
        }

        require "view/casting/addCasting.php";
    }

    // Modifier un film

    public function updateFilm($id)
    {
        $pdo = Connect::seConnecter();

        $listRealisateurs = $pdo->query("SELECT id_realisateur, image, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ");

        $listGenres = $pdo->query("SELECT * FROM genre");

        $prevFilmInfo = $pdo->prepare("SELECT * FROM film WHERE id_film = :id_film");
        $prevFilmInfo->execute(["id_film" => $id]);

        $prevListRealisateurs = $pdo->prepare("SELECT realisateur.id_realisateur, image, CONCAT(prenom, ' ', nom) AS personne
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
        WHERE id_film = :id_film
        ");
        $prevListRealisateurs->execute(["id_film" => $id]);

        $prevListGenres = $pdo->prepare("SELECT id_genre 
        FROM classer 
        WHERE id_film = :id_film"
        );
        $prevListGenres->execute(["id_film" => $id]);

        $idGenre = [];
        foreach ($prevListGenres->fetchAll() as $genre) {
            $idGenre[] = $genre["id_genre"];
        }


        if (isset ($_POST['submit'])) {
            $titre = filter_var($_POST["titre"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sortieFr = filter_var($_POST["sortieFr"], FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_var($_POST["duree"], FILTER_SANITIZE_NUMBER_INT);
            $note = filter_var($_POST["note"], FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_var($_POST["synopsis"], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_realisateur = filter_var($_POST["id_realisateur"], FILTER_SANITIZE_NUMBER_INT);
            $id_genres = isset ($_POST["id_genre"]) ? $_POST["id_genre"] : array();

            $getFile = $pdo->prepare("SELECT affiche FROM film WHERE id_film = :id_film");
            $getFile->execute(["id_film" => $id]);

            $unsetFile = $getFile->fetch();

            unlink("upload/film/affiche/$unsetFile[0]");

            $deleteFile = $pdo->prepare("UPDATE film SET affiche = null WHERE id_film = :id_film");
            $deleteFile->execute(["id_film" => $id]);


            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 700000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = imagewebp(imagecreatefromstring(file_get_contents($tmpName)), "upload/film/affiche/$uniqueName.webp");
                //imagewebp donne au fichier un format webp


                $updateFilm = $pdo->prepare("UPDATE film 
                SET titre = :titre,
                sortieFr = :sortieFr,
                duree = :duree,
                note = :note,
                synopsis = :synopsis,
                affiche = :affiche,
                id_realisateur = :id_realisateur 
                WHERE id_film = :id_film");

                $updateFilm->execute([
                    "titre" => $titre,
                    "sortieFr" => $sortieFr,
                    "duree" => $duree,
                    "note" => $note,
                    "synopsis" => $synopsis,
                    "affiche" => $uniqueName . ".webp",
                    "id_realisateur" => $id_realisateur,
                    "id_film" => $id,
                ]);


                $delGenre = $pdo->prepare("DELETE FROM classer WHERE id_film = :id_film");
                $delGenre->execute(["id_film" => $id]);

                foreach ($id_genres as $genre) {

                    $addGenre = $pdo->prepare("INSERT INTO classer (id_film, id_genre) VALUES (:id_film, :id_genre)");
                    $addGenre->execute([
                        "id_film" => $id,
                        "id_genre" => $genre,
                    ]);
                }
                header("Location:index.php?action=filmDetails&id=$id");

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }

            $_SESSION['updateFilm'] = "<p class='success_msg'>Film modifié</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['updateFilm'] = "<p class='error_msg'>Erreur</p>";
        }

        require "view/films/updateFilm.php";
    }

    // Modifier un acteur

    public function updateActeur($id)
    {
        $pdo = Connect::seConnecter();

        $prevActeurInfos = $pdo->prepare("SELECT * FROM personne WHERE id_personne = :id_personne");
        $prevActeurInfos->execute(["id_personne" => $id]);

        if (isset ($_POST['submit'])) {
            $nom = filter_var($_POST["nom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($_POST["prenom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateNaissance = filter_var($_POST["dateNaissance"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_var($_POST["sexe"], FILTER_SANITIZE_SPECIAL_CHARS);
            $biographie = filter_var($_POST["biographie"], FILTER_SANITIZE_SPECIAL_CHARS);

            $getFile = $pdo->prepare("SELECT image FROM personne WHERE id_personne = :id_personne");
            $getFile->execute(["id_personne" => $id]);

            $unsetFile = $getFile->fetch();

            unlink("upload/personne/$unsetFile[0]");

            $deleteFile = $pdo->prepare("UPDATE personne SET image = null WHERE id_personne = :id_personne");
            $deleteFile->execute(["id_personne" => $id]);

            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 700000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = imagewebp(imagecreatefromstring(file_get_contents($tmpName)), "upload/personne/$uniqueName.webp");
                //imagewebp donne au fichier un format webp

                $updateActor = $pdo->prepare("UPDATE personne 
                SET nom = :nom,
                prenom = :prenom,
                dateNaissance = :dateNaissance,
                sexe = :sexe,
                biographie = :biographie,
                image = :image
                WHERE id_personne = :id_personne");

                $updateActor->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "dateNaissance" => $dateNaissance,
                    "sexe" => $sexe,
                    "biographie" => $biographie,
                    "image" => $uniqueName . ".webp",
                    "id_personne" => $id
                ]);

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }
            header("Location:index.php?action=acteurDetails&id=$id");
            $_SESSION['updateActeur'] = "<p class='success_msg'>Acteur modifié</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['updateActeur'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/acteurs/updateActeur.php";

    }

    // Modifier un realisateur

    public function updateRealisateur($id)
    {
        $pdo = Connect::seConnecter();

        $prevRealisateurInfos = $pdo->prepare("SELECT * FROM personne WHERE id_personne = :id_personne");
        $prevRealisateurInfos->execute(["id_personne" => $id]);

        if (isset ($_POST['submit'])) {
            $nom = filter_var($_POST["nom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($_POST["prenom"], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateNaissance = filter_var($_POST["dateNaissance"], FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_var($_POST["sexe"], FILTER_SANITIZE_SPECIAL_CHARS);
            $biographie = filter_var($_POST["biographie"], FILTER_SANITIZE_SPECIAL_CHARS);

            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            $getFile = $pdo->prepare("SELECT image FROM personne WHERE id_personne = :id_personne");
            $getFile->execute(["id_personne" => $id]);

            $unsetFile = $getFile->fetch();


            if (isset ($unsetFile[0]) && !empty ($unsetFile[0])) {

                unlink("upload/personne/$unsetFile[0]");
            }

            $deleteFile = $pdo->prepare("UPDATE personne SET image = null WHERE id_personne = :id_personne");
            $deleteFile->execute(["id_personne" => $id]);

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            //Taille max que l'on accepte
            $maxSize = 2000000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = imagewebp(imagecreatefromstring(file_get_contents($tmpName)), "upload/personne/$uniqueName.webp");
                //imagewebp donne au fichier un format webp

                $updateRealisateur = $pdo->prepare("UPDATE personne 
                SET nom = :nom,
                prenom = :prenom,
                dateNaissance = :dateNaissance,
                sexe = :sexe,
                biographie = :biographie,
                image = :image
                WHERE id_personne = :id_personne");

                $updateRealisateur->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "dateNaissance" => $dateNaissance,
                    "sexe" => $sexe,
                    "biographie" => $biographie,
                    "image" => $uniqueName . ".webp",
                    "id_personne" => $id
                ]);

            } else {
                echo "Erreur lors du téléchargement du fichier. Assurez-vous que le fichier est une image de type JPG, PNG, JPEG ou GIF et ne dépasse pas la taille maximale autorisée.";
            }
            header("Location:index.php?action=realisateurDetails&id=$id");
            $_SESSION['updateReal'] = "<p class='success_msg'>Réalisateur modifié</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['updateReal'] = "<p class='error_msg'>Erreur</p>";
        }
        require "view/realisateurs/updateRealisateur.php";

    }

    // Modifier un genre
    public function updateGenre($id)
    {
        $pdo = Connect::seConnecter();

        $prevGenreInfos = $pdo->prepare("SELECT * FROM genre WHERE id_genre = :id_genre");
        $prevGenreInfos->execute(["id_genre" => $id]);

        if (isset ($_POST['submit'])) {
            $nomGenre = filter_var($_POST["nomGenre"], FILTER_SANITIZE_SPECIAL_CHARS);

            $updateGenre = $pdo->prepare("UPDATE genre 
            SET nomGenre = :nomGenre
            WHERE id_genre = :id_genre");

            $updateGenre->execute([
                "nomGenre" => $nomGenre,
                "id_genre" => $id
            ]);

            header("Location:index.php?action=genreDetails&id=$id");
            $_SESSION['updateGenre'] = "<p class='success_msg'>Genre modifié</p>";
        } elseif (!isset ($_POST['submit'])) {
            $_SESSION['updateGenre'] = "<p class='error_msg'>Erreur</p>";
        }

        require "view/genres/updateGenre.php";
    }

    // Supprimer un film
    public function deleteFilm($id)
    {
        $pdo = Connect::seConnecter();

        $deleteClasser = $pdo->prepare("DELETE FROM classer WHERE id_film = :id_film");
        $deleteClasser->execute(["id_film" => $id]);

        $deleteCasting = $pdo->prepare("DELETE FROM casting WHERE id_film = :id_film");
        $deleteCasting->execute(["id_film" => $id]);

        $deleteFilm = $pdo->prepare("DELETE FROM film WHERE id_film = :id_film");
        $deleteFilm->execute(["id_film" => $id]);

        header("Location:index.php?action=listFilms");
    }

    // Supprimer un acteur

    public function deleteActeur()
    {
        $pdo = Connect::seConnecter();

        if ($_GET['personneId'] && $_GET['acteurId']) {
            $personneId = $_GET['personneId'];
            $acteurId = $_GET['acteurId'];

            $deleteCasting = $pdo->prepare("DELETE FROM casting WHERE id_acteur = :id_acteur");
            $deleteCasting->execute(["id_acteur" => $acteurId]);

            $deleteActeur = $pdo->prepare("DELETE FROM acteur WHERE id_personne = :id_personne");
            $deleteActeur->execute(["id_personne" => $personneId]);

            $deletePersonne = $pdo->prepare("DELETE FROM personne WHERE id_personne = :id_personne");
            $deletePersonne->execute(["id_personne" => $personneId]);

            header("Location:index.php?action=listActeurs");
        }
    }

    // Supprimer un realisateur

    public function deleteRealisateur()
    {
        $pdo = Connect::seConnecter();

        if ($_GET['personneId'] && $_GET['realisateurId']) {
            $personneId = $_GET['personneId'];
            $realisateurId = $_GET['realisateurId'];

            $filmSelect = $pdo->prepare("SELECT * FROM film WHERE id_realisateur = :id_realisateur");
            $filmSelect->execute(["id_realisateur" => $realisateurId]);

            foreach ($filmSelect->fetchAll() as $film) {
                $deleteCasting = $pdo->prepare("DELETE FROM casting WHERE id_film = :id_film");
                $deleteCasting->execute(["id_film" => $film['id_film']]);

                $deleteClasser = $pdo->prepare("DELETE FROM classer WHERE id_film = :id_film");
                $deleteClasser->execute(["id_film" => $film['id_film']]);
            }

            $deleteFilm = $pdo->prepare("DELETE FROM film WHERE id_realisateur = :id_realisateur");
            $deleteFilm->execute(["id_realisateur" => $realisateurId]);

            $deleteRealisateur = $pdo->prepare("DELETE FROM realisateur WHERE id_realisateur = :id_realisateur");
            $deleteRealisateur->execute(["id_realisateur" => $realisateurId]);

            $deletePersonne = $pdo->prepare("DELETE FROM personne WHERE id_personne = :id_personne");
            $deletePersonne->execute(["id_personne" => $personneId]);


            header("Location:index.php?action=listRealisateurs");
        }
    }

    // Supprimer un genre

    public function deleteGenre($id)
    {
        $pdo = Connect::seConnecter();

        $deleteClasser = $pdo->prepare("DELETE FROM classer WHERE id_genre = :id_genre");
        $deleteClasser->execute(["id_genre" => $id]);

        $deleteGenre = $pdo->prepare("DELETE FROM genre WHERE id_genre = :id_genre");
        $deleteGenre->execute(["id_genre" => $id]);

        header("Location:index.php?action=listGenres");
    }


    // Supprimer un casting

    public function deleteCasting()
    {
        $pdo = Connect::seConnecter();

        if ($_GET['filmId'] && $_GET['acteurId']) {
            $filmId = $_GET['filmId'];
            $acteurId = $_GET['acteurId'];

            $deleteCasting = $pdo->prepare("DELETE FROM casting WHERE id_acteur = :id_acteur");
            $deleteCasting->execute(["id_acteur" => $acteurId]);

            header("Location:index.php?action=filmDetails&id=$filmId");
        }
    }

    // Si l'id de l'url n'existe pas //
    private function filmId($id)
    {
        $pdo = Connect::seConnecter();

        // Préparez la requête SQL
        $filmId = $pdo->prepare("SELECT COUNT(*) FROM film WHERE id_film = :id_film");
        $filmId->execute(["id_film" => $id]);

        // Récupérez le nombre de lignes correspondant à l'ID
        $rowCount = $filmId->fetchColumn();

        // Si le nombre de lignes est supérieur à zéro, l'ID existe
        return $rowCount > 0;
    }

    private function acteurId($id)
    {
        $pdo = Connect::seConnecter();

        // Préparez la requête SQL
        $acteurId = $pdo->prepare("SELECT COUNT(*) FROM acteur WHERE id_acteur = :id_acteur");
        $acteurId->execute(["id_acteur" => $id]);

        // Récupérez le nombre de lignes correspondant à l'ID
        $rowCount = $acteurId->fetchColumn();

        // Si le nombre de lignes est supérieur à zéro, l'ID existe
        return $rowCount > 0;
    }

    private function realisateurId($id)
    {
        $pdo = Connect::seConnecter();

        // Préparez la requête SQL
        $realisateurId = $pdo->prepare("SELECT COUNT(*) FROM realisateur WHERE id_realisateur = :id_realisateur");
        $realisateurId->execute(["id_realisateur" => $id]);

        // Récupérez le nombre de lignes correspondant à l'ID
        $rowCount = $realisateurId->fetchColumn();

        // Si le nombre de lignes est supérieur à zéro, l'ID existe
        return $rowCount > 0;
    }

    private function genreId($id)
    {
        $pdo = Connect::seConnecter();

        // Préparez la requête SQL
        $genreId = $pdo->prepare("SELECT COUNT(*) FROM genre WHERE id_genre = :id_genre");
        $genreId->execute(["id_genre" => $id]);

        // Récupérez le nombre de lignes correspondant à l'ID
        $rowCount = $genreId->fetchColumn();

        // Si le nombre de lignes est supérieur à zéro, l'ID existe
        return $rowCount > 0;
    }



}