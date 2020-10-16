
DROP TABLE IF EXISTS REALISE;
DROP TABLE IF EXISTS JOUE;
DROP TABLE IF EXISTS PERSONNE;
DROP TABLE IF EXISTS FILM;

CREATE TABLE FILM (
    idFilm INT PRIMARY KEY,
    titreFilm VARCHAR(100),
    synopsis VARCHAR(1000),
    dateRealisation DATE,
    genre VARCHAR(100),
    posterPath VARCHAR(4000)
);

CREATE TABLE PERSONNE (
    idPersonne INT PRIMARY KEY,
    nom Varchar(100),
    prenom VARCHAR(100),
    sexe VARCHAR(12),
    dateNaissance DATE,
    biographie VARCHAR(8000)
);

CREATE TABLE JOUE (
    idPersonne INT,
    idFilm INT,
    CONSTRAINT pkJoue PRIMARY KEY (idPersonne,idFilm),
    CONSTRAINT fkIdPersonneJ FOREIGN KEY (idPersonne) REFERENCES PERSONNE (idPersonne),
    CONSTRAINT fkIdFilmJ FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);

CREATE TABLE REALISE (
    idPersonne INT,
    idFilm INT,
    CONSTRAINT pkRealise PRIMARY KEY (idPersonne,idFilm),
    CONSTRAINT fkIdPersonneR FOREIGN KEY (idPersonne) REFERENCES PERSONNE (idPersonne),
    CONSTRAINT fkIdFilmR FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);