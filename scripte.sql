
CREATE DATABASE youdemy;
USE youdemy;

-- Creating the tables based on the UML diagram

CREATE TABLE Utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Administrateur', 'Enseignant', 'Etudiant') NOT NULL
);

CREATE TABLE Administrateur (
    id_administrateur INT PRIMARY KEY,
    FOREIGN KEY (id_administrateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Enseignant (
    id_enseignant INT PRIMARY KEY,
    FOREIGN KEY (id_enseignant) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Etudiant (
    id_etudiant INT PRIMARY KEY,
    FOREIGN KEY (id_etudiant) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Categorie (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Tags (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Cours (
    id_cours INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    contenu TEXT NOT NULL,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id_categorie)
);

CREATE TABLE CoursTags (
    cours_id INT,
    tag_id INT,
    PRIMARY KEY (cours_id, tag_id),
    FOREIGN KEY (cours_id) REFERENCES Cours(id_cours),
    FOREIGN KEY (tag_id) REFERENCES Tags(id_tag)
);

CREATE TABLE Inscription (
    etudiant_id INT,
    cours_id INT,
    DateInscription DATE,
    PRIMARY KEY (etudiant_id, cours_id),
    FOREIGN KEY (etudiant_id) REFERENCES Etudiant(id_etudiant),
    FOREIGN KEY (cours_id) REFERENCES Cours(id_cours)
);


INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES ('Admin', 'admin@youdemy.com', SHA2('admin123', 256), 'admin', 'actif');

INSERT INTO categories (nom) VALUES
('Développement Web'),
('Business'),
('Design'),
('Marketing Digital'),
('Programmation'),
('Langues'),
('Sciences');

INSERT INTO tags (nom) VALUES
('PHP'),
('JavaScript'),
('HTML/CSS'),
('MySQL'),
('Python'),
('Java'),
('React'),
('Angular'),
('Vue.js'),
('NodeJS');