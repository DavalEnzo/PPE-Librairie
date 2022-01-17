<?php

class Panier extends Modele{

    private $panier;

    public function __construct($idpanier = null, $idutilisateur = null)
    {
    
        if($idpanier != null && $idutilisateur != null){
            $requete = $this->getBdd()->prepare('CALL select_panier(?,?)');
            $requete->execute([$idpanier,$idutilisateur]);

            $panier = $requete->fetch(PDO::FETCH_ASSOC);

            $this->panier = $panier;          
        }
    }

    public function ajouterPanierVide($idutilisateur){
                
        $requete = $this->getBdd()->prepare('INSERT INTO paniers (idUtilisateur) VALUES (?)');
        $requete->execute([$idutilisateur]);
    }

    public function SelectMaxidPanier()
    {
        $requete = $this->getBdd()->prepare('SELECT max(idPanier) FROM paniers');
        $requete->execute();

        $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getPanier(){
        return $this->panier;
    }

    public function supprimerPanier($idPanier)
    {
        $requete = $this->getBdd()->prepare('DELETE FROM paniers WHERE idPanier = ?');
        $requete->execute([$idPanier]);
    }
    
}