<?php
session_start();

if (isset($_GET['index_edit_id'])) {
    $delete_id = raw_input($_GET['index_edit_id']);
    unset($_SESSION['movieList'][$_GET['index_edit_id']]);
    // $sql = "DELETE FROM MOVIE WHERE  id='$delete_id';
    //$run=mysqli_query($con,$sql);
}

header("location:../index.php");        // always go back there


function raw_input($value)
{
    return stripslashes(trim($value));
}           // avoid escaping characters to prevent sql injection
