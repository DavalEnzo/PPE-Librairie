<?php
class Commande extends Modele{

    private $idCommande;

    private $idPanier;

    private $idUtilisateur;
    
    private $prixTotal;

    private $idAdresse;

    private $dateCommande;

    private $statut;

    public function __construct($idCommande = null)
    {
        if($idCommande != null)
        {
            $requete = $this->getBdd() -> prepare ('SELECT * FROM commandes WHERE idCommande = ?');
            $requete -> execute([$idCommande]);
            $com = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idCommande = $idCommande;

            $this->idPanier = $com['idPanier'];

            $this->idUtilisateur = $com['idUtilisateur'];

            $this->prixTotal = $com['prixTotal'];

            $this->idAdresse = $com['idAdresse'];

            $this->dateCommande = $com['dateCommande'];

            $this->statut = $com['statut'];

        }
    }
    /**
     * initialise l'objet courant
     */
    public function initializeCommande()
    {
        # code...
    }

    public function getAllCommandesUser($idUtilisateur){
        $requete = $this->getBdd() -> prepare ('SELECT * FROM commandes WHERE idUtilisateur = ?');
        $requete -> execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdCommande(){
        return $this->idCommande;
    }

    public function getIdPanier(){
        return $this->idPanier;
    }

    public function getIdutilisateur(){
        return $this->idUtilisateur;
    }

    public function getPrixTotal(){
        return $this->prixTotal;
    }

    public function getIdAdresse(){
        return $this->idAdresse;
    }

    public function getDateCommande(){
        return $this->dateCommande;
    }

    public function getStatut(){
        return $this->statut;
    }
}