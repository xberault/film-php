<!doctype html>
<html>

<body class="text-left ml-4 mt-4">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
</header>
<body class="text-left ml-4 mt-4">
<main class='container'>
    <header">
        <h1> FlixTube </h1>
    </header>



<?php

    require_once 'src/movie.php';    // name date author gender

    $movieList = array(new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie("Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));

    echo "<div class='container'";
    echo "<ul class='list-inline'>";
    foreach($movieList as &$movie){
        $movie->render();
    }
    echo "</ul>";
    echo "</div>";


?>


</main>
