-- Active: 1734980278632@@127.0.0.1@3306@youdemy
DROP DATABASE IF EXISTS youdemy;
CREATE DATABASE youdemy;
USE youdemy;

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'enseignant', 'etudiant') NOT NULL,
    status ENUM('actif', 'inactif', 'en_attente') NOT NULL DEFAULT 'en_attente'
);




SELECT U.nom , COUNT(C.id) AS nbr_cours
FROM utilisateurs U JOIN cours C ON U.id = C.id_enseignant
GROUP BY U.id
ORDER BY nbr_cours DESC
LIMIT 1;
 


 



SELECT * FROM utilisateurs
JOIN inscriptions ON utilisateurs.id = inscriptions.id_etudiant
GROUP BY utilisateurs.id







CREATE TABLE categories (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE tags (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE cours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    contenu TEXT NOT NULL,
    type_contenu ENUM('video', 'document') NOT NULL,
    id_categorie INT,
    id_enseignant INT NOT NULL,
    statut ENUM('actif', 'en_attente', 'brouillon') NOT NULL DEFAULT 'brouillon',
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_enseignant) REFERENCES utilisateurs(id) ON DELETE CASCADE
);


SELECT * FROM cours
WHERE id_enseignant = 29 AND statut = 'inactif';
SELECT * FROM cours;

CREATE TABLE cours_tags (
    id_cours INT,
    id_tag INT,
    PRIMARY KEY (id_cours, id_tag),
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE
);

CREATE TABLE inscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_etudiant INT NOT NULL,
    id_cours INT NOT NULL,
    date_inscription DATE NOT NULL DEFAULT (CURRENT_DATE),
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    UNIQUE KEY unique_inscription (id_etudiant, id_cours)
);


SELECT * from cours ; 

INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES (
    'admin', 
    'admin@youdemy.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  
    'admin', 
    'actif'
);



SELECT utilisateurs.nom , cours.titre ,utilisateurs.id
FROM utilisateurs
JOIN cours ON utilisateurs.id = cours.id_enseignant  
WHERE cours.statut = 'actif' AND utilisateurs.id = 38;
SELECT utilisateurs.nom , COUNT(cours.id) as courset  FROM utilisateurs
LEFT JOIN cours ON utilisateurs.id = cours.id_enseignant
GROUP BY utilisateurs.id 
ORDER BY courset  DESC;

SELECT utilisateurs.nom FROM utilisateurs
JOIN inscriptions ON utilisateurs.id =  inscriptions.id_etudiant
JOIN cours ON inscriptions.id_cours = cours.id
WHERE cours.titre LIKE '%Mollit%';

SELECT utilisateurs.nom , cours.titre 
FROM utilisateurs
join cours on utilisateurs.id =cours.id_enseignant 


SELECT utilisateurs.nom, cours.titre 
FROM utilisateurs JOIN inscriptions ON utilisateurs.id = inscriptions.id_etudiant
     JOIN cours ON cours.id = inscriptions.id_cours;


     SELECT COUNT(DISTINCT utilisateurs.id) as total 
from utilisateurs
JOIN inscriptions on utilisateurs.id = inscriptions.id_etudiant;


-- aficher le nomber des etudiant inscripte par chaque cours 
-- select count(*) from inscriptions WHERE inscriptions=cours_etudiant;