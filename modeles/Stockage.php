<?php

class Stockage extends Modele{

    public function insertStockage($idLivre){
        $requete=$this->getBdd()->prepare("INSERT INTO stockage (idPanier, idLivre) VALUES ((SELECT max(idPanier) FROM panier),?)");
        $requete->execute($idLivre);
    }
}

