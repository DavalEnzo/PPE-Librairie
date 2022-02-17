<?php

class Panier extends Modele{

    private $idPanier;
    private $idUtilisateur;

    private $Stockages=[];

    public function __construct($idPanier = null, $idUtilisateur = null)
    {
    
        if($idPanier != null && $idUtilisateur != null){
            $requete = $this->getBdd()->prepare('CALL select_panier(?,?)');
            $requete->execute([$idPanier,$idUtilisateur]);

            $panier = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idPanier = $idPanier; 
            $this->idUtilisateur =$idUtilisateur;

            $this->panier = $panier;          
        }
    }
    /**
     * @param   int     idPanier
     * @param   int     idUtilisateur
     * 
     * @return  void
     */
    public function initializePanier($idPanier = null,$idUtilisateur = null)
    {
        $this->idPanier = $idPanier; 
        $this->idUtilisateur =$idUtilisateur;
        $this->initPanierStockage($this->idPanier);
    }

    public function initPanierStockage($idPanier)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM stockage WHERE idPanier = ?");
        $requete -> execute([$idPanier]);
        $stock = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($stock as $s)
        {
            $stockages = new Stockage();
            $stockages->initializeStockage();
            $this->Stockages[]=$stockages;
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
    
        public function supprimerPanier($idPanier)
        {
            $requete = $this->getBdd()->prepare('DELETE FROM paniers WHERE idPanier = ?');
            $requete->execute([$idPanier]);
        }

    public function getIdPanier(){
        return $this->idPanier;
    }

    public function getPanier(){
        return $this->panier;
    }
    
}