
DROP TABLE IF EXISTS REALISE;
DROP TABLE IF EXISTS JOUE;
DROP TABLE IF EXISTS PERSONNE;
DROP TABLE IF EXISTS FILM;

CREATE TABLE FILM (
    idFilm INT PRIMARY KEY,
    titreFilm VARCHAR(50),
    synopsis VARCHAR(255),
    dateRealisation DATE,
    genre VARCHAR(50),
    posterPath VARCHAR(200)
);

CREATE TABLE PERSONNE (
    idPersonne INT PRIMARY KEY,
    nom INT,
    prenom VARCHAR(50),
    sexe VARCHAR(12),
    dateNaissance DATE,
    biographie VARCHAR(4000)
);

CREATE TABLE JOUE (
    idPersonne INT,
    idFilm INT,
    CONSTRAINT pkJoue PRIMARY KEY (idPersonne,idFilm)
    -- CONSTRAINT fkIdPersonneJ FOREIGN KEY (idPersonne) REFERENCES PERSONNE (idPersonne),
    -- CONSTRAINT fkIdFilmJ FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);

CREATE TABLE REALISE (
    idPersonne INT,
    idFilm INT,
    CONSTRAINT pkJoue PRIMARY KEY (idPersonne,idFilm)
    -- CONSTRAINT fkIdPersonneR FOREIGN KEY (idPersonne) REFERENCES PERSONNE (idPersonne),
    -- CONSTRAINT fkIdFilmR FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);