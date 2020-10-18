<?php

require_once"../bd/fixBDD.php";
session_start();

if (isset($_GET['index_edit_id'])) {
    $prepSuprJoue="DELETE FROM JOUE WHERE idFilm='".$_GET["index_edit_id"]."'";
    $prepSuprReal="DELETE FROM REALISE WHERE idFilm='".$_GET["index_edit_id"]."'";
    $prepSuprFilm="DELETE FROM FILM WHERE idFilm='".$_GET["index_edit_id"]."'";
    correction_db();
}

header("location:../index.php");        // always go back there


function raw_input($value)
{
    return stripslashes(trim($value));
}           // avoid escaping characters to prevent sql injection
