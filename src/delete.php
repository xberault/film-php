<?php

require_once"../bd/fixBDD.php";
session_start();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    
    $_SESSION['type'] = null;

    $connexion = connect_bd();

    $prepSuprJoue="DELETE FROM JOUE WHERE idFilm='".$id."'";
    $prepSuprReal="DELETE FROM REALISE WHERE idFilm='".$id."'";
    $prepSuprFilm="DELETE FROM FILM WHERE idFilm='".$id."'";

    $connexion->exec($prepSuprJoue);
    $connexion->exec($prepSuprReal);
    $connexion->exec($prepSuprFilm);

    $connexion = null;

    correction_db();
}

header("location:../".$_SESSION['actual']);        // always go back there

?>