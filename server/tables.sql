
DROP TABLE REALISE;
DROP TABLE JOUE;
DROP TABLE PERSONNE;
DROP TABLE FILM;

CREATE TABLE FILM (
    idFilm NUMBER(10) PRIMARY KEY,
    titre VARCHAR2(50),
    synopsis VARCHAR2(255),
    anneRealisation DATE,
    genre VARCHAR2(50),
    posterPath VARCHAR2(200)
);

CREATE TABLE PERSONNE (
    idPersonnne NUMBER(10) PRIMARY KEY,
    nom VARCHAR2(50),
    prenom VARCHAR2(50),
    sexe VARCHAR2(12),
    dateNaissance DATE,
    biographie VARCHAR2(4000)
);

CREATE TABLE JOUE (
    idPersonnne NUMBER(10),
    idFilm NUMBER(10),
    CONSTRAINT pkJoue PRIMARY KEY (idPersonnne,idFilm),
    CONSTRAINT fkIdPersonneJ FOREIGN KEY (idPersonnne) REFERENCES PERSONNE (idPersonnne),
    CONSTRAINT fkIdFilmJ FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);

CREATE TABLE REALISE (
    idPersonnne NUMBER(10),
    idFilm NUMBER(10),
    CONSTRAINT pkJoue PRIMARY KEY (idPersonnne,idFilm),
    CONSTRAINT fkIdPersonneR FOREIGN KEY (idPersonnne) REFERENCES PERSONNE (idPersonnne),
    CONSTRAINT fkIdFilmR FOREIGN KEY (idFilm) REFERENCES FILM (idFilm)
);