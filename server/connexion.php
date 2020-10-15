<?php

function connect_bd(){
        try{
            $connexion = new PDO('mysql:host=servinfo-mariadb;dbname=DBjacquet','jacquet','jacquet');
        }
        catch(PDOException $e){
            echo "erreur ";
            printf("Échec connexion : %s\n", $e->getMessage());
            exit();
        }
    return $connexion;
}
?>