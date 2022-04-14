<?php

class DetailCommandes extends Modele{

    protected $idDetailCommande;

    protected $idCommande;

    protected $idLivre;

    protected $quantite;

    protected $livre;

    public function __construct($idDetailCommande = null)
    {
        if($idDetailCommande != null)
        {
            $requete = $this->getBdd() -> prepare ('SELECT * FROM detailcommandes WHERE idDetailCommande = ?');
            $requete -> execute([$idDetailCommande]);
            $det = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idDetailCommande = $det['idDetailCommande'];

            $this->idCommande = $det['idCommande'];

            $this->idLivre = $det['idLivre'];

            $this->quantite = $det['quantite'];

            $this->livre = new Livre($this->idLivre);

        }
    }

    public function initializeDetailCommande($idDetailCommande = null, $idCommande = null, $quantite = null, $idLivre = null){
        $this->idDetailCommande   =   $idDetailCommande;
        $this->idCommande         =   $idCommande;
        $this->quantite           =   $quantite;
        $this->idLivre            =   $idLivre;

        $this->livre              =   new Livre($this->idLivre);
    }

    public function getIdDetailCommande(){
        return $this->idDetailCommande;
    }

    public function getIdCommande(){
        return $this->idCommande;
    }

    public function getIdLivre(){
        return $this->idLivre;
    }

    public function getQuantite(){
        return $this->quantite;
    }

    public function getLivre(){
        return $this->livre;
    }

}