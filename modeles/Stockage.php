<?php

class Stockage extends Modele{

    public function insertStockage($idPanier, $idLivre){
        $requete=$this->getBdd()->prepare("INSERT INTO stockage (idPanier, idLivre) VALUES (?, ?)");
        $requete->execute([$idPanier,$idLivre]);
    }

    public function recupPanier($idPanier)
    {
        $requete=$this->getBdd()->prepare("SELECT * FROM stockage LEFT JOIN paniers USING(idPanier) WHERE idPanier = ?");
        $requete->execute([$idPanier]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function suppressionProduit($idStockage)
    {
        $requete=$this->getBdd()->prepare("DELETE FROM stockage WHERE idStockage = ?");
        $requete->execute([$idStockage]);
    }

    public function comptageLivrePanier($idPanier)
    {
        $requete=$this->getBdd()->prepare('SELECT count(*) as nbLivres FROM stockage WHERE idPanier = ?');
        $requete->execute([$idPanier]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}

