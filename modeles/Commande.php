<?php
class Commande extends Modele{

    private $idCommande;
    private $idPanier;
    private $idUtilisateur;
    private $prixTotal;
    private $idAdresse;
    private $dateCommande;
    private $statut;

    private $panier;

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

            $this->panier = new Panier($this->idPanier);

        }
    }

    /**
     * initialise l'objet courant
     * @param   int     idCommande
     * @param   int     idPanier
     * @param   int     idUtilisateur
     * @param   float   prixTotal 
     * @param   int     idAdresse
     * @param   date    dateCommande
     * @param   int     statut
     * 
     * @return  void
     */
    public function initializeCommande($idCommande=null,$idPanier=null,$idUtilisateur=null,$prixTotal=null,$idAdresse=null,$dateCommande=null,$statut=null)
    {
        $this->idCommande       =   $idCommande;
        $this->idPanier         =   $idPanier;
        $this->idUtilisateur    =   $idUtilisateur;
        $this->prixTotal        =   $prixTotal;
        $this->idAdresse        =   $idAdresse;
        $this->dateCommande     =   $dateCommande;
        $this->statut           =   $statut;

        $this->panier = new Panier($this->idPanier);
    }

    public function ajouterCommande($idPanier, $idUtilisateur, $prixTotal, $adresse){
        $requete = $this->getBdd()->prepare("INSERT INTO commandes( idPanier ,idUtilisateur,prixTotal,adresse,dateCommande,dateLivraison)
        VALUES(?,?,?,?,NOW(),NOW() + INTERVAL 10 DAY)");
        $requete->execute([$idPanier, $idUtilisateur, $prixTotal, $adresse]);
    }

    public function ajouterDetailsCommande($idLivre, $quantite){
        $requete = $this->getBdd()->prepare("INSERT INTO detailcommandes(idCommande, idLivre, quantite)
        VALUES((SELECT max(idCommande) FROM commandes),?,?)");
        $requete->execute([$idLivre, $quantite]);
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
    public function getPanier()
    {
        return $this->panier;
    }
}