<?php

class Panier extends Modele{

    private $panier;

    public function __construct($idpanier = null, $idutilisateur = null)
    {
    
        if($idpanier != null && $idutilisateur != null){
            $requete = $this->getBdd()->prepare('SELECT *, editeurs.nom as nomEditeur FROM paniers INNER JOIN stockage USING (idPanier) INNER JOIN bibliotheque ON stockage.idLivre = bibliotheque.idLivre INNER JOIN editeurs ON bibliotheque.idEditeur = editeurs.idEditeur INNER JOIN utilisateurs USING (idUtilisateur) WHERE idPanier = ? AND idUtilisateur = ?
            ');
            $requete->execute([$idpanier,$idutilisateur]);

            $panier = $requete->fetchAll(PDO::FETCH_ASSOC);

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