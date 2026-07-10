CREATE TABLE agence (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(100) NOT NULL
);

CREATE TABLE employe (
    id_employe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    mot_de_passe VARCHAR(255) NOT NULL,
    est_admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE trajet (
    id_trajet INT AUTO_INCREMENT PRIMARY KEY,
    id_agence_depart INT NOT NULL,
    id_agence_arrivee INT NOT NULL,
    gdh_depart DATETIME NOT NULL,
    gdh_arrivee DATETIME NOT NULL,
    nb_places_total INT NOT NULL,
    nb_places_disponibles INT NOT NULL,
    id_employe INT NOT NULL,
    FOREIGN KEY (id_agence_depart) REFERENCES agence(id_agence),
    FOREIGN KEY (id_agence_arrivee) REFERENCES agence(id_agence),
    FOREIGN KEY (id_employe) REFERENCES employe(id_employe)
);