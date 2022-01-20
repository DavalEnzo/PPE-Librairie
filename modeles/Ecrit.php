<?php
class Ecrit extends Modele{
    public function insertEcrit(){
            $requete=$this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES ((SELECT max(idAuteur) FROM auteurs),(SELECT max(idLivre) FROM livres))"); 
            // Trigger à faire sur celle-là afin de réduire la taille de requête
            $requete->execute();
            }
        }