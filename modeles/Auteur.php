<?php

class Auteur extends Modele
{
    private $idAuteur;

    private $nom;

   public function __construct($idAuteur=null)
   {
       if($idAuteur!=null){
        $requete=$this->getBdd()->prepare('SELECT * FROM auteurs WHERE idAuteur = ?');
        $requete->execute([$idAuteur]);  
        $auteur= $requete->fetch(PDO::FETCH_ASSOC);

        $this->idAuteur=$idAuteur;

        $this->nom=$auteur['nom'];
        
       }
    }

    public function getTousAuteurs()
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM auteurs ORDER BY nom ASC");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

   public function insertAuteur($auteur){
        $requete= $this->getBdd()->prepare("INSERT INTO auteurs (nom) VALUES (?)");
        $requete->execute([$auteur]);
    }

   public function insertAuteur2($a){
        $requete= $this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES (?, (SELECT max(idLivre) FROM bibliotheque))");
        $requete->execute([$a]);
    }
    
    public function getIdAuteur()
    {
       return  $this->idAuteur;
    }
    
    public function getNomAuteur()
    {
       return  $this->nom;
    }
}