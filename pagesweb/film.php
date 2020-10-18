<?php
    // be sure to require before session start ;)
    include_once '../src/movie.php';    // name date author gender

    require_once "../bd/connexion.php";

    session_set_cookie_params('15');  // keep session opened for 15 seconds
    session_start(); // session start allow to save data so always in first

    header('Cache-Control: no-cache');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Expose-Headers: X-Events');
    
    $_SESSION["actual"]  = "pagesweb/film.php";

?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/56083ee0c6.js" crossorigin="anonymous"></script>
    </head>
    <header class="bg-info shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../"><b>Tube</b>Flix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="film.php">Films <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="realisateur.php">Producer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acteur.php">Actor </a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="genre.php">Genre</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="../src/filter.php" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <select  name="filter" class="browser-default custom-select m-1">
                        <option value="" disabled>Trier par</option>
                        <option value="titre" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'titre') ? 'selected' : ''; ?>>
                            title
                        </option>  <!-- allow to save the previous user selected choice selected -->
                        <option value="date" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'date') ? 'selected' : ''; ?>>
                            date
                        </option>
                        <option value="auteur" <?php echo (isset($_GET['filter']) && $_GET['filter'] === 'auteur') ? 'selected' : ''; ?>>
                            Producer
                        </option>
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
    <body class="text-left">
        <main class='container'>

            <form class="form-group w-25" method="get" action="src/filter.php">

            </form>


            <?php

            $connexion = connect_bd();

            $showFilm = "SELECT idFilm, titreFilm, dateRealisation, nom, prenom, genre, synopsis, posterPath FROM FILM NATURAL JOIN REALISE NATURAL JOIN PERSONNE limit 100000";
    
            $requette = $connexion->query($showFilm);
            if(!$requette){
                echo "soucis dans la requette des films";
            }
            else{
                $_SESSION['movieList']= [];
                foreach ($requette as $row){
                    $_SESSION['movieList'][$row['idFilm']] = new Movie($row['idFilm'],$row['titreFilm'],date_format(date_create($row['dateRealisation']),'F Y'),$row['prenom']." ".$row['nom'],$row['genre'],$row['synopsis'],$row['posterPath']);
                }
            }

            $connexion = null;

            echo "<ul class='row'>";

            foreach ($_SESSION['movieList'] as $id => $movie) {
                $movie -> render();
            }
            echo "</ul>";

            ?>

        </main>
    </body>
</html>