<?php
// be sure to require before session start ;)
include_once 'src/movie.php';    // name date author gender

session_set_cookie_params('15');  // keep session opened for 15 seconds
session_start(); // session start allow to save data so always in first

header('Cache-Control: no-cache');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Expose-Headers: X-Events');

?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/56083ee0c6.js" crossorigin="anonymous"></script>
</head>
<header class="bg-info shadow-sm">
        <h1> FlixTube </h1>
</header>
<body class="text-left">
<main class='container'>

    <form class="form-group w-25" method="get" action="src/filter.php">
        <input class="form-control" type="text" name="query" />
        <select  name="filter">
            <option value="" disabled>Trier par</option>
            <option value="titre" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'titre') ? 'selected' : ''; ?>>
                titre
            </option>  <!-- allow to save the previous user selected choice selected -->
            <option value="date" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'date') ? 'selected' : ''; ?>>
                date
            </option>
            <option value="auteur" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'auteur') ? 'selected' : ''; ?>>
                auteur
            </option>
            <input class="btn-secondary" type="submit" value="search">
        </select>
    </form>


    <?php

    if (!isset($_SESSION['movieList'])) {
        $_SESSION['movieList'] = [
            5 => new Movie(5, "Le chimpanzé", 2003, "Jack Sparrow", "Aventure", "Le drôle de singe débarque à vos écrans")
            ,
            1 => new Movie(1, "L'attaque des singes", 1998, "Bobine de fer", "Apocalyptique", "Faites gaffe à vous")
            ,
            2 => new Movie(2, "Le dernier des chimpanzés", 2021, "Eventail de ciseaux", "Science fiction", "Il est finalement de retour")
        ];
    }
    echo "<ul class='row'>";

    foreach ($_SESSION['movieList'] as $movie) {
        $movie -> render();
    }
    echo "</ul>";

    ?>

</main>
</body>
</html>