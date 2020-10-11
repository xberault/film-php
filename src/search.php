<?php
include_once "movie.php";   // be sure to have it to use movie's methods
session_start();
if (isset($_GET['filter'])) {
    $movieList = &$_SESSION['movieList'];   // by reference because we will sort it
    switch ($_GET['filter']) {      // we could have done a sql query with an "order by" but I found this way more suitable for further implementations
        case "date":
            $cmp = function ($movieIdA, $movieIdB) use ($movieList) {

                return $movieList[$movieIdA]->getDate() - $movieList[$movieIdB]->getDate();
            };
            break;
        case "auteur":
            $cmp = function ($movieIdA, $movieIdB) use ($movieList) {
                return strcasecmp($movieList[$movieIdA]->getAuthor(), $movieList[$movieIdB]->getAuthor());
            };
            break;

        case "titre":
            $cmp = function ($movieIdA, $movieIdB) use ($movieList) {
                return strcasecmp($movieList[$movieIdA]->getTitle(), $movieList[$movieIdB]->getTitle());
            };
            break;

        default:        // sort by id :)
            $cmp = function ($movieIdA, $movieIdB) use ($movieList) {
                return $movieList[$movieIdA]->getId() - $movieList[$movieIdB]->getId();
            };
            break;
    }
    uksort($movieList, $cmp); // cmp is the key for this sort

    //$keywords = $db->escape_string($_GET['filter']);
    //$query = $db->query("SELECT * FROM movie WHERE '%{filter}%' LIKE '%{filter}%' ");
}
header("location:../index.php?filter=" . $_GET['filter']);  // always go back there and keep record on the selected filter value
