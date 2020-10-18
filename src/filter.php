<?php
include_once "movie.php";   // be sure to have it to use movie's methods
include_once "../bd/connexion.php";
session_start();
if (isset($_GET['filter'])) {
    $movieList = &$_SESSION['movieList'];   // by reference because we will sort it
    $filter = $_GET['filter']    ;  // we could have done a sql query with an "order by" but I found this way more suitable for further implementations
    $search = in_array("search",$_GET) ?  $_GET['search'] : "";
    switch($_GET['filter']){
        case 'tile':
            $filter = 'titreFilm';
            break;
        case 'date':
            $filter = 'dateRealisation';
            break;
        case 'producer':
            $filter = "nom";
            break;
    }

    $connexion = connect_bd();

    $sql = "SELECT idFilm, titreFilm, dateRealisation, nom, prenom, genre, synopsis, posterPath
                FROM FILM NATURAL JOIN REALISE NATURAL JOIN PERSONNE where titreFilm like :search order by :filter  limit 1000 ";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(":search", $search);
    $stmt->bindParam(":filter", $filter);
    $results = $stmt -> execute();
    while ($row = $stmt->fetch()) {
        var_dump($row);
        $_SESSION['movieList'][$row['idFilm']] = new Movie($row['idFilm'], $row['titreFilm'], date_format(date_create($row['dateRealisation']), 'F Y'), $row['prenom'] . " " . $row['nom'], $row['genre'], $row['synopsis'], $row['posterPath']);
    }
}

header("location:../".$_SESSION['actual']."?filter=". $_GET['filter']);  // always go back there and keep record on the selected filter value
