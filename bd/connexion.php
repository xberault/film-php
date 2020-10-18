<?php

function connect_bd(){
        try{
            // travail iut
            $connexion = new PDO('mysql:host=servinfo-mariadb;dbname=DBjacquet','jacquet','jacquet');
        }
        catch(PDOException $e){
            try{
                // local host maison thomas
                $connexion = new PDO('mysql:host=localhost;dbname=DBjacquet','root','root');
            }
            catch(PDOException $e){
                printf("Échec connexion : %s\n", $e->getMessage());
                exit();
            }
        }
    return $connexion;
}
?>