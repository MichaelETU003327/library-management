-- Utilisation de la base
CREATE DATABASE IF NOT EXISTS bibliotheque;
USE bibliotheque;

-- Table : admin
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (email)
);

INSERT INTO admin (email, password) VALUES ('admin@gmail.com', 'admin');

-- Table : etudiant
DROP TABLE IF EXISTS etudiant;
CREATE TABLE etudiant (
  email VARCHAR(255) NOT NULL,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  date_naissance DATE NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (email)
);

INSERT INTO etudiant (email, nom, prenom, date_naissance, password)
VALUES ('admin@gmail.com', 'admin', 'admin', '2024-04-09', 'admin');

-- Table : livres
DROP TABLE IF EXISTS livres;
CREATE TABLE livres (
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  editeur VARCHAR(255) NOT NULL,
  annee INT NOT NULL,
  categorie VARCHAR(255) NOT NULL,
  quantite INT NOT NULL,
  stock INT NOT NULL,
  nbemprunte INT NOT NULL,
  photo VARCHAR(255) NOT NULL,
  PRIMARY KEY (titre, auteur)
);

-- Table : emprunt
DROP TABLE IF EXISTS emprunt;
CREATE TABLE emprunt (
  email VARCHAR(255) NOT NULL,
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  date_emprunt DATE NOT NULL,
  date_retour DATE NOT NULL,
  PRIMARY KEY (email, titre, auteur),
  FOREIGN KEY (email) REFERENCES etudiant(email),
  FOREIGN KEY (titre, auteur) REFERENCES livres(titre, auteur)
);

-- Table : panier
DROP TABLE IF EXISTS panier;
CREATE TABLE panier (
  email VARCHAR(255) NOT NULL,
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  photo VARCHAR(255) NOT NULL,
  PRIMARY KEY (email, titre, auteur),
  FOREIGN KEY (email) REFERENCES etudiant(email),
  FOREIGN KEY (titre, auteur) REFERENCES livres(titre, auteur)
);
