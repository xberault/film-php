<?php
$getvalue = $_SESSION['movieList']; // session get
$id = $_GET['id'];
var_dump($id);

/*
$query="SELECT * FROM MOVIE WHERE id='$id'";


$result = mysqli_query($db,$query) or die( "My query ($query) generated an error: ".mysql_error());

$data=mysqli_fetch_array($result);

*/


//    mysqli_close($db);