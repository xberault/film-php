<html>
<?php
require_once "../bd/connexion.php";

function correction_db(){
        $connexion = connect_bd();


    // on retire les personnes sans nom ou prenom
    $prepaAffich = "SELECT idPersonne FROM PERSONNE WHERE nom='' or prenom=''";

    $requette = $connexion->query($prepaAffich);

    if(!$requette){
        echo "soucis dans la requette de fix des acteurs sans nom ou prenom";
    }
    else{
        foreach ($requette as $row){
            $id=intval($row[0]);
            $prepaSupprJoue = "DELETE FROM JOUE WHERE idPersonne='".$id."'";
            $prepaSupprRea = "DELETE FROM REALISE WHERE idPersonne='".$id."'";
            $prepaSupprPers = "DELETE FROM PERSONNE WHERE idPersonne='".$id."'";
            $connexion->exec($prepaSupprJoue);
            $connexion->exec($prepaSupprRea);
            $connexion->exec($prepaSupprPers);
        }
    }


    // on retire les films qui ont ni réalisateur ni acteurs
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


    // on retire les films qui ont pas de réalisateur 
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


    // on retire les personnes qui sont ni réalisateur ni acteur
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
}
?>
</html>