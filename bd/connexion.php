<?php

function connect_bd(){
        try{
            $connexion = new PDO('mysql:host=servinfo-mariadb;dbname=DBjacquet','jacquet','jacquet');
        }
        catch(PDOException $e){
            try{
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