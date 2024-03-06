-- a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur

SELECT titre, sortieFr, SEC_TO_TIME(duree*60), personne.nom, personne.prenom
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE id_film = 1

-- b. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)

SELECT titre FROM film
WHERE duree > 135
ORDER BY duree DESC

-- c. Liste des films d’un réalisateur (en précisant l’année de sortie) 

SELECT CONCAT(prenom, " ", nom) AS realisateur, titre, sortieFr 
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE realisateur.id_realisateur = 2

-- d. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT nomGenre, COUNT(film.id_film) FROM classer
INNER JOIN genre ON classer.id_genre = genre.id_genre
INNER JOIN film ON classer.id_film = film.id_film
GROUP BY nomGenre
ORDER BY COUNT(film.id_film) DESC

-- e. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT CONCAT(prenom, " ", nom) AS realisateur, COUNT(film.id_film) AS nbFilms
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
GROUP BY personne.id_personne
ORDER BY COUNT(film.id_film) DESC

-- g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de
-- sortie (du film le plus récent au plus ancien)

SELECT CONCAT(prenom, " ", nom) AS acteur, film.titre, role.nomRole, film.sortieFr
FROM casting
INNER JOIN film ON casting.id_film = film.id_film
INNER JOIN role ON casting.id_role = role.id_role
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
ORDER BY acteur.id_acteur, sortieFr DESC

-- h. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT CONCAT(prenom, " ", nom) AS personne
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne


-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

SELECT titre, sortieFr
FROM film
WHERE sortieFr > YEAR(CURDATE()) - 5
ORDER BY sortieFr DESC

-- j. Nombre d’hommes et de femmes parmi les acteurs

SELECT sexe, COUNT(acteur.id_personne) AS acteurs
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
WHERE sexe = 'M' OR  sexe = 'F'
GROUP BY sexe

-- k. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)

SELECT CONCAT(prenom, " ", nom) AS acteurs, TIMESTAMPDIFF(YEAR, dateNaissance, CURDATE()) AS age
FROM acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
WHERE TIMESTAMPDIFF(YEAR, dateNaissance, CURDATE()) > 50

-- l. Acteurs ayant joué dans 3 films ou plus

SELECT CONCAT(prenom, " ", nom) AS acteurs, COUNT(casting.id_film) AS nbFilms
FROM film
INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
GROUP BY casting.id_acteur
HAVING COUNT(casting.id_film) >= 3