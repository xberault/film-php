<html>
<?php
require_once "../bd/connexion.php";

$connexion = connect_bd();

$prepaAffich = "SELECT idFilm FROM FILM WHERE idFilm NOT IN (SELECT DISTINCT idFilm FROM JOUE) and idFilm NOT IN (SELECT DISTINCT idFilm FROM REALISE)";

$requette = $connexion->query($prepaAffich);

if(!$requette){
    echo "soucis dans la requette de fix des films";
}
else{
    foreach ($requette as $row){
        $id=intval($row[0]);
        $prepaSuppr = "DELETE FROM FILM WHERE idFilm='".$id."'";
        $connexion->exec($prepaSuppr);
    }
}

$prepaAffich = "SELECT idFilm FROM FILM WHERE idFilm NOT IN (SELECT DISTINCT idFilm FROM REALISE)";

$requette = $connexion->query($prepaAffich);

if(!$requette){
    echo "soucis dans la requette de fix des films";
}
else{
    foreach ($requette as $row){
        $id=intval($row[0]);
        $prepaSupprJoue = "DELETE FROM JOUE WHERE idFilm='".$id."'";
        $prepaSupprFilm = "DELETE FROM Film WHERE idFilm='".$id."'";
        $connexion->exec($prepaSupprJoue);
        $connexion->exec($prepaSupprFilm);
    }
}

$prepaAffich = "SELECT idPersonne FROM PERSONNE WHERE idPersonne NOT IN (SELECT DISTINCT idPersonne FROM JOUE) and idPersonne NOT IN (SELECT DISTINCT idPersonne FROM REALISE)";

$requette = $connexion->query($prepaAffich);

if(!$requette){
    echo "soucis dans la requette de fix des acteurs";
}
else{
    foreach ($requette as $row){
        $id=intval($row[0]);
        $prepaSuppr = "DELETE FROM PERSONNE WHERE idPersonne='".$id."'";
        $connexion->exec($prepaSuppr);
    }
}

$connexion = null;
?>
</html>