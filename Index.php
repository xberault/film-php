<!doctype html>
<html>

<body>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/56083ee0c6.js" crossorigin="anonymous"></script>
</head>
<header>
</header>
<body class="text-left">
<main class='   container'>
    <header">
        <h1> FlixTube </h1>
    </header>

    <form method="post" action="src/search.php">
        <select name="filter" >
            <option value="titre">titre</option>
            <option value="date">date</option>
            <option value="auteur">auteur</option>
        </select>
        <input type="submit">
    </form>


    <?php

    require_once 'src/movie.php';    // name date author gender

    $movieList = array(new Movie(0,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie(1,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie(2,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie(3,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie(4,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));
array_push($movieList,new Movie(5,"Le chimpanzé",1997,"Melin","Aventure","Le drôle de singe est de retour"));

    echo "<ul class='list-inline'>";
    foreach($movieList as &$movie){
        $movie->render();
    }
    echo "</ul>";


?>


</main>
